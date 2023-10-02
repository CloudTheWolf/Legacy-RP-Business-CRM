/**
 *
 * DashboardVisual
 *
 * Dashboards.Visual page content scripts. Initialized from scripts.js file.
 *
 *
 */

class DashboardVisual {
  constructor() {
    // Initialization of the page plugins
    if (jQuery().barrating) {
      this._initRatings();
    } else {
      console.error('[CS] jQuery().barrating is undefined.');
    }
    this._initProgressBars();
  }

  _initProgressBars() {
    document.querySelectorAll('.progress-bar').forEach((element) => {
      const volume = element.getAttribute('aria-valuenow');
      element.style.width = volume + '%';
    });
  }
  // Recent Ratings
  _initRatings() {
    document.querySelectorAll('.recentRating').forEach((element) => {
      const current = element.getAttribute('data-initial-rating');
      const readonly = element.getAttribute('data-readonly');
      jQuery(element).barrating({
        initialRating: current,
        readonly: readonly,
        onSelect: function (value, text) {},
        onClear: function (value, text) {},
      });
    });
  }
}
