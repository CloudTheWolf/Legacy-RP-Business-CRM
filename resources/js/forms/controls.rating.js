/**
 *
 * RatingControls
 *
 * Interface.Forms.Controls.Rating page content scripts. Initialized from scripts.js file.
 *
 *
 */

class RatingControls {
  constructor() {
    // Initialization of the page plugins
    if (!jQuery().barrating) {
      console.log('barrating is null!');
      return;
    }

    this._initCSLineIconRating();
    this._initCSSIconRating();
    this._initTenPointsRating();
    this._initBarsLowRating();
    this._initBarsTallRating();
    this._initButtonsRating();
    this._initTopLabelRating();
    this._initFloatinLabelRating();
    this._initFilledRating();
  }

  // CS Icon implementation
  _initCSLineIconRating() {
    jQuery('#ratingCSIconInteractive').barrating();

    jQuery('#ratingCSIconReadonly').barrating({
      initialRating: jQuery('#ratingCSIconReadonly').data('initialRating'),
      readonly: jQuery('#ratingCSIconReadonly').data('readonly'),
      showValues: jQuery('#ratingCSIconReadonly').data('showValues'),
      showSelectedRating: jQuery('#ratingCSIconReadonly').data('showSelectedRating'),
    });
  }

  // CSS icons
  _initCSSIconRating() {
    jQuery('#ratingCSSIconInteractive').barrating();

    jQuery('#ratingCSSIconReadonly').barrating({
      initialRating: jQuery('#ratingCSSIconReadonly').data('initialRating'),
      readonly: jQuery('#ratingCSSIconReadonly').data('readonly'),
      showValues: jQuery('#ratingCSSIconReadonly').data('showValues'),
      showSelectedRating: jQuery('#ratingCSSIconReadonly').data('showSelectedRating'),
    });
  }

  // Ten points
  _initTenPointsRating() {
    jQuery('#ratingTenPointsInteractive').barrating();

    jQuery('#ratingTenPointsReadonly').barrating({
      initialRating: jQuery('#ratingTenPointsReadonly').data('initialRating'),
      readonly: jQuery('#ratingTenPointsReadonly').data('readonly'),
      showValues: jQuery('#ratingTenPointsReadonly').data('showValues'),
      showSelectedRating: jQuery('#ratingTenPointsReadonly').data('showSelectedRating'),
    });
  }

  // Low bars
  _initBarsLowRating() {
    jQuery('#barsLowInteractive').barrating({initialRating: -1});

    jQuery('#barsLowReadonly').barrating({
      initialRating: jQuery('#barsLowReadonly').data('initialRating'),
      readonly: jQuery('#barsLowReadonly').data('readonly'),
      showValues: jQuery('#barsLowReadonly').data('showValues'),
      showSelectedRating: jQuery('#barsLowReadonly').data('showSelectedRating'),
    });
  }

  // Tall bars
  _initBarsTallRating() {
    jQuery('#barsTallInteractive').barrating({initialRating: -1});

    jQuery('#barsTallReadonly').barrating({
      initialRating: jQuery('#barsTallReadonly').data('initialRating'),
      readonly: jQuery('#barsTallReadonly').data('readonly'),
      showValues: jQuery('#barsTallReadonly').data('showValues'),
      showSelectedRating: jQuery('#barsTallReadonly').data('showSelectedRating'),
    });
  }

  // Buttons
  _initButtonsRating() {
    jQuery('#ratingButtonInteractive').barrating({
      initialRating: jQuery('#ratingButtonInteractive').data('initialRating'),
      readonly: jQuery('#ratingButtonInteractive').data('readonly'),
      showValues: jQuery('#ratingButtonInteractive').data('showValues'),
      showSelectedRating: jQuery('#ratingButtonInteractive').data('showSelectedRating'),
    });

    jQuery('#ratingButtonReadonly').barrating({
      initialRating: jQuery('#ratingButtonReadonly').data('initialRating'),
      readonly: jQuery('#ratingButtonReadonly').data('readonly'),
      showValues: jQuery('#ratingButtonReadonly').data('showValues'),
      showSelectedRating: jQuery('#ratingButtonReadonly').data('showSelectedRating'),
    });
  }

  // Top label input rating
  _initTopLabelRating() {
    jQuery('#ratingTopLabel').barrating();
  }

  // Floating label input rating
  _initFloatinLabelRating() {
    jQuery('#ratingFloatingLabel').barrating();
  }

  // Filled input rating
  _initFilledRating() {
    jQuery('#ratingFilled').barrating();
  }
}
