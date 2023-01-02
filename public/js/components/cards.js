/**
 *
 * ComponentsCards
 *
 * Interface.Components.Card page content scripts. Initialized from scripts.js file.
 *
 *
 */

class ComponentsCards {
  constructor() {
    if (typeof Masonry !== 'undefined') {
      this._initMasonry();
    } else {
      console.error('[CS] Masonry is undefined.');
    }
  }

  // Masonry Cards Example init
  _initMasonry() {
    if (typeof Masonry !== 'undefined') {
      if (document.getElementById('masonryCardsExample')) {
        var msnry = new Masonry('#masonryCardsExample', {
          itemSelector: '.col',
          percentPosition: true,
          transitionDuration: 0,
        });
      }
    }
  }
}
