function addPaymentToInvoice() {
    fetch(`invoice/addPaymentToInvoice.php?recID=${invoiceTempRecID}`)
        .then(r => r.json())
        .then(j => {
            console.log(j)
            getCustomerByInvoiceTemp(invoiceTempRecID)
            showCustomerAddModal()
        })
}