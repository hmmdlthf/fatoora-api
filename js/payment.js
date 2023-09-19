var paymentInputs = [{ name: 'cash', isEnabled: true, amount: 0 }, { name: 'card', isEnabled: false, amount: 0 }];


function addPaymentToInvoice() {
    fetch(`invoice-temp/addPayment.php?recID=${invoiceTempRecID}${paymentInputs[0].isEnabled ? `&cashAmount=${paymentInputs[0].amount}` : ''}${paymentInputs[1].isEnabled ? `&cardAmount=${paymentInputs[1].amount}` : ''}`)
        .then(r => {
            // console.log(r)
            getCartTotals()
            showPaymentModal()
        })
}

document.getElementById('payment_add_form').addEventListener('submit', (e) => {
    e.preventDefault();
    addPaymentToInvoice();
})

paymentInputs.forEach(x => {
    var switch_element = document.getElementById(`pay_by_${x.name}`);
    var form_control_element = document.getElementById(`${x.name}_amount_form_control`);
    var payment_amount = document.getElementById(`${x.name}_amount`)

    switch_element.addEventListener('change', () => {
        x.isEnabled = !x.isEnabled;
        if (x.isEnabled) {
            switch_element.parentElement.classList.add('switch-on')
            form_control_element.classList.remove('hidden')
        } else {
            switch_element.parentElement.classList.remove('switch-on')
            form_control_element.classList.add('hidden')
        }
    })

    payment_amount.addEventListener('input', (e) => {
        x.amount = e.target.value;
    })


})