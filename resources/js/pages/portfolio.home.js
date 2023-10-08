/**
 *
 * PortfolioHome
 *
 * Pages.Portfolio.Home page content scripts. Initialized from scripts.js file.
 *
 *
 */

class PortfolioHome {
  constructor() {
    // Initialization of the page plugins
    if (typeof ResponsiveTab !== 'undefined') {
      this._initTitleTabs();
    } else {
      console.error('[CS] ResponsiveTab is undefined.');
    }
    // Initialization of the page plugins
    if (typeof baguetteBox !== 'undefined') {
      this._initLightbox();
    } else {
      console.error('[CS] baguetteBox is undefined.');
    }
  }

  // Responsive Tabs initialization
  _initTitleTabs() {
    document.querySelector('.responsive-tabs') !== null && new ResponsiveTab(document.querySelector('.responsive-tabs'));
  }

  // Lightbox initialize
  _initLightbox() {
    baguetteBox.run('.gallery');
  }
}
