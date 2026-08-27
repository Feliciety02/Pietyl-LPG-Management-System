(() => {
  "use strict";

  const PANEL_ID = "um-gwa-calculator";
  const EXCLUDED_ROW_CLASS = "um-gwa-excluded-row";
  const CURRENT_GRADE_STEPS = [1, 2, 2.5, 3, 3.5, 4];

  function normalize(value) {
    return String(value ?? "").replace(/\s+/g, " ").trim();
  }

  function parseNumber(value) {
    const match = normalize(value).replace(/,/g, "").match(/-?\d+(?:\.\d+)?/);
    if (!match) return null;
    const number = Number(match[0]);
    return Number.isFinite(number) ? number : null;
  }

  function escapeHtml(value) {
    return String(value ?? "")
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;");
  }

  function assetUrl(path) {
    return globalThis.chrome?.runtime?.getURL ? chrome.runtime.getURL(path) : path;
  }

  function isExcludedCourse(courseNumber) {
    const course = normalize(courseNumber).toUpperCase();
    return (
      /^(NSTP|PAHF|PE)(?:\s|$)/.test(course) ||
      /^CAED\s*500(?:\/L)?(?:\s|$)/.test(course)
    );
  }

  function findPermanentRecordTable() {
    return [...document.querySelectorAll("table")].find((table) => {
      const headings = [...table.querySelectorAll("thead th")]
        .map((th) => normalize(th.textContent).toLowerCase())
        .join(" | ");
      return headings.includes("course number") && headings.includes("final grade") && headings.includes("unit");
    });
  }

  function getColumnIndexes(table) {
    const headers = [...table.querySelectorAll("thead th")].map((th) => normalize(th.textContent).toLowerCase());
    return {
      course: headers.findIndex((value) => value.includes("course number")),
      title: headers.findIndex((value) => value.includes("descriptive title")),
      grade: headers.findIndex((value) => value.includes("final grade")),
      unit: headers.findIndex((value) => value.includes("unit"))
    };
  }

  function isCurrentGradeStep(grade) {
    return CURRENT_GRADE_STEPS.some((step) => Math.abs(step - grade) < 0.001);
  }

  // Current grades use fixed half-point steps up to 4.0. Any other valid
  // value is unambiguous evidence of the legacy scale. This stays automatic.
  function detectGradingScale(courses) {
    const grades = courses
      .filter((course) => !course.baseExcluded)
      .map((course) => course.grade)
      .filter(Number.isFinite);
    return grades.some((grade) => grade > 4 || !isCurrentGradeStep(grade)) ? "legacy" : "current";
  }

  function readCourses(table) {
    const indexes = getColumnIndexes(table);
    if (Object.values(indexes).some((index) => index < 0)) return [];

    let currentTerm = "Other courses";
    const courses = [];

    table.querySelectorAll("tbody tr").forEach((row) => {
      row.classList.remove(EXCLUDED_ROW_CLASS);
      const cells = [...row.querySelectorAll(":scope > td")];
      if (!cells.length) return;

      const isTermRow = row.classList.contains("tr-primary-marker") || cells.some((cell) => Number(cell.getAttribute("colspan")) > 1);
      if (isTermRow) {
        currentTerm = normalize(cells[0]?.textContent) || currentTerm;
        return;
      }
      if (cells.length <= Math.max(...Object.values(indexes))) return;

      const courseNumber = normalize(cells[indexes.course]?.textContent);
      const title = normalize(cells[indexes.title]?.textContent);
      const gradeText = normalize(cells[indexes.grade]?.textContent);
      const unitText = normalize(cells[indexes.unit]?.textContent);
      const grade = parseNumber(gradeText);
      const units = parseNumber(unitText);
      if (!courseNumber && !title) return;

      let baseExclusionReason = "";
      if (isExcludedCourse(courseNumber)) baseExclusionReason = "Excluded subject";
      else if (grade === null) baseExclusionReason = "No numeric final grade";
      else if (grade < 1 || grade > 5) baseExclusionReason = "Grade outside the supported range";
      else if (units === null || units <= 0) baseExclusionReason = "No valid units";

      courses.push({
        row, term: currentTerm, courseNumber, title, grade, gradeText, units, unitText,
        baseExcluded: Boolean(baseExclusionReason), baseExclusionReason
      });
    });

    const scale = detectGradingScale(courses);
    const maximumGrade = scale === "legacy" ? 5 : 4;
    return courses.map((course) => {
      let exclusionReason = course.baseExclusionReason;
      if (!exclusionReason && course.grade > maximumGrade) exclusionReason = "Grade outside the detected scale";
      const excluded = Boolean(exclusionReason);

      if (excluded) {
        course.row.classList.add(EXCLUDED_ROW_CLASS);
        course.row.title = `Not included in GWA: ${exclusionReason}`;
      } else if (course.row.title.startsWith("Not included in GWA:")) {
        course.row.removeAttribute("title");
      }
      return { ...course, scale, excluded, exclusionReason };
    });
  }

  function calculate(courses) {
    const included = courses.filter((course) => !course.excluded);
    const excluded = courses.filter((course) => course.excluded);
    const totalUnits = included.reduce((sum, course) => sum + course.units, 0);
    const weightedPoints = included.reduce((sum, course) => sum + course.grade * course.units, 0);
    const gwa = totalUnits > 0 ? weightedPoints / totalUnits : null;
    const scale = courses[0]?.scale || "current";
    const termMap = new Map();

    included.forEach((course) => {
      const term = termMap.get(course.term) || { term: course.term, courses: 0, units: 0, weightedPoints: 0 };
      term.courses += 1;
      term.units += course.units;
      term.weightedPoints += course.grade * course.units;
      termMap.set(course.term, term);
    });

    const terms = [...termMap.values()].map((term) => ({
      ...term,
      gwa: term.units > 0 ? term.weightedPoints / term.units : null
    }));
    return { included, excluded, totalUnits, weightedPoints, gwa, terms, scale };
  }

  function fmt(value, digits = 2) {
    return Number.isFinite(value) ? value.toFixed(digits) : "--";
  }

  function getStanding(gwa, scale) {
    if (!Number.isFinite(gwa)) return { title: "No data yet", subtitle: "No valid grades found" };
    if (scale === "legacy") {
      if (gwa <= 1.5) return { title: "Legend", subtitle: "Outstanding performance" };
      if (gwa <= 2) return { title: "Master", subtitle: "Excellent performance" };
      if (gwa <= 2.5) return { title: "Scholar", subtitle: "Very good performance" };
      if (gwa <= 3) return { title: "Achiever", subtitle: "Good performance" };
      if (gwa <= 3.5) return { title: "Player", subtitle: "Keep progressing" };
      if (gwa <= 4) return { title: "Rookie", subtitle: "Room to improve" };
      return { title: "Keep going", subtitle: "Your next term is a fresh start" };
    }
    if (gwa >= 3.5) return { title: "Legend", subtitle: "Outstanding performance" };
    if (gwa >= 3) return { title: "Master", subtitle: "Excellent performance" };
    if (gwa >= 2.5) return { title: "Scholar", subtitle: "Very good performance" };
    if (gwa >= 2) return { title: "Achiever", subtitle: "Good performance" };
    if (gwa >= 1.5) return { title: "Player", subtitle: "Keep progressing" };
    if (gwa > 1) return { title: "Rookie", subtitle: "Room to improve" };
    return { title: "Keep going", subtitle: "Your next term is a fresh start" };
  }

  function el(tag, className, html) {
    const element = document.createElement(tag);
    if (className) element.className = className;
    if (html !== undefined) element.innerHTML = html;
    return element;
  }

  function buildPanel(result, table) {
    document.getElementById(PANEL_ID)?.remove();
    const standing = getStanding(result.gwa, result.scale);
    const panel = el("section");
    panel.id = PANEL_ID;
    panel.setAttribute("aria-label", "GWA academic snapshot");

    const header = el(
      "header",
      "um-header",
      `<div class="um-title-lockup">
        <img class="um-app-icon" src="${assetUrl("icons/icon128.png")}" alt="" aria-hidden="true">
        <div>
          <p class="um-eyebrow">Your academic companion</p>
          <h2><span>GWA</span> GAH?</h2>
          <p class="um-intro">Your permanent record, made easier to understand.</p>
        </div>
      </div>
      <div class="um-creator" aria-label="Created by Feanne">
        <span>Created by</span>
        <div>
          <img src="${assetUrl("icons/feanne-logo-blue.png")}" alt="Feanne logo">
          <a href="https://github.com/Feliciety02" target="_blank" rel="noopener noreferrer"><strong>Feanne</strong></a>
        </div>
      </div>`
    );
    const hero = el("div", "um-hero", `<div class="um-hero-copy"><span class="um-hero-label">General weighted average</span><strong class="um-gwa">${fmt(result.gwa)}</strong><span class="um-formula">${fmt(result.weightedPoints, 2)} points / ${fmt(result.totalUnits, 1)} units</span></div><div class="um-standing"><span>Academic standing</span><strong>${escapeHtml(standing.title)}</strong><small>${escapeHtml(standing.subtitle)}</small></div>`);
    const stats = el("div", "um-stats", `<article class="um-stat"><strong>${result.included.length}</strong><span>Courses counted</span></article><article class="um-stat"><strong>${fmt(result.totalUnits, 1)}</strong><span>Total units</span></article><article class="um-stat"><strong>${result.terms.length}</strong><span>Semesters</span></article>`);

    const semesterSection = el("section", "um-section");
    semesterSection.innerHTML = `<div class="um-section-heading"><div><span class="um-section-kicker">History</span><h3>Semester performance</h3></div><span>${result.terms.length} total</span></div>`;
    const termList = el("div", "um-term-list");
    if (result.terms.length) {
      result.terms.forEach((term) => {
        termList.appendChild(el("article", "um-term-card", `<p>${escapeHtml(term.term)}</p><strong>${fmt(term.gwa)}</strong><div><span>${term.courses} courses</span><span>${fmt(term.units, 1)} units</span></div>`));
      });
    } else {
      termList.appendChild(el("p", "um-empty", "No semester results are available yet."));
    }
    semesterSection.appendChild(termList);

    const exclusions = el("details", "um-details");
    const excludedLabel = result.excluded.length === 1 ? "1 entry" : `${result.excluded.length} entries`;
    exclusions.innerHTML = `<summary><span><small>Review</small>Not included in GWA</span><b>${excludedLabel}</b></summary>`;
    const exclusionBody = el("div", "um-details-body");
    if (result.excluded.length) {
      const list = el("ul", "um-excluded-list");
      result.excluded.forEach((course) => {
        list.appendChild(el("li", "um-excluded-item", `<span><strong>${escapeHtml(course.courseNumber || course.title)}</strong><small>${escapeHtml(course.title && course.courseNumber ? course.title : course.gradeText || "No grade")}</small></span><em>${escapeHtml(course.exclusionReason)}</em>`));
      });
      exclusionBody.appendChild(list);
    } else {
      exclusionBody.appendChild(el("p", "um-empty", "Every valid course is included."));
    }
    exclusions.appendChild(exclusionBody);

    const footer = el("footer", "um-footer");
    const note = el("p", "um-note", "Calculated locally from your permanent record. This is a personal estimate, not an official university record.");
    const actions = el("div", "um-actions");
    const copyButton = el("button", "um-button um-button-secondary", "Copy GWA");
    copyButton.type = "button";
    copyButton.disabled = !Number.isFinite(result.gwa);
    copyButton.addEventListener("click", async () => {
      try {
        await navigator.clipboard.writeText(fmt(result.gwa));
        copyButton.textContent = "Copied";
        setTimeout(() => { copyButton.textContent = "Copy GWA"; }, 1200);
      } catch { copyButton.textContent = "Copy failed"; }
    });
    const recalculateButton = el("button", "um-button um-button-primary", "Recalculate");
    recalculateButton.type = "button";
    recalculateButton.addEventListener("click", renderCalculator);
    actions.append(copyButton, recalculateButton);
    footer.append(note, actions);

    panel.append(header, hero, stats, semesterSection, exclusions, footer);
    const tableContainer = table.closest(".card") || table.parentElement;
    tableContainer.parentElement.insertBefore(panel, tableContainer);
  }

  function renderCalculator() {
    const table = findPermanentRecordTable();
    if (!table) return false;
    const courses = readCourses(table);
    if (!courses.length) return false;
    buildPanel(calculate(courses), table);
    return true;
  }

  function initialize() {
    if (renderCalculator()) return;
    const observer = new MutationObserver(() => {
      if (renderCalculator()) observer.disconnect();
    });
    observer.observe(document.documentElement, { childList: true, subtree: true });
    setTimeout(() => observer.disconnect(), 15000);
  }

  initialize();
})();
