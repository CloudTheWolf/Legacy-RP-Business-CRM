/**
 *
 * BlocksGallery
 *
 * Blocks.Gallery page content scripts. Initialized from scripts.js file.
 *
 *
 */

class BlocksGallery {
  constructor() {
    // Initialization of the page plugins
    if (typeof baguetteBox !== 'undefined') {
      this._initLightbox();
    } else {
      console.error('[CS] baguetteBox is undefined.');
    }
  }

  // Lightbox initialize
  _initLightbox() {
    baguetteBox.run('.gallery');
  }
}
