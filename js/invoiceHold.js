
var start = 0;
var range = 50;


function getInvoicesOnHold() {
    fetch(`invoice-hold/getInvoicesByUser.php?start=${start}&range=${range}`)
        .then(r => r.json())
        .then(j => {
            alert('got invoices')
            console.log(j)
            addInvoicesOnHoldJsonToTable(j);
        })
}


function addInvoicesOnHoldJsonToTable(j) {
    var invoice_on_hold_table = document.querySelector('#invoice_on_hold__table table tbody');
    invoice_on_hold_table.innerHTML = ''

    var fields = ['RecID', 'Name', 'InvoiceNumber', 'InvoiceDate', 'GrandTotal'];

    j.forEach((x, i) => {
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
            showSalesModal()
        })

        invoice_on_hold_table.appendChild(tr);
    });
}


function selectInvoiceOnHold() {
    alert('selected invoice on hold')
}