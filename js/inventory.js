var start = 0;
var range = 100;
var inventoryModes = {WAREHOUSE: 'WAREHOUSE', SHOWROOM: 'SHOWROOM'}
var currentInventoryMode = inventoryModes.WAREHOUSE;
var currentProductTypeRecID = 0;

function getProducts() {
    changeInventoryModalTitle('All Inventory | كل المخزون')
    fetch(`inventory/getProducts.php?start=${start}&range=${range}&mode=${currentInventoryMode}&productTypeRecID=${currentProductTypeRecID}`)
        .then(r => r.json())
        .then(j => {
            addProductsJsonToTable(j);
        })
}

function getProductsFromSearch(searchTerm) {
    fetch(`inventory/getProducts.php?q=${searchTerm}&start=${start}&range=${range}&mode=${currentInventoryMode}`)
        .then(r => r.json())
        .then(j => {
            addProductsJsonToTable(j);
        })
}

function addProductsJsonToTable(j) {
    var inventory_table = document.querySelector('#inventory__table table tbody');
    inventory_table.innerHTML = ''

    var fields = ['RecID', 'Warehouse', 'UPC', 'SKU', 'ProductName', 'ProductPackageTypeCode', 'ProductNameAR', 'ProductPackageTypeCodeAR', 'RetailPrice', 'WholesalePrice', 'StockOnHand'];

    j.forEach((x, i) => {
        tr = document.createElement('tr');

        fields.forEach(y => {
            td = document.createElement('td');
            td.id = `product${i}__${y}`;
            td.innerHTML = x[y];
            tr.appendChild(td);
        });

        td = document.createElement('td');
        td.id = `product${i}__Action`
        button = document.createElement('button')
        button.className = 'btn'
        button.innerHTML = 'Add Cart'
        td.appendChild(button)
        tr.appendChild(td);

        button.addEventListener('click', () => {
            addToCartByBarcode(x['UPC'])
            showInventoryModal()
        })

        td_substitute_products = document.createElement('td');
        td_substitute_products.id = `product${i}__ActionSubstituteProducts`
        button_substitute_products = document.createElement('button')
        button_substitute_products.className = 'btn'
        button_substitute_products.innerHTML = 'Sub Pro'
        td_substitute_products.appendChild(button_substitute_products)
        tr.appendChild(td_substitute_products);

        button_substitute_products.addEventListener('click', () => {
            showInventoryModal()
            addSubstituteProductsToModal(x['UPC'])
        })

        inventory_table.appendChild(tr);
    });

    inventoryModalMessage('No items to show')
}

document.getElementById('inventory__table__entries').addEventListener('change', (e) => {
    range = e.target.value;
    getProducts();
})

document.getElementById('inventory__search').addEventListener('input', (e) => {
    let searchValue = document.getElementById('inventory__search').value
    getProductsFromSearch(e.target.value);
})

function changeMode(mode) {
    console.log(mode)
    currentInventoryMode = mode;
}

function getProductTypes() {
    fetch(`inventory/getProductTypes.php`)
        .then(r => r.json())
        .then(j => {
            addProductTypesToDashboard(j);
        })   
}

function addProductTypesToDashboard(j) {
    var product_types_element = document.getElementById('product_types');
    product_types_element.innerHTML = ''

    j.forEach((x, i) => {
        var product_type = document.createElement('div');
        product_type.id = `product_type_${x['RecID']}`
        product_type.className = 'category__btn';
        product_type.innerHTML = x['Name']

        product_types_element.appendChild(product_type);

        product_type.addEventListener('click', () => {
            currentProductTypeRecID = x['RecID']
            showInventoryModal()
        })
    })
}

function getSubstituteProductsByBarcode(barcode) {
    fetch(`inventory/getSubstituteProductsByBarcode.php?barcode=${barcode}&mode=${currentInventoryMode}`)
        .then(r => r.json())
        .then(j => {
            addProductsJsonToTable(j);
        })   
}

function getSubstituteProductsByInvoiceDetailTempRecID(invoiceDetailTempRecID) {
    fetch(`inventory/getSubstituteProductsByInvoiceDetailTempRecID.php?invoiceDetailTempRecID=${invoiceDetailTempRecID}&mode=${currentInventoryMode}`)
        .then(r => r.json())
        .then(j => {
            addProductsJsonToTable(j);
        })   
}

function addSubstituteProductsToModal(barcode) {
    showInventoryModalWithoutDefault()
    changeInventoryModalTitle(`Substitute Products for Item: ${barcode} | منتجات بديلة للصنف: ${barcode}`)
    getSubstituteProductsByBarcode(barcode)
}

function addSubstituteProductsByInvoiceDetailToModal(invoiceDetailTempRecID) {
    showInventoryModalWithoutDefault()
    changeInventoryModalTitle(`Substitute Products for Item: ${invoiceDetailTempRecID} | منتجات بديلة للصنف: ${invoiceDetailTempRecID}`)
    getSubstituteProductsByInvoiceDetailTempRecID(invoiceDetailTempRecID)
}

function showInventoryModalWithoutDefault() {
    document.getElementById('inventory__modal').classList.toggle('active');
    
    if (document.getElementById('inventory__modal').classList.contains('active')) {
    }
}

function changeInventoryModalTitle(title) {
    document.getElementById('inventory__tableBody').innerHTML = '';
    document.getElementById('inventory__modal__title').innerHTML = title;
    inventoryModalMessage('Loading......')
}

function inventoryModalMessage(message) {
    var inventory_table = document.querySelector('#inventory__table table tbody');
    var message_element = document.getElementById('inventory__empty__message');
    let length = inventory_table.children.length;
    length == 0 ? message_element.classList.add('active') : message_element.classList.remove('active')
    message_element.innerHTML = message;
}