var cart_record_index = 0;
var invoiceTempRecID = 0;
var invoiceTemp_PriceTypeRecID = 1;
var invoiceTemp_CustomerRecID = 0;



function emptyCart() {
    document.querySelector('#cart__table table tbody').innerHTML = '';

}


function holdInvoice() {
    if (confirm('Confirm hold invoice')) {
        fetch(`invoice-temp/holdInvoice.php`)
            .then(r => {
                initializeCartTable();
                resetValue()
            });
    }
}


function addProductToCart(j) {

    var cart_table = document.querySelector('#cart__table table tbody');

    var fields = ['Barcode', 'ProductFullName', 'ProductPackageTypeCodeAR', 'OrderQuantity', 'UnitAmount', 'TotalAmount', 'Action'];


    tr = document.createElement('tr');

    fields.forEach(y => {
        td = document.createElement('td');
        td.id = `cartRecord${cart_record_index}__${y}`;

        if (y == 'OrderQuantity') {
            let div = document.createElement('div');
            let span = document.createElement('span')
            let input = document.createElement('input')

            div.className = 'quantity'
            input.className = 'cart__record__quantity__input'
            span.className = 'cart__record__A'
            input.id = `quantity_${j['InvoiceDetailRecID']}`
            span.id = `cart__record__A__btn__${j['InvoiceDetailRecID']}`

            input.setAttribute('type', 'text')
            input.setAttribute('name', 'quantity')

            td.appendChild(div)
            div.appendChild(input)
            div.appendChild(span)

            input.value = j['OrderQuantity'] ? j['OrderQuantity'] : 1.0000;
            span.innerHTML = 'A'

            let input_value = j['OrderQuantity']
            let upbtn = document.createElement('div')
            let downbtn = document.createElement('div')
            upbtn.className = 'upbtn'
            downbtn.className = 'downbtn'
            div.appendChild(upbtn)
            div.appendChild(downbtn)

            upbtn.addEventListener('click', () => {
                input_value++
                input.value = input_value
            })

            downbtn.addEventListener('click', () => {
                if (input_value > 1) {
                    input_value--
                    input.value = input_value
                }
            })

            span.addEventListener('click', () => {
                if (input.value) {
                    if (confirm("Confirm Update")) {
                        updateQuantity(j['InvoiceDetailRecID'], input.value)
                    }
                } else {
                    alert('Enter amount to update!')
                }
            })


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
            invoiceTemp_CustomerRecID = j.CustomerRecID
            invoiceTemp_PriceTypeRecID = j.PriceTypeID
            emptyCart()
            getInvoiceDetailByInvoiceRecId()
            getCartTotals()
            getCustomerByInvoiceTemp(invoiceTempRecID)
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
            // alert(r)
            emptyCart()
            getInvoiceDetailByInvoiceRecId()
            getCartTotals()
            div.classList.toggle('switch-on')
        })
}


function wholePriceToggle(div) {
    div.classList.toggle('switch-on')
}


function updateQuantity(recID, orderQuantity) {
    fetch(`invoice-temp/updateQuantity.php?recID=${recID}&orderQuantity=${orderQuantity}`)
        .then(r => {
            emptyCart()
            getInvoiceDetailByInvoiceRecId()
            getCartTotals()
            div.classList.toggle('switch-on')
        })
}


function copyTempToInvoice() {
    fetch(`invoice-temp/insertInvoiceTempToInvoice.php?recID=${invoiceTempRecID}`)
        .then(r => {
            alert('Temp invoice added to invoice')
            holdInvoice()
        })
}