/**
 *
 * ComponentsNavs
 *
 * Interface.Components.Navs page content scripts. Initialized from scripts.js file.
 *
 *
 */

class ComponentsNavs {
  constructor() {
    // Initialization of the page plugins
    if (typeof ResponsiveTab !== 'undefined') {
      this._initTitleTabs();
    } else {
      console.error('[CS] ResponsiveTab is undefined.');
    }
  }

  // Responsive Tabs initialization
  _initTitleTabs() {
    document.querySelectorAll('.responsive-tabs').forEach((el) => {
      new ResponsiveTab(el);
    });
  }
}
