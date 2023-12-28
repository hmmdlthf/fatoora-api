var clearance_invoice_number = 'INV/00000155862';
var clearance_steps = {
    step1: false,
}

document.getElementById('clearance_form').addEventListener('submit', (e) => {
    e.preventDefault();
    clearance_invoice_number = document.getElementById('clearance_invoice_number').value;
    clearInvoice();
})

function clearInvoice() {
    if (document.getElementById('clearance_invoice_number').value != null) {
        invoiceClearance();
    } 
}

function invoiceClearance() {
    fetch(`${api_endpoints.invoice_clearance_path}?invoiceNumber=${clearance_invoice_number}`)
        .then(r => {
            console.log(r.text);
            clearance_steps.step1 = true;
            updateClearanceProgress();
            alert('Invoice Cleared Successfully')
            resetClearanceModal();
        });
}

function updateClearanceProgress() {
    if (clearance_steps.step1) {
        document.querySelector('#clearance_form .progress__step.progress__step-1').classList.add('active');
    } 
}

function resetClearanceModal() {
    showClearanceModal();
    document.getElementById('clearance_form').reset();
    clearance_steps.step1 = false;
    document.querySelector('#clearance_form .progress__step.progress__step-1').classList.remove('active');
}