/**
 *
 * AuthForgotPassword
 *
 * Pages.Authentication.ForgotPassword page content scripts. Initialized from scripts.js file.
 *
 *
 */

class AuthForgotPassword {
  constructor() {
    // Initialization of the page plugins
    this._initForm();
  }

  // Form validation
  _initForm() {
    const form = document.getElementById('forgotPasswordForm');
    if (!form) {
      return;
    }
    const validateOptions = {
      rules: {
        forgotPasswordEmail: {
          required: true,
          email: true,
        },
      },
      messages: {
        forgotPasswordEmail: {
          email: 'Your email address must be in correct format!',
        },
      },
    };
    jQuery(form).validate(validateOptions);
    form.addEventListener('submit', (event) => {
      event.preventDefault();
      event.stopPropagation();
      if (jQuery(form).valid()) {
        const formValues = {
          email: form.querySelector('[name="forgotPasswordEmail"]').value,
        };
        console.log(formValues);
        return;
      }
    });
  }
}
