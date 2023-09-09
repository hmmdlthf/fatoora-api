var cart_record_index = 0;
var invoiceTempRecID = 0;

function getProductByBarcode(barcode) {
    fetch(`inventory/getProduct.php?barcode=${barcode}`)
        .then(r => r.json())
        .then(j => {
            addProductToCart(j);
        })
}


function addProductToCart(j) {

    var cart_table = document.querySelector('#cart__table table tbody');

    var fields = ['UPC', 'ProductName', 'ProductPackageTypeCode', 'Quantity', 'RetailPrice', 'Total', 'Action'];


    tr = document.createElement('tr');

    fields.forEach(y => {
        td = document.createElement('td');
        td.id = `cartRecord${cart_record_index}__${y}`;
        
        if (y == 'Quantity') {
            td.innerHTML = 1;
        } else if (y == 'RetailPrice') {
            td.innerHTML = `${j['RetailPrice']}<span><input type="checkbox" name="is__wholesale" id="is__wholesale"></span>`;
        } else if (y == 'Total') {
            td.innerHTML = j['RetailPrice'];
        } else if (y == 'Action') {
            td.innerHTML = '<button class="cart__record__deleteBtn">D</button>';
        } else {
            td.innerHTML = j[y];
        }

        tr.appendChild(td);
    });

    cart_table.appendChild(tr);

    cart_record_index++
}


function initializeCart() {
    fetch(`invoice-temp/getInvoiceTemp.php`)
        .then(r => r.json())
        .then(j => {
            invoiceTempRecID = j.RecID;
            // alert(invoiceTempRecID)
        })
}

document.body.onload = () => {
    initializeCart()
};


function getInvoiceDetailByInvoiceRecId() {
    fetch(`invoice-temp/getInvoiceTemp.php?InvoiceRecID=${invoiceTempRecID}`)
        .then(r => r.json())
        .then(j => {
            console.log(j)
        })
}