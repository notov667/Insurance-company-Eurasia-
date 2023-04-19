'use strick'


let login_btn = document.querySelector('.nav_btn');
let have_account = document.getElementById('have_account');
let no_account = document.getElementById('no_account');
let login_panel = document.getElementById('login');
let reg_panel = document.getElementById('reg');
let popUp = document.getElementById('popUp');
let body = document.getElementById('body');



document.addEventListener('DOMContentLoaded', function (e) {
    login_btn.addEventListener('click', function () {
        
        if (getCookie('user') != undefined) {
            window.open("../lk.php", "_self");
        }
        else {
            reg_panel.classList.remove('show');
            login_panel.classList.add('show');
            popUp.classList.add('show');
            body.classList.add('locked');
            
            login_form.reset();
            reg_form.reset();
        }
    });
    have_account.addEventListener('click', function () {
        reg_panel.classList.remove('show');
        login_panel.classList.add('show');

        login_form.reset();
        reg_form.reset();
    });
    no_account.addEventListener('click', function () {
        reg_panel.classList.add('show');
        login_panel.classList.remove('show');
        
        login_form.reset();
        reg_form.reset();
    });

});

function getCookie(cName) {
    const name = cName + "=";
    const cDecoded = decodeURIComponent(document.cookie); //to be careful
    const cArr = cDecoded.split('; ');
    let res;
    cArr.forEach(val => {
        if (val.indexOf(name) === 0) res = val.substring(name.length);
    })
    return res
}

function ClosePopUp(){
    popUp.classList.remove('show');
    body.classList.remove('locked');
}
