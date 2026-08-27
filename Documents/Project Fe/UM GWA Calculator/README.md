# GWA Gah?

A Chrome extension that calculates your GWA directly on the **UM Student Portal** and presents it as a clean academic snapshot.

## Features

- **Automatic grade-scale detection** - Uses the grades already in the student's permanent record; there is no manual system selector.
- **Academic snapshot** - See the calculated GWA, academic standing, total units, counted courses, and semester count at a glance.
- **Semester performance** - Review each term's GWA, courses, and units in compact cards.
- **Transparent exclusions** - See which entries were not counted and why.
- **Copy and recalculate** - Copy the current GWA or refresh the calculation in one click.
- **Private by design** - Grades are processed locally and never leave the browser.
- **Original branding** - Features the GWA GAH? app icon and Feanne creator mark.

## Download and install

1. Download the repository as a ZIP and extract it.
2. Open `chrome://extensions` in Chrome.
3. Turn on **Developer mode**.
4. Click **Load unpacked**.
5. Select the extracted folder containing `manifest.json`.

## Use it

1. Go to the [UM Student Portal](https://student.umindanao.edu.ph/student/spr).
2. Log in and open your **Permanent Record**.
3. The academic snapshot appears automatically above the grades table.

## How it works

| Item | Details |
|---|---|
| Formula | `sum(Grade x Units) / sum(Units)` |
| Excluded subjects | NSTP, PE, PAHF, CAED 500 |
| Grade scale | Inferred from the valid grade values in the permanent record |
| Data handling | Calculated entirely in the browser |

The current UM scale uses fixed half-point grade steps up to 4.0. A valid value outside those steps indicates that the student's record uses the legacy scale. Detection happens automatically and is not presented as a setting.

## Disclaimer

This is a personal estimate, not an official UM record. Always verify important academic information with the university or registrar.

## Troubleshooting

| Problem | Solution |
|---|---|
| Extension not showing | Reload the extension, then refresh the Permanent Record page. |
| No valid courses found | Confirm that the Permanent Record table has loaded and contains final grades and units. |
| GWA looks incorrect | Open **Not included in GWA** to review filtered entries, then compare the visible grades and units with the portal record. |
