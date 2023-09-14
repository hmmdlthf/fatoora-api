var paymentMethods = { CASH: 'CASH', CARD: 'CARD' }
var paymentMethod = paymentMethods.CASH;
var paymentAmount = 0;

function addPaymentToInvoice() {
    let amount = document.querySelector('#payment_amount').value;

    fetch(`invoice-temp/addPayment.php?recID=${invoiceTempRecID}&paymentMethod=${paymentMethod}&paymentAmount=${amount}`)
        .then(r => {
            console.log(r)
            showPaymentModal()
        })
}

document.getElementById('payment_add_form').addEventListener('submit', (e) => {
    e.preventDefault();
    addPaymentToInvoice();
})

document.querySelectorAll("input[name='payment_method']").forEach((x) => {
    x.addEventListener('change', e => {
        paymentMethod = paymentMethod == paymentMethods.CASH ? paymentMethods.CARD : paymentMethods.CASH;
    })
})