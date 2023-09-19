
var start = 0;
var range = 50;


function getInvoices() {
    fetch(`invoice/getInvoicesByUser.php?start=${start}&range=${range}`)
        .then(r => r.json())
        .then(j => {
            console.log(j)
            addInvoicesJsonToTable(j);
        })
}


function addInvoicesJsonToTable(j) {
    var sales_table = document.querySelector('#sales__table table tbody');
    sales_table.innerHTML = ''

    var fields = ['NameAR', 'InvoiceNumber', 'InvoiceDate', 'GrandTotal'];

    j.forEach((x, i) => {
        tr = document.createElement('tr');
        
        // add select action field
        td = document.createElement('td');
        td.id = `product${i}__Action`
        button = document.createElement('button')
        button.className = 'btn'
        button.innerHTML = 'Select'
        td.appendChild(button)
        tr.appendChild(td);

        fields.forEach(y => {
            td = document.createElement('td');
            td.id = `product${i}__${y}`;
            td.innerHTML = x[y];
            tr.appendChild(td);
        });

        // add select action field
        td_print = document.createElement('td');
        td_print.id = `product${i}__Print`
        button_print = document.createElement('button')
        button_print.className = 'btn'
        button_print.innerHTML = 'Print'
        td_print.appendChild(button_print)
        tr.appendChild(td_print);

        button.addEventListener('click', () => {
            selectInvoice(x['RecID'])
            showSalesModal()
        })

        button_print.addEventListener('click', () => {
            printInvoice(x['RecID'])
            showSalesModal()
        })

        sales_table.appendChild(tr);
    });
}


function printInvoice(recID) {
    const originUrl = window.location.origin;
    window.open(`${originUrl}/pos/other/print_invoice_html.php?invoiceRecID=${recID}`, 'Print Window', 'width=800,height=800' )
}


function selectInvoice(recID) {
    fetch(`invoice/InsertInvoiceToInvoiceTemp.php?recID=${recID}`)
        .then(r =>  {
            initializeCartTable();
            resetValue()
        })
}