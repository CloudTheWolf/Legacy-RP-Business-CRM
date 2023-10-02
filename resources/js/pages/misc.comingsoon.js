/**
 *
 * ComingSoon
 *
 * Pages.Miscellaneous.ComingSoon page content scripts. Initialized from scripts.js file.
 *
 *
 */

class ComingSoon {
  constructor() {
    // Initialization of the page plugins
    this._initCountdown();
  }

  // Countdown plugin initialization
  _initCountdown() {
    if (typeof Countdown !== 'undefined') {
      var dateToCount = new Date(new Date().setMinutes(new Date().getMinutes() + 5000));
      var countdown = new Countdown({
        selector: '#timer',
        leadingZeros: true,
        msgBefore: '',
        msgAfter: '',
        msgPattern: `
                      <div class="row g-2">
                          <div class="col-3">
                              <div class="display-5 text-primary mb-1">{days}</div>
                              <div>Days</div>
                          </div>
                          <div class="col-3">
                              <div class="display-5 text-primary mb-1">{hours}</div>
                              <div>Hours</div>
                          </div>
                          <div class="col-3">
                              <div class="display-5 text-primary mb-1">{minutes}</div>
                              <div>Minutes</div>
                          </div>
                          <div class="col-3">
                              <div class="display-5 text-primary mb-1">{seconds}</div>
                              <div>Seconds</div>
                          </div>
                      </div>`,
        dateEnd: dateToCount,
      });
    }
  }
}
