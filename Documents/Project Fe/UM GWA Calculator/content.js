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

  function countAttrs(value, digits, from = 0, suffix = "") {
    if (!Number.isFinite(value)) return "";
    return `data-count-to="${value}" data-count-from="${from}" data-count-digits="${digits}" data-count-suffix="${escapeHtml(suffix)}"`;
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

  function getStandingRange(title, scale) {
    const ranges = scale === "legacy"
      ? {
          Legend: "1.00 - 1.50",
          Master: "1.51 - 2.00",
          Scholar: "2.01 - 2.50",
          Achiever: "2.51 - 3.00",
          Player: "3.01 - 3.50",
          Rookie: "3.51 - 4.00",
          "Keep going": "4.01 - 5.00"
        }
      : {
          Legend: "3.50 - 4.00",
          Master: "3.00 - 3.49",
          Scholar: "2.50 - 2.99",
          Achiever: "2.00 - 2.49",
          Player: "1.50 - 1.99",
          Rookie: "1.01 - 1.49",
          "Keep going": "1.00"
        };
    return ranges[title] || "No range yet";
  }

  function buildGauge(gwa, scale) {
    const minimum = 1;
    const maximum = scale === "legacy" ? 5 : 4;
    const safeGwa = Number.isFinite(gwa) ? gwa : minimum;
    const position = Math.max(0, Math.min(1, (safeGwa - minimum) / (maximum - minimum)));
    const needleAngle = position * 180;
    const segmentStart = Math.max(0, position * 100 - 8);
    const tickValues = Array.from({ length: maximum }, (_, index) => index + 1);
    const tickRadius = 140;

    const ticks = tickValues.map((value) => {
      const tickPosition = (value - minimum) / (maximum - minimum);
      const tickAngle = Math.PI - tickPosition * Math.PI;
      const x = 160 + tickRadius * Math.cos(tickAngle);
      const y = 154 - tickRadius * Math.sin(tickAngle);
      return `<text x="${x.toFixed(1)}" y="${y.toFixed(1)}" text-anchor="middle">${value.toFixed(1)}</text>`;
    }).join("");

    return `<div class="um-gauge" aria-label="GWA position ${fmt(gwa)} on a ${minimum.toFixed(1)} to ${maximum.toFixed(1)} scale">
      <svg viewBox="0 0 320 190" role="img" aria-hidden="true">
        <path class="um-gauge-track" pathLength="100" d="M 45 150 A 115 115 0 0 1 275 150"></path>
        <path class="um-gauge-active" style="--um-gauge-offset:-${segmentStart.toFixed(2)}" pathLength="100" stroke-dasharray="16 100" d="M 45 150 A 115 115 0 0 1 275 150"></path>
        <g class="um-gauge-ticks">${ticks}</g>
        <g class="um-gauge-needle-group" style="--um-gauge-angle:${needleAngle.toFixed(2)}deg">
          <line class="um-gauge-needle" x1="160" y1="150" x2="52" y2="150"></line>
          <circle class="um-gauge-marker" cx="52" cy="150" r="8"></circle>
          <circle class="um-gauge-marker-core" cx="52" cy="150" r="3"></circle>
        </g>
        <text class="um-gauge-caption" x="160" y="112" text-anchor="middle">YOUR GWA</text>
        <text class="um-gauge-value" ${countAttrs(gwa, 2, 1)} x="160" y="139" text-anchor="middle">${fmt(gwa)}</text>
      </svg>
      <p>Closer to ${scale === "legacy" ? "1.0" : maximum.toFixed(1)} is better</p>
    </div>`;
  }

  function statIcon(type) {
    const paths = {
      courses: `<path d="M12 3 3.5 7.5 12 12l8.5-4.5L12 3Z"></path><path d="M5.5 9v7.2L12 20l6.5-3.8V9"></path>`,
      units: `<path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H11v16H6.5A2.5 2.5 0 0 0 4 21.5v-16Z"></path><path d="M20 5.5A2.5 2.5 0 0 0 17.5 3H13v16h4.5a2.5 2.5 0 0 1 2.5 2.5v-16Z"></path>`,
      semesters: `<rect x="3" y="5" width="18" height="16" rx="2"></rect><path d="M16 3v4M8 3v4M3 10h18"></path><path d="M7 14h2M11 14h2M15 14h2M7 18h2M11 18h2"></path>`
    };
    return `<span class="um-stat-icon" aria-hidden="true"><svg viewBox="0 0 24 24">${paths[type]}</svg></span>`;
  }

  function animateNumbers(panel) {
    const numbers = [...panel.querySelectorAll("[data-count-to]")];
    if (!numbers.length) return;

    function renderValue(node, value) {
      const digits = Number(node.dataset.countDigits || 0);
      const suffix = node.dataset.countSuffix || "";
      node.textContent = `${value.toFixed(digits)}${suffix}`;
    }

    if (window.matchMedia?.("(prefers-reduced-motion: reduce)").matches) {
      numbers.forEach((node) => renderValue(node, Number(node.dataset.countTo)));
      return;
    }

    const duration = 1450;
    const startTime = performance.now();
    numbers.forEach((node) => {
      renderValue(node, Number(node.dataset.countFrom || 0));
      node.classList.add("um-number-animating");
    });

    function update(now) {
      const elapsed = Math.min(1, (now - startTime) / duration);
      const eased = 1 - Math.pow(1 - elapsed, 3);
      numbers.forEach((node) => {
        const from = Number(node.dataset.countFrom || 0);
        const target = Number(node.dataset.countTo);
        renderValue(node, from + (target - from) * eased);
      });
      if (elapsed < 1) requestAnimationFrame(update);
      else numbers.forEach((node) => node.classList.remove("um-number-animating"));
    }

    requestAnimationFrame(update);
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
          <h2><span>GWA</span> GAH?<i class="um-title-rays" aria-hidden="true"><b></b><b></b><b></b></i></h2>
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
    const overview = el("div", "um-overview");
    const hero = el(
      "div",
      "um-hero",
      `<div class="um-hero-watermark" aria-hidden="true"><span>G</span><span>G</span><span>?</span><span>=</span></div>
       <div class="um-hero-copy">
         <span class="um-hero-label">General weighted average</span>
         <strong class="um-gwa" ${countAttrs(result.gwa, 2, 1)}>${fmt(result.gwa)}</strong>
         <span class="um-formula"><b ${countAttrs(result.weightedPoints, 2)}>${fmt(result.weightedPoints, 2)}</b> weighted points&nbsp; / &nbsp;<b ${countAttrs(result.totalUnits, 1)}>${fmt(result.totalUnits, 1)}</b> units</span>
       </div>
       ${buildGauge(result.gwa, result.scale)}`
    );
    const standingCard = el(
      "article",
      "um-standing-card",
      `<div class="um-standing-rings" aria-hidden="true"></div>
       <div class="um-trophy" aria-hidden="true">
         <svg viewBox="0 0 24 24"><path d="M8 4h8v3.5c0 3-1.8 5.5-4 5.5s-4-2.5-4-5.5V4Z"></path><path d="M8 6H5v1.5c0 2 1.2 3.5 3.3 3.8M16 6h3v1.5c0 2-1.2 3.5-3.3 3.8M12 13v4M8.5 21h7M10 17h4v4"></path></svg>
         <span>&#9733;</span>
       </div>
       <span>Academic standing</span>
       <strong>${escapeHtml(standing.title)}</strong>
       <b>${escapeHtml(getStandingRange(standing.title, result.scale))}</b>
       <small>${escapeHtml(standing.subtitle)}</small>
       <i aria-hidden="true"></i>`
    );
    overview.append(hero, standingCard);

    const stats = el("div", "um-stats", `<article class="um-stat">${statIcon("courses")}<div><strong ${countAttrs(result.included.length, 0)}>${result.included.length}</strong><span>Courses counted</span></div></article><article class="um-stat">${statIcon("units")}<div><strong ${countAttrs(result.totalUnits, 1)}>${fmt(result.totalUnits, 1)}</strong><span>Total units</span></div></article><article class="um-stat">${statIcon("semesters")}<div><strong ${countAttrs(result.terms.length, 0)}>${result.terms.length}</strong><span>Semesters</span></div></article>`);

    const semesterSection = el("section", "um-section");
    semesterSection.innerHTML = `<div class="um-section-heading"><div><span class="um-section-kicker">History</span><h3>Semester performance</h3></div><span>${result.terms.length} total</span></div>`;
    const termList = el("div", "um-term-list");
    if (result.terms.length) {
      result.terms.forEach((term) => {
        termList.appendChild(el("article", "um-term-card", `<p>${escapeHtml(term.term)}</p><strong ${countAttrs(term.gwa, 2, 1)}>${fmt(term.gwa)}</strong><div><span ${countAttrs(term.courses, 0, 0, " courses")}>${term.courses} courses</span><span ${countAttrs(term.units, 1, 0, " units")}>${fmt(term.units, 1)} units</span></div>`));
      });
    } else {
      termList.appendChild(el("p", "um-empty", "No semester results are available yet."));
    }
    semesterSection.appendChild(termList);

    const exclusions = el("details", "um-details");
    const excludedLabel = result.excluded.length === 1 ? "1 entry" : `${result.excluded.length} entries`;
    exclusions.innerHTML = `<summary>
      <span class="um-exclusion-heading">
        <i aria-hidden="true">i</i>
        <span><strong>Not included in GWA</strong><small>These subjects are excluded from the GWA computation.</small></span>
      </span>
      <b>${excludedLabel}</b>
    </summary>`;
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
    const note = el("div", "um-note", `<span aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 3 5 6v5c0 4.7 2.8 8.2 7 10 4.2-1.8 7-5.3 7-10V6l-7-3Z"></path><path d="m9 12 2 2 4-4"></path></svg></span><p>Calculated locally from your permanent record.<br>This is a personal estimate, not an official university record.</p>`);
    const actions = el("div", "um-actions");
    const copyButton = el("button", "um-button um-button-secondary", `<svg viewBox="0 0 24 24" aria-hidden="true"><rect x="6" y="5" width="12" height="16" rx="2"></rect><path d="M9 5V3h6v2M9 9h6"></path></svg><span>Copy GWA</span>`);
    copyButton.type = "button";
    copyButton.disabled = !Number.isFinite(result.gwa);
    copyButton.addEventListener("click", async () => {
      try {
        await navigator.clipboard.writeText(fmt(result.gwa));
        copyButton.querySelector("span").textContent = "Copied";
        setTimeout(() => { copyButton.querySelector("span").textContent = "Copy GWA"; }, 1200);
      } catch { copyButton.querySelector("span").textContent = "Copy failed"; }
    });
    const recalculateButton = el("button", "um-button um-button-primary", `<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20 7v5h-5"></path><path d="M19 12a7 7 0 1 1-2-5"></path></svg><span>Recalculate</span>`);
    recalculateButton.type = "button";
    recalculateButton.addEventListener("click", renderCalculator);
    actions.append(copyButton, recalculateButton);
    footer.append(note, actions);

    panel.append(header, overview, stats, semesterSection, exclusions, footer);
    const tableContainer = table.closest(".card") || table.parentElement;
    tableContainer.parentElement.insertBefore(panel, tableContainer);
    animateNumbers(panel);
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
