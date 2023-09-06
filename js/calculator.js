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

function focusInput() {
    calc_input.focus();
}

function updateCalcValue(v) {
    calc_input.value = v;
    focusInput();
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
    getProductByBarcode(calc_input.value);
}

function pressBackspace() {
    calc_input_value = calc_input_value.slice(0, -1);
    updateCalcValue(calc_input_value);
}

function isNumeric(value) {
    return /^-?\d+$/.test(value);
}