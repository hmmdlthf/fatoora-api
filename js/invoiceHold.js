
var start = 0;
var range = 50;


function holdInvoice() {
    if (confirm('Confirm to hold invoice')) {
        fetch(`invoice-temp/holdInvoice.php?recID=${invoiceTempRecID}`)
            .then(r => {
                initializeCartTable();
                resetValue()
            });
    }
}


function getInvoicesOnHold() {
    fetch(`invoice-hold/getInvoicesByUser.php?start=${start}&range=${range}`)
        .then(r => r.json())
        .then(j => {
            console.log(j)
            addInvoicesOnHoldJsonToTable(j);
        })
}


function addInvoicesOnHoldJsonToTable(j) {
    var invoice_on_hold_table = document.querySelector('#invoice_on_hold__table table tbody');
    invoice_on_hold_table.innerHTML = ''

    var fields = ['RecID', 'Name', 'InvoiceNumber', 'InvoiceDate', 'GrandTotal'];
    var sub_fields = ['ProductFullName', 'OrderQuantity', 'UnitAmount', 'TotalAmount'];

    j.forEach((x, i) => {
        // display the invoice hold main record
        tr = document.createElement('tr');

        fields.forEach(y => {
            td = document.createElement('td');
            td.id = `product${i}__${y}`;
            td.innerHTML = x[y];
            tr.appendChild(td);
        });

        // add select action field
        td = document.createElement('td');
        td.id = `product${i}__Action`
        button = document.createElement('button')
        button.className = 'btn'
        button.innerHTML = 'Select'
        td.appendChild(button)
        tr.appendChild(td);

        button.addEventListener('click', () => {
            selectInvoiceOnHold()
            showInvoiceOnHoldModal()
        })

        invoice_on_hold_table.appendChild(tr);


        // display the invoice hold detail records of the main record after
        x['InvoiceDetails'].forEach((invoiceDetail, k) => {
            tr_sub = document.createElement('tr')
            tr_sub.className = 'row__sub'

            td = document.createElement('td')
            tr_sub.appendChild(td)

            sub_fields.forEach((m) => {
                td = document.createElement('td');
                td.id = `invoiceDetail${k}__${m}`;
                td.innerHTML = invoiceDetail[m];
                tr_sub.appendChild(td);
            })

            invoice_on_hold_table.appendChild(tr_sub)

        })
    });
}


function selectInvoiceOnHold() {
    alert('selected invoice on hold')
}