/**
 *
 * Tasks
 * A very basic and static implementation for the application mostly to show different layouts it has. Edit this class according to your project needs.
 * Implemented with a static data from json/tasks.json file.
 *
 */

class Tasks {
  get options() {
    return {};
  }

  constructor(options = {}) {
    this.settings = Object.assign(this.options, options);
    this.taskItemTemplate = document.getElementById('taskItemTemplate');
    this.taskTagTemplate = document.getElementById('taskTagTemplate');
    this.tasksContainer = document.getElementById('tasksContainer');
    this.noTasksFoundTemplate = document.getElementById('noTasksFound');

    this.tasksMenuButton = document.getElementById('tasksMenuButton');
    this.tasksMenuModal = new bootstrap.Modal(document.getElementById('tasksMenuModal'));
    this.newTaskButton = document.getElementById('newTaskButton');
    this.newTaskModal = new bootstrap.Modal(document.getElementById('newTaskModal'));

    this.currentShowSettings = {deleted: false, status: 'All', tags: 'All'}; // Items are rendered based on this variable which is retrieved from the menu items upon click
    this.activeMenuId = 1;
    this.currentData = null;
    this.fuse = null;
    this.fuseOptions = {
      includeScore: true,
      keys: ['title'],
      threshold: 0.4,
    };
    Helpers.FetchJSON(Helpers.UrlFix('/json/tasks.json'), (data) => {
      this.taskData = data.tasks;
      this.tagsData = data.tags;
      this._init();
    });
  }

  _init() {
    this._addListeners();
    this._initMoveContent();
    this._initTagsSelect2();
    this._initStatusSelect2();
    this._renderItems();
  }

  // Renders item based on the data property, if its not provided taskData will be used and currentData will be populated
  _renderItems() {
    this.tasksContainer.innerHTML = '';
    const showSettings = this.currentShowSettings;
    this.currentData = [];
    this.taskData.map((task) => {
      const tagString = this._getTagStringByTask(task);
      if (
        task.deleted === showSettings.deleted &&
        (showSettings.status.includes(task.status) || showSettings.status.includes('All')) &&
        (tagString.includes(showSettings.tags) || showSettings.tags.includes('All'))
      ) {
        this._renderItem(task);
        this.currentData.push(task);
      }
    });
    this._renderDropdownButtons(showSettings);
    this._renderNoResult(this.currentData);
    // Calling icon initialization
    new AcornIcons().replace();
  }

  // Works similar to _renderItems except creating and populating currentData variable
  _renderSearchResults(data) {
    this.tasksContainer.innerHTML = '';
    const showSettings = this.currentShowSettings;
    data.map((task) => {
      const tagString = this._getTagStringByTask(task);
      if (
        task.deleted === showSettings.deleted &&
        (showSettings.status.includes(task.status) || showSettings.status.includes('All')) &&
        (tagString.includes(showSettings.tags) || showSettings.tags.includes('All'))
      ) {
        this._renderItem(task);
      }
    });
    this._renderDropdownButtons(showSettings);
    this._renderNoResult(data);
  }

  // No results screen
  _renderNoResult(data) {
    if (data.length === 0) {
      var itemClone = this.noTasksFoundTemplate.content.cloneNode(true).querySelector('div');
      this.tasksContainer.append(itemClone);
    }
  }

  // Different dropdown options for deleted and normal items
  _renderDropdownButtons(showSettings) {
    if (showSettings.deleted) {
      this._showDeletedDropdownItems();
    } else {
      this._showRegularDropdownItems();
    }
  }

  // Renders single task item
  _renderItem(task) {
    var itemClone = this.taskItemTemplate.content.cloneNode(true).querySelector('div');
    itemClone.setAttribute('data-id', task.id);
    itemClone.querySelector('.title').innerHTML = task.title;
    itemClone.querySelector('.detail').innerHTML = task.detail;
    if (task.status !== 'Active') {
      itemClone.querySelector('.check-input').checked = true;
    }
    task.tags.map((tag) => {
      var tagClone = this.taskTagTemplate.content.cloneNode(true).querySelector('span');
      tagClone.innerHTML = tag.title;
      tagClone.classList.add(tag.class);
      itemClone.querySelector('.tags').append(tagClone);
    });
    this.tasksContainer.append(itemClone);
    itemClone.querySelector('.check-input').addEventListener('change', this._onCheckChange.bind(this));
  }

  // Left menu MoveContent plugin initialization for mobile and desktop view
  _initMoveContent() {
    if (document.querySelector('#tasksMenuMoveContent')) {
      const tasksMenuMove = document.querySelector('#tasksMenuMoveContent');
      const targetSelectorMenu = tasksMenuMove.getAttribute('data-move-target');
      const moveBreakpointMenu = tasksMenuMove.getAttribute('data-move-breakpoint');
      const tasksMenuMoveContent = new MoveContent(tasksMenuMove, {
        targetSelector: targetSelectorMenu,
        moveBreakpoint: moveBreakpointMenu,
        afterMove: (placement) => {
          this._hideTasksMenuModal();
          this._addMenuListeners();
          this._setActiveMenuItemAfterMove();
        },
      });
    }
  }

  // Hides the menu modal which is available on mobile screen sizes
  _hideTasksMenuModal() {
    this.tasksMenuModal.hide();
  }

  // Show the menu modal which is available on mobile screen sizes
  _showTasksMenuModal() {
    this.tasksMenuModal.show();
  }

  // Application wide listeners for interface elements
  _addListeners() {
    this._addMenuListeners();
    document.getElementById('newTaskAddButton') && document.getElementById('newTaskAddButton').addEventListener('click', this._addNewTaskClick.bind(this));

    this.newTaskButton && this.newTaskButton.addEventListener('click', this._showNewTaskModal.bind(this));
    this.tasksMenuButton && this.tasksMenuButton.addEventListener('click', this._showTasksMenuModal.bind(this));

    document.getElementById('saveTaskButton') && document.getElementById('saveTaskButton').addEventListener('click', this._saveTaskClick.bind(this));
    document.getElementById('taskSearch') &&
      document.getElementById('taskSearch').addEventListener('keydown', Helpers.Debounce(this._onSearchKeyDown.bind(this), 500).bind(this));
    this.tasksContainer && this.tasksContainer.addEventListener('click', this._onTaskDropdownButtonClick.bind(this));
  }

  // Menu click listeners which needs to be added every time menu moved to modal for mobile screens and back for desktop
  _addMenuListeners() {
    document.querySelector('.menu-items') && document.querySelector('.menu-items').addEventListener('click', this._onMenuClick.bind(this));
  }

  // Fuse implementation and rendering for keydown event of the search input
  _onSearchKeyDown(event) {
    const value = document.getElementById('taskSearch').value;
    if (value === '') {
      this._renderItems();
      return;
    }
    this.fuse = new Fuse(this.currentData, this.fuseOptions);
    var result = this.fuse.search(value);
    result = result.map((r) => {
      return r.item;
    });
    this._renderSearchResults(result);
  }

  // Calls item renderer based on the menu items data-show dom attribute
  _onMenuClick(event) {
    const target = event.target;
    const button = event.target.closest('.task-menu-item');
    if (button) {
      event.preventDefault();
    } else {
      return;
    }
    const showSettings = JSON.parse(button.getAttribute('data-show'));
    this.currentShowSettings = showSettings;
    this._renderItems();
    this._setActiveMenuItem(button);
    this._hideTasksMenuModal();
  }

  // Sets the active menu item
  _setActiveMenuItem(element) {
    document.querySelectorAll('.task-menu-item').forEach((button) => {
      button.classList.remove('active');
    });
    element.classList.add('active');
    this.activeMenuId = parseInt(element.getAttribute('data-menuid'));
  }

  // Resetting active menu item after moving for mobile or desktop
  _setActiveMenuItemAfterMove() {
    document.querySelectorAll('.task-menu-item').forEach((button) => {
      button.classList.remove('active');
      if (parseInt(button.getAttribute('data-menuid')) === this.activeMenuId) {
        button.classList.add('active');
      }
    });
  }

  // Turning tags to string for filtering
  _getTagStringByTask(task) {
    var tagString = '';
    task.tags.map((tag) => {
      tagString += tag.title;
    });
    return tagString;
  }

  // Returns an array of objects that contains title and class based on the tagTitles parameter
  _getTagsWithClasses(tagTitles) {
    var tagsWithClasses = [];
    tagTitles.map((title) => {
      tagsWithClasses.push(this._findTagObjectByTitle(title));
    });
    return tagsWithClasses;
  }

  // Returns a single tag item by the title
  _findTagObjectByTitle(title) {
    return this.tagsData.find((data) => {
      if (data.title === title) {
        return data;
      }
    });
  }

  // Returns tags with only their titles to fill edit form select
  _getTagsWithoutClasses(tags) {
    var tagsWithoutClasses = [];
    tags.map((tag) => {
      tagsWithoutClasses.push(tag.title);
    });
    return tagsWithoutClasses;
  }

  // Check change listener to change the status of the task and rerender
  _onCheckChange(event) {
    const target = event.target;
    const taskElement = event.target.closest('.task-item');
    if (!taskElement) {
      return;
    }
    const taskId = parseInt(taskElement.getAttribute('data-id'));
    var task = this._getDataById(taskId);
    if (target.checked) {
      task.status = 'Done';
    } else {
      task.status = 'Active';
    }
    setTimeout(() => {
      this._renderItems();
    }, 500);
  }

  // Customized Select2 for tags
  _initTagsSelect2() {
    function formatText(item) {
      if (jQuery(item.element).val()) {
        return jQuery(
          '<div><span class="align-middle d-inline-block option-circle me-2 rounded-xl ' +
            jQuery(item.element).data('class') +
            '"></span> <span class="align-middle d-inline-block lh-1">' +
            item.text +
            '</span></div>',
        );
      }
    }
    function formatTextSelection(item) {
      if (jQuery(item.element).val()) {
        return jQuery(
          '<span><span class="align-middle d-inline-block ms-1 ' + jQuery(item.element).data('selectionColor') + '">' + item.text + '</span></span>',
        );
      }
    }
    if (jQuery('#newTaskTags') && jQuery().select2) {
      jQuery('#newTaskTags').select2({
        minimumResultsForSearch: Infinity,
        templateSelection: formatTextSelection,
        templateResult: formatText,
      });
    }
  }

  _initStatusSelect2() {
    if (jQuery('#newTaskStatus') && jQuery().select2) {
      jQuery('#newTaskStatus').select2({minimumResultsForSearch: Infinity});
    }
  }

  // Adding new task to the array and rerendering
  _addNewTaskClick(event) {
    const newTask = {
      id: Helpers.NextId(this.taskData, 'id'),
      title: document.getElementById('newTaskTitle').value,
      detail: document.getElementById('newTaskDetail').value,
      status: document.getElementById('newTaskStatus').value,
      deleted: false,
      tags: this._getTagsWithClasses(jQuery('#newTaskTags').val()),
    };
    this.taskData.unshift(newTask);
    this._renderItems();
    this._clearAddNewForm();
    this.newTaskModal.hide();
  }

  // Showing the modal based on add new button click
  _showNewTaskModal(event) {
    this.newTaskModal.show();
    this._clearAddNewForm();
    document.getElementById('newTaskAddButton').classList.remove('d-none');
    document.getElementById('saveTaskButton').classList.add('d-none');
    document.getElementById('taskModalTitle').innerHTML = 'New Task';
  }

  // Clearing form after add or edit
  _clearAddNewForm() {
    document.getElementById('newTaskTitle').value = '';
    document.getElementById('newTaskDetail').value = '';
    document.getElementById('newTaskStatus').value = null;
    document.getElementById('newTaskTags').value = null;
    jQuery('#newTaskStatus').trigger('change');
    jQuery('#newTaskTags').trigger('change');
  }

  // Sets task's deleted property to true and rerenders
  _deleteTaskById(id) {
    var task = this._getDataById(id);
    task.deleted = true;
    this._renderItems();
  }

  // Sets task's deleted property to false and rerenders
  _undoDeleteTaskById(id) {
    var task = this._getDataById(id);
    task.deleted = false;
    this._renderItems();
  }

  // Removes task from the data array and rerenders
  _removeTaskById(id) {
    const taskIndex = this.taskData.findIndex((item) => {
      return item.id === id;
    });
    this.taskData.splice(taskIndex, 1);
    this._renderItems();
  }

  // Fills the add/edit form and shows it
  _editTaskById(id) {
    const task = this._getDataById(id);
    document.getElementById('newTaskTitle').value = task.title;
    document.getElementById('newTaskDetail').value = task.detail;
    document.getElementById('newTaskStatus').value = task.status;
    document.getElementById('newTaskModal').setAttribute('data-id', task.id);
    jQuery('#newTaskStatus').trigger('change');
    jQuery('#newTaskTags').val(this._getTagsWithoutClasses(task.tags)).trigger('change');
    this.newTaskModal.show();
    document.getElementById('newTaskAddButton').classList.add('d-none');
    document.getElementById('saveTaskButton').classList.remove('d-none');
    document.getElementById('taskModalTitle').innerHTML = 'Edit Task';
  }

  // Updates the currently editing form values in the data array and rerenders
  _saveTaskClick(event) {
    const taskData = {
      id: parseInt(document.getElementById('newTaskModal').getAttribute('data-id')),
      title: document.getElementById('newTaskTitle').value,
      detail: document.getElementById('newTaskDetail').value,
      status: document.getElementById('newTaskStatus').value,
      deleted: false,
      tags: this._getTagsWithClasses(jQuery('#newTaskTags').val()),
    };

    this._updateData(taskData.id, taskData);
    this._renderItems();
    this._clearAddNewForm();
    this.newTaskModal.hide();
  }

  // Updates a single data item from the task data array based on the provided id and data
  _updateData(id, data) {
    this.taskData = this.taskData.map((item) => {
      if (parseInt(item.id) === parseInt(id)) {
        return data;
      } else {
        return item;
      }
    });
  }

  // Click handlers for buttons in the dropdowns of the task card
  _onTaskDropdownButtonClick(event) {
    const taskDropdownButton = event.target.closest('.dropdown-item');
    const taskElement = event.target.closest('.task-item');
    if (taskDropdownButton && taskElement) {
      if (taskDropdownButton.classList.contains('edit-task')) {
        this._editTaskById(parseInt(taskElement.getAttribute('data-id')));
      }
      if (taskDropdownButton.classList.contains('delete-task')) {
        this._deleteTaskById(parseInt(taskElement.getAttribute('data-id')));
      }
      if (taskDropdownButton.classList.contains('undo-delete-task')) {
        this._undoDeleteTaskById(parseInt(taskElement.getAttribute('data-id')));
      }
      if (taskDropdownButton.classList.contains('delete-permanently-task')) {
        this._removeTaskById(parseInt(taskElement.getAttribute('data-id')));
      }
    }
  }

  // Standard dropdown buttons
  _showRegularDropdownItems() {
    document.querySelectorAll('.dropdown-item.edit-task').forEach((element) => {
      element.classList.remove('d-none');
    });
    document.querySelectorAll('.dropdown-item.delete-task').forEach((element) => {
      element.classList.remove('d-none');
    });
  }

  // Deleted dropdown buttons
  _showDeletedDropdownItems() {
    document.querySelectorAll('.dropdown-item.undo-delete-task').forEach((element) => {
      element.classList.remove('d-none');
    });
    document.querySelectorAll('.dropdown-item.delete-permanently-task').forEach((element) => {
      element.classList.remove('d-none');
    });
  }

  // Returns task data from the array by id
  _getDataById(id) {
    return this.taskData.find((data) => {
      if (data.id === id) {
        return data;
      }
    });
  }
}
