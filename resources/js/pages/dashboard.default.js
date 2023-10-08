/**
 *
 * DashboardDefault
 *
 * Dashboards.Default page content scripts. Initialized from scripts.js file.
 *
 *
 */

class DashboardDefault {
  constructor() {
    // References to page items that might require an update
    this._largeLineChart1 = null;
    this._largeLineChart1 = null;

    // Initialization of the page plugins
    this._initStatsCarousel();
    this._initVideoGuidePlayer();
    this._initHelpSelect2();
    this._initSalesStocksCharts();
    this._initTour();

    // Template specific event listeners
    this._initEvents();
  }

  _initEvents() {
    // Listening for color change events to update charts
    document.documentElement.addEventListener(Globals.colorAttributeChange, (event) => {
      this._largeLineChart1 && this._largeLineChart1.destroy();
      this._largeLineChart2 && this._largeLineChart2.destroy();
      this._initSalesStocksCharts();
    });
  }

  // Stats Carousel
  _initStatsCarousel() {
    if (document.querySelector('#statsCarousel') !== null && typeof GlideCustom !== 'undefined') {
      new GlideCustom(
        document.querySelector('#statsCarousel'),
        {
          gap: 0,
          rewind: false,
          bound: true,
          perView: 6,
          breakpoints: {
            400: {perView: 1},
            600: {perView: 2},
            1400: {perView: 3},
            1600: {perView: 4},
            1900: {perView: 5},
            3840: {perView: 6},
          },
        },
        true,
      ).mount();
    }
  }

  // Video Guide Player
  _initVideoGuidePlayer() {
    if (document.querySelector('#videoGuide') !== null && typeof Plyr !== 'undefined') {
      new Plyr(document.querySelector('#videoGuide'));
    }
  }

  // Help Category Select2
  _initHelpSelect2() {
    if (jQuery().select2) {
      jQuery('#categorySelect').select2({minimumResultsForSearch: Infinity});
    }
  }

  // Custom Sales & Stock Charts
  _initSalesStocksCharts() {
    if (document.getElementById('largeLineChart1')) {
      this._largeLineChart1 = ChartsExtend.LargeLineChart('largeLineChart1', {
        labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Today'],
        datasets: [
          {
            label: 'Sales',
            data: [23, 24, 26, 30, 27],
            icons: ['arrow-top', 'arrow-top', 'arrow-top', 'arrow-top', 'arrow-bottom'],
            borderColor: Globals.primary,
            pointBackgroundColor: Globals.primary,
            pointBorderColor: Globals.primary,
            pointHoverBackgroundColor: Globals.foreground,
            pointHoverBorderColor: Globals.primary,
            borderWidth: 2,
            pointRadius: 2,
            pointBorderWidth: 2,
            pointHoverBorderWidth: 2,
            pointHoverRadius: 5,
            fill: false,
            datalabels: {
              align: 'end',
              anchor: 'end',
            },
          },
        ],
      });
    }

    if (document.getElementById('largeLineChart2')) {
      this._largeLineChart2 = ChartsExtend.LargeLineChart('largeLineChart2', {
        labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Today'],
        datasets: [
          {
            label: 'Stock',
            data: [44, 49, 45, 33, 52],
            icons: ['arrow-top', 'arrow-top', 'arrow-bottom', 'arrow-bottom', 'arrow-top'],
            borderColor: Globals.secondary,
            pointBackgroundColor: Globals.secondary,
            pointBorderColor: Globals.secondary,
            pointHoverBackgroundColor: Globals.foreground,
            pointHoverBorderColor: Globals.secondary,
            borderWidth: 2,
            pointRadius: 2,
            pointBorderWidth: 2,
            pointHoverBorderWidth: 2,
            pointHoverRadius: 5,
            fill: false,
            datalabels: {
              align: 'end',
              anchor: 'end',
            },
          },
        ],
      });
    }
  }

  // Dashboard Take a Tour
  _initTour() {
    if (typeof introJs !== 'undefined' && document.getElementById('dashboardTourButton') !== null) {
      document.getElementById('dashboardTourButton').addEventListener('click', (event) => {
        introJs()
          .setOption('nextLabel', '<span>Next</span><i class="cs-chevron-right"></i>')
          .setOption('prevLabel', '<i class="cs-chevron-left"></i><span>Prev</span>')
          .setOption('skipLabel', '<i class="cs-close"></i>')
          .setOption('doneLabel', '<i class="cs-check"></i><span>Done</span>')
          .setOption('overlayOpacity', 0.5)
          .start();
      });
    }
  }
}
