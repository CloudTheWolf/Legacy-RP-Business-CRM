/**
 *
 * ProfileSettings
 *
 * Pages.Profile.Settings page content scripts. Initialized from scripts.js file.
 *
 *
 */

class ProfileSettings {
  constructor() {
    // Initialization of the page plugins
    this._initMoveContent();
    this._initGenderSelect();
    this._initBirthdayDatePicker();
  }

  // Moving menu for responsive sizes
  _initMoveContent() {
    if (document.querySelector('#settingsMoveContent') && typeof MoveContent !== 'undefined') {
      const menuMove = document.querySelector('#settingsMoveContent');
      const targetSelectorMenu = menuMove.getAttribute('data-move-target');
      const moveBreakpointMenu = menuMove.getAttribute('data-move-breakpoint');
      const menuMoveContent = new MoveContent(menuMove, {
        targetSelector: targetSelectorMenu,
        moveBreakpoint: moveBreakpointMenu,
      });
    }
  }

  // Gender select2
  _initGenderSelect() {
    if (document.getElementById('genderSelect') !== null && jQuery().select2) {
      jQuery('#genderSelect').select2({minimumResultsForSearch: Infinity, placeholder: ''});
    }
  }

  // Birthday date picker
  _initBirthdayDatePicker() {
    if (document.getElementById('birthday') !== null && jQuery().datepicker) {
      jQuery('#birthday').datepicker({
        autoclose: true,
      });
    }
  }
}
