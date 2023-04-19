'use strict';

let mysubs = document.getElementById('mysubs');
let addsubs = document.getElementById('addsubs');
let settings = document.getElementById('settings_panel');

let mysubs_panel = document.querySelector('.mysubs');
let addsubs_panel = document.querySelector('.addsubs');
let settings_panel = document.querySelector('.settings_panel');

let able_subs_btn = document.getElementById('able_subs');
let disable_subs_btn = document.getElementById('disable_subs');
let active_subs = document.querySelector('.active_subs');
let inactive_subs = document.querySelector('.inactive_subs');

let old_pass = document.getElementById('old_pass');
let new_pass = document.getElementById('new_pass');
let change_btn = document.getElementById('change_btn');


mysubs.addEventListener('click', function(){
    mysubs.classList.add('_chosen');
    addsubs.classList.remove('_chosen');
    settings.classList.remove('_chosen');

    mysubs_panel.classList.add('_active');
    addsubs_panel.classList.remove('_active');
    settings_panel.classList.remove('_active');
});
addsubs.addEventListener('click', function(){
    mysubs.classList.remove('_chosen');
    addsubs.classList.add('_chosen');
    settings.classList.remove('_chosen');

    mysubs_panel.classList.remove('_active');
    addsubs_panel.classList.add('_active');
    settings_panel.classList.remove('_active');
});
settings.addEventListener('click', function(){
    mysubs.classList.remove('_chosen');
    addsubs.classList.remove('_chosen');
    settings.classList.add('_chosen');

    mysubs_panel.classList.remove('_active');
    addsubs_panel.classList.remove('_active');
    settings_panel.classList.add('_active');
});


able_subs_btn.addEventListener('click', function(){
    able_subs_btn.classList.add('mysubs_nav_active');
    disable_subs_btn.classList.remove('mysubs_nav_active');
    active_subs.classList.add('_show_p');
    inactive_subs.classList.remove('_show_p');
});
disable_subs_btn.addEventListener('click', function(){
    able_subs_btn.classList.remove('mysubs_nav_active');
    disable_subs_btn.classList.add('mysubs_nav_active');
    active_subs.classList.remove('_show_p');
    inactive_subs.classList.add('_show_p');
});


old_pass.addEventListener('input', function(){
    if (old_pass.value != '') {
        change_btn.disabled = true;
        new_pass.disabled = false;
        new_pass.parentElement.classList.add('_error');
        new_pass.classList.add('_error');

        new_pass.addEventListener('input', function(){
            if (PassTest(new_pass)) {
                change_btn.disabled = false;
                new_pass.parentElement.classList.remove('_error');
                new_pass.classList.remove('_error');
            }
            else {
                change_btn.disabled = true;
                new_pass.parentElement.classList.add('_error');
                new_pass.classList.add('_error');
            }
        });
    }
    else {
        change_btn.disabled = false;
        new_pass.disabled = true;
        new_pass.parentElement.classList.remove('_error');
        new_pass.classList.remove('_error');
    }
});



//password validation
function PassTest(input) {
    return /(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z!@#$%^&*]{8,}/.test(input.value);
  }