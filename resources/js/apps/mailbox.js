/**
 *
 * Email
 * A very basic and static implementation for the application mostly to show different layouts it has. Edit this class according to your project needs.
 * Implemented with a static data from json/mailbox.json file.
 *
 */

class Mailbox {
  get options() {
    return {};
  }

  constructor(options = {}) {
    this.settings = Object.assign(this.options, options);
    this.emailListContainer = document.getElementById('emailListContainer');
    this.emailCorrespondenceContainer = document.getElementById('emailCorrespondenceContainer');
    this.emailListTemplate = document.getElementById('emailListTemplate');
    this.emailListBadgeTemplate = document.getElementById('emailListBadgeTemplate');
    this.checkAllButton = document.getElementById('checkAllButton');
    this.backButton = document.getElementById('backButton');
    this.replyButton = document.getElementById('replyButton');
    this.forwardButton = document.getElementById('forwardButton');
    this.detailBottomButtons = document.getElementById('detailBottomButtons');
    this.replyEmailForm = document.getElementById('replyEmailForm');
    this.replyDeleteButton = document.getElementById('replyDeleteButton');
    this.emailSearch = document.getElementById('emailSearch');
    this.emailMenuButton = document.getElementById('emailMenuButton');
    this.emailMenuModal = new bootstrap.Modal(document.getElementById('emailMenuModal'));
    this.newEmailButton = document.getElementById('newEmailButton');
    this.newEmailModal = new bootstrap.Modal(document.getElementById('newEmailModal'));

    this.currentShowSettings = {folder: 'inbox', starred: 'All', important: 'All', tags: 'All'}; // Items are rendered based on this variable which is retrieved from the menu items upon click
    this.activeMenuId = 1;
    this.currentScreen = null; // list - detail
    this.fuseOptions = {
      includeScore: true,
      keys: ['title', 'from', 'detail'],
      threshold: 0.4,
    };
    Helpers.FetchJSON(Helpers.UrlFix('/json/mailbox.json'), (data) => {
      this.emailData = data;
      this._init();
    });
    if (typeof baguetteBox !== 'undefined') {
      this._initLightbox();
    }
  }

  _init() {
    this._showListScreen();
    this._renderItems();
    this._initMoveContent();
    this._addListeners();
    this._initEmailAddress();
    this._initEmailEditor();
    this._initCheckAll();
  }

  // Renders item based on the data property, if its not provided emailData will be used
  _renderItems(data) {
    this.emailListContainer.innerHTML = '';
    const showSettings = this.currentShowSettings;
    const renderData = data || this.emailData;
    renderData[showSettings.folder].map((email) => {
      const tagString = this._getTagStringByEmail(email);
      if (
        (showSettings.starred === email.starred || showSettings.starred.toString().includes('All')) &&
        (showSettings.important === email.important || showSettings.important.toString().includes('All')) &&
        (tagString.includes(showSettings.tags) || showSettings.tags.includes('All'))
      ) {
        this._renderListItem(email);
      }
    });
    this._initClamp();
  }

  // Renders a single email list item
  _renderListItem(email) {
    var itemClone = this.emailListTemplate.content.cloneNode(true).querySelector('div');
    itemClone.setAttribute('data-id', email.id);
    if (email.emails.length > 1) {
      itemClone.querySelector('.from').innerHTML = email.from + ' (' + email.emails.length + ')';
    } else {
      itemClone.querySelector('.from').innerHTML = email.from;
    }
    itemClone.querySelector('.title').innerHTML = email.title;
    itemClone.querySelector('.detail').innerHTML = email.detail;
    itemClone.querySelector('.dateTime').innerHTML = email.dateTime;
    if (email.unread) {
      itemClone.querySelector('.from').classList.add('text-body');
      itemClone.querySelector('.title').classList.add('text-body');
      itemClone.querySelector('.from').classList.add('fw-bold');
      itemClone.querySelector('.title').classList.add('fw-bold');
    } else {
      itemClone.querySelector('.from').classList.add('text-alternate');
      itemClone.querySelector('.title').classList.add('text-alternate');
    }
    if (email.starred && itemClone.querySelector('.star')) {
      itemClone.querySelector('.star').classList.remove('invisible');
    }
    if (email.important && itemClone.querySelector('.bell')) {
      itemClone.querySelector('.bell').classList.remove('invisible');
    }
    email.tags.map((tag) => {
      var badgeClone = this.emailListBadgeTemplate.content.cloneNode(true).querySelector('span');
      badgeClone.innerHTML = tag.title;
      itemClone.querySelector('.badges').append(badgeClone);
    });
    this.emailListContainer.append(itemClone);
    // Calling icon initialization
    new AcornIcons().replace();
  }

  // Clamp js initialization to add dynamic ellipsis to the list items
  _initClamp() {
    document.querySelectorAll('.clamp-line').forEach((el) => {
      const line = el.getAttribute('data-line');
      if (line) {
        $clamp(el, {clamp: parseInt(line)});
      }
    });
  }

  // Application wide listeners for interface elements
  _addListeners() {
    this.emailListContainer && this.emailListContainer.addEventListener('click', this._onEmailClick.bind(this));
    this.emailMenuButton && this.emailMenuButton.addEventListener('click', this._showEmailMenuModal.bind(this));
    this.newEmailButton && this.newEmailButton.addEventListener('click', this._showNewEmailModal.bind(this));
    this.backButton && this.backButton.addEventListener('click', this._backButtonClick.bind(this));
    this.replyButton && this.replyButton.addEventListener('click', this._replyButtonClick.bind(this));
    this.forwardButton && this.forwardButton.addEventListener('click', this._forwardButtonClick.bind(this));
    this.replyDeleteButton && this.replyDeleteButton.addEventListener('click', this._replyDeleteButtonClick.bind(this));
    this.emailSearch && this.emailSearch.addEventListener('keydown', Helpers.Debounce(this._onSearchKeyDown.bind(this), 500).bind(this));
  }

  // Turning tags to string for filtering
  _getTagStringByEmail(email) {
    var tagString = '';
    email.tags.map((tag) => {
      tagString += tag.title;
    });
    return tagString;
  }

  // Menu click listeners which needs to be added every time menu moved to modal for mobile screens and back for desktop
  _addMenuListeners() {
    document.querySelector('.menu-items') && document.querySelector('.menu-items').addEventListener('click', this._onMenuClick.bind(this));
  }

  _initEmailAddress() {
    if (typeof Tagify !== 'undefined') {
      if (document.querySelector('#replyEmailAddress') !== null) {
        new Tagify(document.querySelector('#replyEmailAddress'));
      }
      if (document.querySelector('#composeEmailAddress') !== null) {
        new Tagify(document.querySelector('#composeEmailAddress'));
      }
    }
  }

  _initEmailEditor() {
    if (typeof Quill !== 'undefined') {
      Quill.register('modules/active', Active);
      const editorModules = {
        toolbar: [
          ['bold', 'italic', 'underline', 'strike'],
          [{header: [1, 2, 3, 4, 5, 6, false]}],
          [{list: 'ordered'}, {list: 'bullet'}],
          [{size: ['small', false, 'large', 'huge']}],
          [{color: []}],
          [{align: []}],
        ],
        active: {},
      };
      if (document.getElementById('quillEditorFilledEmail')) {
        new Quill('#quillEditorFilledEmail', {
          modules: editorModules,
          theme: 'bubble',
          placeholder: 'Answer',
        });
      }
      if (document.getElementById('quillEditorFilledEmailNew')) {
        new Quill('#quillEditorFilledEmailNew', {
          modules: editorModules,
          theme: 'bubble',
          placeholder: 'Message',
        });
      }
    }
  }

  // Check all button initialization
  _initCheckAll() {
    new Checkall(document.querySelector('.check-all-container-checkbox-click .btn-custom-control'), {clickSelector: '.form-check'});
  }

  // Calls item renderer based on the menu items data-show dom attribute
  _onMenuClick(event) {
    const target = event.target;
    const button = event.target.closest('.mailbox-menu-item');
    if (button) {
      event.preventDefault();
    } else {
      return;
    }
    const showSettings = JSON.parse(button.getAttribute('data-show'));
    this.currentShowSettings = showSettings;
    this._renderItems();
    this._setActiveMenuItem(button);
    this._hideEmailMenuModal();
    this._showListScreen();
  }

  // Sets the active menu item
  _setActiveMenuItem(element) {
    document.querySelectorAll('.mailbox-menu-item').forEach((button) => {
      button.classList.remove('active');
    });
    element.classList.add('active');
    this.activeMenuId = parseInt(element.getAttribute('data-menuid'));
  }

  // Resetting active menu item after moving for mobile or desktop
  _setActiveMenuItemAfterMove() {
    document.querySelectorAll('.mailbox-menu-item').forEach((button) => {
      button.classList.remove('active');
      if (parseInt(button.getAttribute('data-menuid')) === this.activeMenuId) {
        button.classList.add('active');
      }
    });
  }

  // Left menu MoveContent plugin initialization for mobile and desktop view
  _initMoveContent() {
    if (document.querySelector('#emailMoveContent') && typeof MoveContent !== 'undefined') {
      const mailboxMenuMove = document.querySelector('#emailMoveContent');
      const targetSelectorMenu = mailboxMenuMove.getAttribute('data-move-target');
      const moveBreakpointMenu = mailboxMenuMove.getAttribute('data-move-breakpoint');
      const emailMoveContent = new MoveContent(mailboxMenuMove, {
        targetSelector: targetSelectorMenu,
        moveBreakpoint: moveBreakpointMenu,
        afterMove: (placement) => {
          this._hideEmailMenuModal();
          this._addMenuListeners();
          this._setActiveMenuItemAfterMove();
        },
      });
    }
  }

  // Fuse implementation and rendering for keydown event of the search input
  _onSearchKeyDown(event) {
    const value = emailSearch.value;
    if (value === '') {
      this._renderItems();
      return;
    }
    this.fuse = new Fuse(this.emailData[this.currentShowSettings.folder], this.fuseOptions);
    var result = this.fuse.search(value);
    result = result.map((r) => {
      return r.item;
    });
    var resultObject = {};
    resultObject[this.currentShowSettings.folder] = result;
    this._renderItems(resultObject);
  }

  // Hides the menu modal which is available on mobile screen sizes
  _hideEmailMenuModal() {
    this.emailMenuModal.hide();
  }

  // Show the menu modal which is available on mobile screen sizes
  _showEmailMenuModal() {
    this.emailMenuModal.show();
  }

  // Show the new email modal
  _showNewEmailModal() {
    this.newEmailModal.show();
  }

  // Click listener for the list items
  _onEmailClick(event) {
    const target = event.target.closest('.email-list-item');
    const checkbox = event.target.closest('.form-check');
    if (target && !checkbox) {
      this._showDetailScreen();
    }
  }

  // Switches to static correspondence screen
  _showDetailScreen() {
    if (this.currentScreen === 'detail') {
      return;
    }
    this.emailCorrespondenceContainer.classList.remove('d-none');
    this.emailListContainer.classList.add('d-none');
    this.checkAllButton.classList.add('d-none');
    this.backButton.classList.remove('d-none');
    this.detailBottomButtons.classList.remove('d-none');
    this.replyEmailForm.classList.add('d-none');
    this.currentScreen = 'detail';
  }

  // Switches to list screen
  _showListScreen() {
    if (this.currentScreen === 'list') {
      return;
    }
    this.emailCorrespondenceContainer.classList.add('d-none');
    this.emailListContainer.classList.remove('d-none');
    this.checkAllButton.classList.remove('d-none');
    this.backButton.classList.add('d-none');
    this.currentScreen = 'list';
  }

  // Back button listener on the correspondence
  _backButtonClick(event) {
    this._showListScreen();
  }

  // Reply button listener at the bottom of the correspondence, shows the email reply/forward interface
  _replyButtonClick(event) {
    this.detailBottomButtons.classList.add('d-none');
    this.replyEmailForm.classList.remove('d-none');
    window.scrollTo(0, document.body.scrollHeight);
  }

  // Forward button listener at the bottom of the correspondence, shows the email reply/forward interface
  _forwardButtonClick(event) {
    this.detailBottomButtons.classList.add('d-none');
    this.replyEmailForm.classList.remove('d-none');
    window.scrollTo(0, document.body.scrollHeight);
  }

  // Removes the reply/forward interface
  _replyDeleteButtonClick(event) {
    this.replyEmailForm.classList.add('d-none');
    this.detailBottomButtons.classList.remove('d-none');
  }

  _initLightbox() {
    baguetteBox.run('.lightbox');
  }
}
