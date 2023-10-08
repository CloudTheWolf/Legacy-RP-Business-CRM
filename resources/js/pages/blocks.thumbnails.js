/**
 *
 * BlocksThumbnails
 *
 * Blocks.Thumbnails page content scripts. Initialized from scripts.js file.
 *
 *
 */

class BlocksThumbnails {
  constructor() {
    // Initialization of the page plugins
    if (jQuery().barrating) {
      this._initBarrating();
    } else {
      console.error('[CS] jQuery().barrating is undefined.');
    }
    if (typeof Checkall !== 'undefined') {
      this._initCheckAll();
    } else {
      console.error('[CS] Checkall is undefined.');
    }
  }

  // Check all button initialization
  _initCheckAll() {
    new Checkall(document.getElementById('checkAllforCheckboxTable'));
    new Checkall(document.getElementById('checkAllforCheckboxHorizontal'));
  }

  // Rating initialize
  _initBarrating() {
    jQuery('.rating').each(function () {
      const current = jQuery(this).data('initialRating');
      const readonly = jQuery(this).data('readonly');
      const showSelectedRating = jQuery(this).data('showSelectedRating');
      const showValues = jQuery(this).data('showValues');
      jQuery(this).barrating({
        initialRating: current,
        readonly: readonly,
        showValues: showValues,
        showSelectedRating: showSelectedRating,
        onSelect: function (value, text) {},
        onClear: function (value, text) {},
      });
    });
  }
}
