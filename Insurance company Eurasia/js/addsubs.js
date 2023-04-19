'use strict';

let date_show = document.getElementById('date_show');
let car_num = document.getElementById('car_num');
let addsubs_btn = document.getElementById('addsubs_btn');

let period1 = document.getElementById('date_period1');
let period2 = document.getElementById('date_period2');

let typepackage = document.getElementById('addsubs_choice');
let price_show = document.getElementById('price_show');
let price = 0;
let factor = 1;


    

document.addEventListener('DOMContentLoaded', function(){
    car_num.parentElement.classList.remove('_error');
    car_num.classList.remove('_error');

    if (typepackage.value == 'osago') {
        price = 6555 * factor;
    }
    else if (typepackage.value == 'casco') {
        price = 9000 * factor;
    }
    else if (typepackage.value == 'green') {
        price = 5660 * factor;
    }
    else {
        price = 0;
    }

    price_show.value = price;

    car_num.addEventListener('input', function() {
        if (Autonumtest(car_num) || Autonumtest2(car_num)) {
            addsubs_btn.disabled = false;
            car_num.parentElement.classList.remove('_error');
            car_num.classList.remove('_error');
        }
        else {
            addsubs_btn.disabled = true;
            car_num.parentElement.classList.add('_error');
            car_num.classList.add('_error');
        }
    });

    var today = new Date();
    var enddate = new Date();
    enddate.setMonth(enddate.getMonth() + 6);
    date_show.value = today.toLocaleDateString() + '-' + enddate.toLocaleDateString();

    period1.addEventListener('click', function(){
        today = new Date();
        enddate = new Date();
        enddate.setMonth(enddate.getMonth() + 6);
        date_show.value = today.toLocaleDateString() + '-' + enddate.toLocaleDateString();
        
        factor = 1;
        
        if (typepackage.value == 'osago') {
            price = 6555 * factor;
        }
        else if (typepackage.value == 'casco') {
            price = 9000 * factor;
        }
        else if (typepackage.value == 'green') {
            price = 5660 * factor;
        }
        else {
            price = 0;
        }
        price_show.value = price;
    })
    period2.addEventListener('click', function(){
        today = new Date();
        enddate = new Date();
        enddate.setMonth(enddate.getMonth() + 12);
        date_show.value = today.toLocaleDateString() + '-' + enddate.toLocaleDateString();
        
        factor = 1.8;

        if (typepackage.value == 'osago') {
            price = 6555 * factor;
        }
        else if (typepackage.value == 'casco') {
            price = 9000 * factor;
        }
        else if (typepackage.value == 'green') {
            price = 5660 * factor;
        }
        else {
            price = 0;
        }
    })

    price_show.value = price;
});


// gov num auto
function Autonumtest(input) {
    return /^[0-9]{3}[a-zA-Z_-]{3}[0-9]{2}$/.test(input.value);
}
function Autonumtest2(input) {
    return /^[a-zA-Z_-]{1}[0-9]{3}[a-zA-Z_-]{3}$/.test(input.value);
}