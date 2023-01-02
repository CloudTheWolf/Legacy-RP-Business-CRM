/**
 *
 * AuthResetPassword
 *
 * Pages.Authentication.ResetPassword page content scripts. Initialized from scripts.js file.
 *
 *
 */

class AuthResetPassword {
  constructor() {
    // Initialization of the page plugins
    this._initForm();
  }

  // Form validation
  _initForm() {
    const form = document.getElementById('resetForm');
    if (!form) {
      return;
    }
    const validateOptions = {
      rules: {
        password: {
          required: true,
          minlength: 6,
          regex: /[a-z].*[0-9]|[0-9].*[a-z]/i,
        },
        verifyPassword: {
          required: true,
          minlength: 6,
          regex: /[a-z].*[0-9]|[0-9].*[a-z]/i,
          equalTo: '#password',
        },
      },
      messages: {
        password: {
          minlength: 'Password must be at least {0} characters!',
          regex: 'Password must contain a letter and a number!',
        },
        verifyPassword: {
          minlength: 'Password must be at least {0} characters!',
          regex: 'Password must contain a letter and a number!',
          equalTo: 'Passwords must match!',
        },
      },
    };
    jQuery(form).validate(validateOptions);
    form.addEventListener('submit', (event) => {
      event.preventDefault();
      event.stopPropagation();
      if (jQuery(form).valid()) {
        const formValues = {
          email: form.querySelector('[name="password"]').value,
          verifyPassword: form.querySelector('[name="verifyPassword"]').value,
        };
        console.log(formValues);
        return;
      }
    });
  }
}
