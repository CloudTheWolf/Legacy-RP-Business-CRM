/**
 *
 * ComponentsSpinners
 *
 * Interface.Components.Spinners page content scripts. Initialized from scripts.js file.
 *
 *
 */

class ComponentsSpinners {
  constructor() {
    // Initialization of the page plugins
    this._initOverlaySpinner();
  }

  _initOverlaySpinner() {
    document.getElementById('addOverlaySpinner') &&
      document.getElementById('addOverlaySpinner').addEventListener('click', () => {
        document.body.classList.add('spinner');
        setTimeout(() => {
          document.body.classList.remove('spinner');
        }, 3000);
      });
    document.getElementById('addCardOverlaySpinner') &&
      document.getElementById('addCardOverlaySpinner').addEventListener('click', (event) => {
        let parentCard = event.currentTarget.closest('.card');
        parentCard.classList.add('overlay-spinner');
        setTimeout(() => {
          parentCard.classList.remove('overlay-spinner');
        }, 3000);
      });
  }
}
