var calc_input = document.getElementById('calc__code');
var calc_input_value = '';

window.onload = focusInput

document.querySelectorAll('.calc__btn').forEach((x) => {
    x.addEventListener('click', () => {
        if (x.id == `key_multiply`) {

        } else if (x.id == `key_reset`) {
            calc_input_value = '';
            updateCalcValue(calc_input_value)
            focusInput()
        } else if (x.id == 'key_period') {
            calc_input_value += '.';
            updateCalcValue(calc_input_value);
        } else if (x.id == 'key_enter') {
            addProductToCart();
            focusInput()
        } else if (x.id == 'key_close') {
            calc_input_value = calc_input_value.slice(0, -1);
            updateCalcValue(calc_input_value);
        }
        for (let i = 0; i <= 9; i++) {
            if (x.id == `key_${i}`) {
                calc_input_value += i;
                updateCalcValue(calc_input_value);
            }
        }
    });
});

calc_input.addEventListener('onfocus', () => {
    end = calc_input_value.length;
    calc_input.setSelectionRange(end-1, end);
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