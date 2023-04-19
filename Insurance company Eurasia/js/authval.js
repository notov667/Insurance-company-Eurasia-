'use strict';

let formReq = document.querySelectorAll('._req');

let login_tel = document.getElementById('login_tel');
let login_pass = document.getElementById('password');
let log_btn = document.getElementById('login_btn');


document.addEventListener('DOMContentLoaded', function() {
    for (let index = 0; index < formReq.length; index++) {
      const input = formReq[index];
      input.addEventListener('input', function() {
        if (input.classList.contains('_tel')) {
            if (TelTest(input)) {
                FormRemoveError(input);
            }
            else {
                FormAddError(input);
            }
        }
        else if (input.classList.contains('_pass')) {
            if (PassTest(input)) {
                FormRemoveError(input);
            }
            else {
                FormAddError(input);
            }
        }
        else {
            if (input.value == '') {
                FormAddError(input);
            }
        }
        if (login_tel.classList.contains('_success') && login_pass.classList.contains('_success')) {
            log_btn.disabled = false;
        }
        else {
            log_btn.disabled = true;
        }
      });

    }
});

function FormAddError(input) {
  input.parentElement.classList.add('_error');
  input.classList.add('_error');
  input.classList.remove('_success');
}
function FormRemoveError(input) {
  input.parentElement.classList.remove('_error');
  input.classList.remove('_error');
  input.classList.add('_success');
}

//tel validation
function TelTest(input) {
  return /^[\d\+][\d\(\)\ -]{9,10}\d$/.test(input.value);
}
//password validation
function PassTest(input) {
  return /(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z!@#$%^&*]{8,}/.test(input.value);
}
