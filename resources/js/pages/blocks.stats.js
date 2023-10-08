/**
 *
 * BlocksList
 *
 * Blocks.List page content scripts. Initialized from scripts.js file.
 *
 *
 */

class BlocksList {
  constructor() {
    // References to page items that might require an update
    this._progressBars = [];

    // Initialization of the page plugins
    if (typeof ProgressBar !== 'undefined') {
      this._initProgressBars();
    } else {
      console.error('[CS] ProgressBar is undefined.');
    }

    this._initEvents();
  }

  // ProgressBars implementation
  _initProgressBars() {
    // Standard progressbars implementation
    document.querySelectorAll('.progress-bar').forEach((element) => {
      const volume = element.getAttribute('aria-valuenow');
      element.style.width = volume + '%';
    });

    // Circle implementation
    document.querySelectorAll('.progress-bar-circle').forEach((el, i) => {
      const val = el.getAttribute('aria-valuenow');
      const color = Globals[el.getAttribute('data-color')] || Globals.primary;
      const trailColor = Globals[el.getAttribute('data-trail-color')] || Globals.separator;
      const max = el.getAttribute('aria-valuemax') || 100;
      const showPercent = el.getAttribute('data-show-percent');
      const hideAll = el.getAttribute('data-hide-all-text');
      const strokeWidth = el.getAttribute('data-stroke-width') || 1;
      const trailWidth = el.getAttribute('data-trail-width') || 1;
      const duration = parseInt(el.getAttribute('data-duration')) || 20;
      const easing = el.getAttribute('data-easing') || 'easeInOut';
      this._progressBars.push(
        new ProgressBar.Circle(el, {
          color: color,
          duration: duration,
          easing: easing,
          strokeWidth: strokeWidth,
          trailColor: trailColor,
          trailWidth: trailWidth,
          val: val,
          max: max,
          text: {
            autoStyleContainer: false,
          },
          step: function (state, bar) {
            if (hideAll === 'false') {
              if (showPercent === 'true') {
                bar.setText(Math.round(bar.value() * 100) + '%');
              } else {
                bar.setText(val + '/' + max);
              }
            }
          },
        }),
      );
    });

    // Animate
    for (let i = 0; i < this._progressBars.length; i++) {
      this._progressBars[i].animate(this._progressBars[i]._opts.val / this._progressBars[i]._opts.max);
    }
  }

  // ProgressBars destroy
  _progressBarsDestroy() {
    for (let i = 0; i < this._progressBars.length; i++) {
      this._progressBars[i].destroy();
    }
    this._progressBars = [];
  }

  // ProgressBars update
  _progressBarsUpdate() {
    this._progressBarsDestroy();
    this._initProgressBars();
  }

  // Listening for color change events to update charts
  _initEvents() {
    document.documentElement.addEventListener(Globals.colorAttributeChange, (event) => {
      this._progressBarsUpdate();
    });
  }
}
