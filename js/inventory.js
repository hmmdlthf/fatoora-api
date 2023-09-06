var start = 0;
var range = 100;

function getProducts() {
    fetch(`inventory/getProducts.php?start=${start}&range=${range}`)
        .then(r => r.json())
        .then(j => {
            addProductsJsonToTable(j);
        })
}

function getProductsFromSearch(searchTerm) {
    fetch(`inventory/getProducts.php?q=${searchTerm}&start=${start}&range=${range}`)
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
        td.innerHTML = '<button class="btn">Add Cart</button>';
        tr.appendChild(td);

        inventory_table.appendChild(tr);
    });
}

document.getElementById('inventory__table__entries').addEventListener('change', (e) => {
    range = e.target.value;
    getProducts();
})

document.getElementById('inventory__searchForm').addEventListener('submit', (e) => {
    e.preventDefault()
    let searchValue = document.getElementById('inventory__search').value
    // alert(searchValue)
    getProductsFromSearch(searchValue);
})