var calc_input = document.getElementById('calc__code');
var calc_input_value = '';

window.onload = focusInput

document.querySelectorAll('.calc__btn').forEach((x) => {
    x.addEventListener('click', () => {
        if (x.id == `key_multiply`) {

        } else if (x.id == `key_reset`) {
            resetValue();
        } else if (x.id == 'key_period') {
            addPeriod();
        } else if (x.id == 'key_enter') {
            pressEnter();
        } else if (x.id == 'key_close') {
            pressBackspace();
        }
        for (let i = 0; i <= 9; i++) {
            if (x.id == `key_${i}`) {
                calc_input_value += i;
                updateCalcValue(calc_input_value);
            }
        }
    });
});

// handle key press events
// ascii 48 - 57 reprsents 0 - 9
// 46 = period (".") | Enter
// 42 = multiply ("*")
// 08 = backspace
// 10 = enter
document.addEventListener('keydown', (e) => {
    if (e.key == 'Enter') {
        pressEnter();
    } else if (e.key == '.') {
        addPeriod();
    } else if (e.key == 'Backspace') {
        pressBackspace();
    } else if (isNumeric(e.key)) {
        calc_input_value += `${e.key}`;
        updateCalcValue(calc_input_value);
    }
});

calc_input.addEventListener('onfocus', () => {
    // end = calc_input_value.length;
    //calc_input.setSelectionRange(end - 1, end);
});

function focusInput() {
    calc_input.focus();
}

function updateCalcValue(v) {
    calc_input.value = v;
    // focusInput();
}

function addProductToCart() {

}

function resetValue() {
    calc_input_value = '';
    updateCalcValue(calc_input_value)
    focusInput()
}

function addPeriod() {
    calc_input_value += '.';
    updateCalcValue(calc_input_value);
}

function pressEnter() {
    addProductToCart();
    focusInput();
}

function pressBackspace() {
    calc_input_value = calc_input_value.slice(0, -1);
    updateCalcValue(calc_input_value);
}

function isNumeric(value) {
    return /^-?\d+$/.test(value);
}