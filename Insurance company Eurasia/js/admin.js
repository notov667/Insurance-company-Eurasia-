'use strict';

let prem_users = document.getElementById('prem_users');
let all_users = document.getElementById('all_users');
let prem_users_table = document.querySelector('.prem_users_table');
let all_users_table = document.querySelector('.all_users_table');

prem_users.addEventListener('click', function(){
    prem_users.classList.add('_active');
    all_users.classList.remove('_active');
    prem_users_table.classList.add('_shown');
    all_users_table.classList.remove('_shown');
});
all_users.addEventListener('click', function(){
    prem_users.classList.remove('_active');
    all_users.classList.add('_active');
    prem_users_table.classList.remove('_shown');
    all_users_table.classList.add('_shown');
});