/**
 *
 * ComponentsProgress
 *
 * Interface.Components.Progress page content scripts. Initialized from scripts.js file.
 *
 *
 */

class ComponentsProgress {
  constructor() {
    // Initialization of the page plugins
    this._initProgressBars();
  }

  _initProgressBars() {
    document.querySelectorAll('.progress-bar').forEach((element) => {
      const volume = element.getAttribute('aria-valuenow');
      element.style.width = volume + '%';
    });
  }
}
