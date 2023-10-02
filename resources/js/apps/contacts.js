/**
 *
 * Contacts
 * A very basic and static implementation for the application mostly to show different layouts it has. Edit this class according to your project needs.
 * Implemented with the help of list.js and with a static data from json/contacts.json file.
 *
 */

class Contacts {
  get options() {
    return {
      emptyThumb: Helpers.UrlFix('/img/profile/profile-11.webp'),
    };
  }

  constructor(options = {}) {
    this.settings = Object.assign(this.options, options);

    this.contactModal = new bootstrap.Modal(document.getElementById('contactModal'));
    this.deleteConfirmModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));

    Helpers.FetchJSON(Helpers.UrlFix('/json/contacts.json'), (data) => {
      this.contacts = data.map((d) => {
        return {
          ...d,
          thumb: Helpers.UrlFix(d.thumb),
        };
      });
      this._init();
    });
  }

  _init() {
    this.contactContainer = document.querySelector('#contacts .list');
    this.currentItem = null;
    this.listjs = null;
    this.deletingMultiple = false;
    this._addListeners();
    this._initListjs();
    this._initProfileUpload();
    this._initGroupSelect();
    this._initCheckAll();
  }

  _addListeners() {
    this.contactContainer.addEventListener('click', this._onContainerClick.bind(this));
    document.getElementById('newContactButton') && document.getElementById('newContactButton').addEventListener('click', this._showAddModal.bind(this));
    document.getElementById('deleteContact') && document.getElementById('deleteContact').addEventListener('click', this._deleteContact.bind(this));
    document.getElementById('addContact') && document.getElementById('addContact').addEventListener('click', this._addContact.bind(this));
    document.getElementById('saveContact') && document.getElementById('saveContact').addEventListener('click', this._saveContact.bind(this));
    document.getElementById('deleteConfirmButton') &&
      document.getElementById('deleteConfirmButton').addEventListener('click', this._deleteContactConfirm.bind(this));
    document.getElementById('deleteChecked') && document.getElementById('deleteChecked').addEventListener('click', this._deleteChecked.bind(this));
  }

  // Select2 plugin initialization in the add/edit modal
  _initGroupSelect() {
    if (jQuery().select2) {
      jQuery('#contactGroupModal').select2({minimumResultsForSearch: Infinity});
    }
  }

  // Check all button initialization
  _initCheckAll() {
    new Checkall(document.querySelector('.check-all-container-checkbox-click .btn-custom-control'), {clickSelector: '.form-check'});
  }

  // Initializing list.js with the values
  _initListjs() {
    this.listjs = new List(
      document.querySelector('#contacts'),
      {
        valueNames: ['id', 'name', 'email', 'phone', 'group', 'position', {name: 'thumb', attr: 'src'}],
        item: 'contactItemTemplate',
        page: 8,
        pagination: [
          {
            includeDirectionLinks: true,
            leftDirectionText: '<i class="cs-chevron-left"></i>',
            rightDirectionText: '<i class="cs-chevron-right"></i>',
            liClass: 'page-item',
            aClass: 'page-link shadow',
            innerWindow: 1000, // Hiding ellipsis
          },
        ],
      },
      this.contacts,
    );
    this.listjs.sort('id', {order: 'desc'});
    this.listjs.on('updated', function (obj) {});
  }

  // List item click event
  _onContainerClick(event) {
    if (!event.target.closest('.view-click')) {
      return;
    }
    event.preventDefault();
    const parent = event.target.closest('.card');
    const id = parent.querySelector('.id').innerHTML;
    this.currentItem = this.listjs.get('id', id)[0];
    this._showDetailModal();
  }

  // Empty modal to add new
  _showAddModal(event) {
    this._clearAddEditModal();
    this._enableAdd();
    this.contactModal.show();
  }

  // Shows item on the modal after click
  _showDetailModal() {
    document.getElementById('contactNameModal').value = this.currentItem.values().name;
    document.getElementById('contactPositionModal').value = this.currentItem.values().position;
    document.getElementById('contactEmailModal').value = this.currentItem.values().email;
    document.getElementById('contactPhoneModal').value = this.currentItem.values().phone;
    document.getElementById('contactGroupModal').value = this.currentItem.values().group;
    document.getElementById('contactThumbModal').setAttribute('src', this.currentItem.values().thumb);

    jQuery('#contactGroupModal').trigger('change');
    this.contactModal.show();
    this._enableEdit();
  }

  // Updating an item
  _saveContact() {
    const id = this.currentItem.values().id;
    const valuesFromModal = this._getCurrentDataFromModal(id);
    this.currentItem.values(valuesFromModal);
    this.contactModal.hide();
    // Data can be synced here with the backend
  }

  // Adding a new item
  _addContact() {
    const items = this.listjs.items.map((item) => item.values());
    const nextId = Helpers.NextId(items, 'id');
    const newContact = this._getCurrentDataFromModal(nextId);
    this.listjs.add(newContact);
    this.contactModal.hide();
    // this.listjs.update();
    this.listjs.sort('id', {order: 'desc'});

    // Data can be synced here with the backend
  }

  // Showing confirmation for deleting an item
  _deleteContact(event) {
    this.deletingMultiple = false;
    document.getElementById('deleteConfirmDetail').innerHTML = this.currentItem.values().name;
    this.deleteConfirmModal.show();
  }

  // Showing confirmation for deleting multiple items
  _deleteChecked(event) {
    this.deletingMultiple = true;
    const selectedItems = document.querySelectorAll('.list .card.selected');
    if (selectedItems.length > 0) {
      document.getElementById('deleteConfirmDetail').innerHTML = selectedItems.length + ' item' + (selectedItems.length > 1 ? 's' : '');
      this.deleteConfirmModal.show();
    }
  }

  // Deleting an item or multiple based on the deletingMultiple variable
  _deleteContactConfirm(event) {
    if (this.deletingMultiple) {
      // Deleting multiple items
      const selectedItems = document.querySelectorAll('.list .card.selected');
      selectedItems.forEach((item) => {
        this.listjs.remove('id', item.querySelector('.id').innerHTML);
      });
    } else {
      // Deleting single item
      const id = this.currentItem.values().id;
      this.listjs.remove('id', id);
    }
    this.contactModal.hide();
    this.deleteConfirmModal.hide();
    const checkAllInput = document.querySelector('.check-all-container-checkbox-click .btn-custom-control input');
    checkAllInput.indeterminate = false;
    checkAllInput.checked = false;
    // Data can be synced here with the backend
  }

  // Getting values from the inputs
  _getCurrentDataFromModal(id) {
    return {
      name: document.getElementById('contactNameModal').value,
      position: document.getElementById('contactPositionModal').value,
      email: document.getElementById('contactEmailModal').value,
      phone: document.getElementById('contactPhoneModal').value,
      group: document.getElementById('contactGroupModal').value,
      thumb: document.getElementById('contactThumbModal').getAttribute('src'),
      id: id,
    };
  }

  // Simple image uplader
  _initProfileUpload() {
    if (typeof SingleImageUpload !== 'undefined') {
      const singleImageUpload = new SingleImageUpload(document.getElementById('imageUpload'), {
        fileSelectCallback: (file) => {
          console.log(file);
          // Upload the file with fetch method
          // let formData = new FormData();
          // formData.append("file", file);
          // formData.append("id", this.currentItemData.id);
          // fetch('/upload/image', { method: "POST", body: formData });
        },
      });
    }
  }

  // Clearing values of the modal
  _clearAddEditModal() {
    document.getElementById('contactNameModal').value = '';
    document.getElementById('contactPositionModal').value = '';
    document.getElementById('contactEmailModal').value = '';
    document.getElementById('contactPhoneModal').value = '';
    document.getElementById('contactGroupModal').value = null;
    document.getElementById('contactThumbInputModal').value = null;
    document.getElementById('contactThumbModal').setAttribute('src', this.settings.emptyThumb);
    jQuery('#contactGroupModal').trigger('change');
  }

  _enableEdit() {
    this._showElement('saveContact');
    this._showElement('deleteContact');
    this._hideElement('addContact');
  }

  _enableAdd() {
    this._hideElement('saveContact');
    this._hideElement('deleteContact');
    this._showElement('addContact');
  }

  _showElement(selector) {
    document.getElementById(selector) && document.getElementById(selector).classList.add('d-inline-block');
    document.getElementById(selector) && document.getElementById(selector).classList.remove('d-none');
  }

  _hideElement(selector) {
    document.getElementById(selector) && document.getElementById(selector).classList.remove('d-inline-block');
    document.getElementById(selector) && document.getElementById(selector).classList.add('d-none');
  }
}
