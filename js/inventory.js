var start = 0;
var range = 100;
var inventoryModes = {WAREHOUSE: 'WAREHOUSE', SHOWROOM: 'SHOWROOM'}
var currentInventoryMode = inventoryModes.WAREHOUSE;

function getProducts() {
    fetch(`inventory/getProducts.php?start=${start}&range=${range}&mode=${currentInventoryMode}`)
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

function addLoadingBar() {

}

function addProductsJsonToTable(j) {
    var inventory_table = document.querySelector('#inventory__table table tbody');
    inventory_table.innerHTML = ''

    var fields = [ currentInventoryMode == inventoryModes.WAREHOUSE ? 'RecID' : 'ProductRecID', 'Warehouse', 'UPC', 'SKU', 'ProductName', 'ProductPackageTypeCode', 'ProductNameAR', 'ProductPackageTypeCodeAR', 'RetailPrice', 'WholesalePrice', 'StockOnHand'];

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

        inventory_table.appendChild(tr);
    });
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