var cart_record_index = 0;
var invoiceTempRecID = 0;

function emptyCart() {
    document.querySelector('#cart__table table tbody').innerHTML = '';
    
}

function holdInvoice() {
    fetch(`invoice-temp/holdInvoice.php`)
        .then(r => {
            alert('hold success')
            initializeCartTable();
            resetValue()
        });
}


function addProductToCart(j) {

    var cart_table = document.querySelector('#cart__table table tbody');

    var fields = ['Barcode', 'ProductFullName', 'ProductPackageTypeCodeAR', 'OrderQuantity', 'UnitAmount', 'TotalAmount', 'Action'];


    tr = document.createElement('tr');

    fields.forEach(y => {
        td = document.createElement('td');
        td.id = `cartRecord${cart_record_index}__${y}`;

        if (y == 'Quantity') {
            td.innerHTML = 1;
        } else if (y == 'UnitAmount') {
            let span = document.createElement('span');
            let span0 = document.createElement('span');
            let div = document.createElement('div');
            let input = document.createElement('input');

            div.id = `switch__${j['InvoiceDetailRecID']}`;
            div.className = 'switch';

            input.id = `is__wholesale__${j['InvoiceDetailRecID']}`;
            input.className = `is__wholesale__switch`;
            input.setAttribute('type', 'checkbox')
            input.setAttribute('name', 'is__wholesale')
            div.appendChild(input)
            span.appendChild(div)
            td.appendChild(span0)
            td.appendChild(span)

            input.addEventListener('change', (e) => {
                togglePriceType(div, j['InvoiceDetailRecID'], j['PriceTypeRecID'])
            })

            if (j['PriceTypeRecID'] == "2") {
                span0.innerHTML = `${j['WholesalePrice']}`
                div.classList.add('switch-on')
            } else {
                span0.innerHTML = `${j['UnitAmount']}`
            }

        } else if (y == 'Action') {
            td.innerHTML = `<button class="cart__record__deleteBtn" onclick="deleteInvoiceDetail(${j['InvoiceDetailRecID']})">D</button>`;
        } else {
            td.innerHTML = j[y];
        }

        tr.appendChild(td);
    });

    cart_table.appendChild(tr);

    cart_record_index++

    resetValue() // reset calculator value
}


function addTotalsToCart(j) {
    var sub_total = document.getElementById('sub__total')
    var vat_total = document.getElementById('vat__total')
    var grand_total = document.getElementById('grand__total')
    var balance_total = document.getElementById('balance__total')

    sub_total.innerHTML = j['TotalSubTotal'] ? j['TotalSubTotal'] : 0.00
    vat_total.innerHTML = j['TotalVATAmount'] ? j['TotalVATAmount'] : 0.00
    grand_total.innerHTML = j['GrandTotal'] ? j['GrandTotal'] : 0.00
    balance_total.innerHTML = j['BalanceAmount'] ? j['BalanceAmount'] : 0.00
}


function initializeCartTable() {
    fetch(`invoice-temp/getInvoiceTemp.php`)
        .then(r => r.json())
        .then(j => {
            invoiceTempRecID = j.RecID;
            console.log(invoiceTempRecID)
            emptyCart()
            getInvoiceDetailByInvoiceRecId()
            getCartTotals()
        })
}


document.body.onload = () => {
    initializeCartTable()
};


function getCartTotals() {
    fetch(`invoice-temp/getInvoiceTempData.php?invoiceRecID=${invoiceTempRecID}`)
        .then(r => r.json())
        .then(j => {
            console.log(j)
            addTotalsToCart(j)
        })
}


function getInvoiceDetailByInvoiceRecId() {
    fetch(`invoice-temp/getInvoiceDetailsByInvoiceRecId.php?invoiceRecID=${invoiceTempRecID}`)
        .then(r => r.json())
        .then(j => {
            console.log(j)
            j.forEach((x) => {
                addProductToCart(x);
            })
        })
}


function addToCartByBarcode(barcode) {
    fetch(`invoice-temp/addToCartByBarcode.php?invoiceRecID=${invoiceTempRecID}&barcode=${barcode}`)
        .then(r => r.json())
        .then(j => {
            emptyCart()
            getInvoiceDetailByInvoiceRecId()
            getCartTotals()
        })
}


function deleteInvoiceDetail(recID) {
    fetch(`invoice-temp/deleteInvoiceDetailTemp.php?recID=${recID}`)
    .then(r => {
        emptyCart()
        getInvoiceDetailByInvoiceRecId()
        getCartTotals()
    })
}

function togglePriceType(div, recID, priceTypeID) {
    fetch(`invoice-temp/togglePriceType.php?recID=${recID}&priceTypeID=${priceTypeID}`)
    .then(r => {
        alert(r)
        emptyCart()
        getInvoiceDetailByInvoiceRecId()
        getCartTotals()
        div.classList.toggle('switch-on')
    })
}


function wholePriceToggle(div) {
    div.classList.toggle('switch-on')
}