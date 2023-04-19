'use strict';

let formReq = document.querySelectorAll('._req');

let reg_iin = document.getElementById('iin_num');
let reg_tel = document.getElementById('reg_tel');
let reg_email = document.getElementById('reg_email');
let reg_pass = document.getElementById('reg_pass');
let reg_btn = document.getElementById('reg_btn');


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
        else if (input.classList.contains('_iin')) {
            if (IINTest(input)) {
                FormRemoveError(input);
            }
            else {
                FormAddError(input);
            }
        }
        else if (input.classList.contains('_email')) {
            if (EmailTest(input)) {
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
        if (reg_iin.classList.contains('_success') && reg_tel.classList.contains('_success') && reg_email.classList.contains('_success') && reg_pass.classList.contains('_success')) {
            reg_btn.disabled = false;
        }
        else {
            reg_btn.disabled = true;
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

//iin validation
function IINTest(input) {
  return /^[0-9]{12}$/.test(input.value);
}
//tel validation
function TelTest(input) {
  return /^[\d\+][\d\(\)\ -]{9,10}\d$/.test(input.value);
}
//email validation
function EmailTest(input) {
  return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,8})+$/.test(input.value);
}
//password validation
function PassTest(input) {
  return /(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z!@#$%^&*]{8,}/.test(input.value);
}
