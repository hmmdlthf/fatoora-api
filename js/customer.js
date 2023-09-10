var term = ''
var customer_name_input = document.getElementById('customer_name');
var customer_code_input = document.getElementById('customer_code');
var customer_phone_input = document.getElementById('customer_phone');
const searchResults = document.getElementById("customer__search__results");
var selectedCustomer = {}

customer_name.addEventListener('input', (e) => {
    term = e.target.value.toLowerCase()
    getCustomersBySearchTerm()
})

function getCustomersBySearchTerm() {
    fetch(`customer/getCustomersBySearchTerm.php?term=${term}`)
        .then(r => r.json())
        .then(j => {
            displayCustomerSearchResults(j);
        })
}

// Function to search for customers and highlight matching characters
function displayCustomerSearchResults(customers) {
    searchResults.style.display = 'block';

    // Clear previous results
    searchResults.innerHTML = "";

    // Perform the search
    customers.forEach((customer) => {
        const name = customer.Name.toLowerCase();
        if (name.includes(term)) {
            const matchStart = name.indexOf(term);
            const matchEnd = matchStart + term.length;
            const highlightedName = customer.Name.substring(0, matchStart) +
                `<span class="h">${customer.Name.substring(matchStart, matchEnd)}</span>` +
                customer.Name.substring(matchEnd);

            const resultItem = document.createElement("div");
            resultItem.innerHTML = highlightedName;
            searchResults.appendChild(resultItem);
            resultItem.addEventListener('click', () => {
                selectCustomer(customer);
            })
        }
    });
}

function selectCustomer(customer) {
    selectedCustomer = customer;
    customer_code_input.value = customer.Code;
    customer_name_input.value = customer.Name;
    customer_phone_input.value = customer.Phone;
    searchResults.style.display = 'none';
    customer_name_input.blur()
}

document.getElementById('customer_search_form').addEventListener('submit', (e) => {
    e.preventDefault()
    addCustomerToInvoice()
})

function addCustomerToInvoice() {
    fetch(`customer/addCustomerToInvoiceTemp.php?recID=${invoiceTempRecID}${customer_code_input.value ? `&code=${customer_code_input.value}` : ''}${customer_phone_input.value ? `&phone=${customer_phone_input.value}` : ''}${customer_name_input.value ? `&name=${customer_name_input.value}` : ''}`)
        .then(r => r.json())
        .then(j => {
            console.log(j)
            getCustomerByInvoiceTemp(invoiceTempRecID)
            showCustomerAddModal()
        })
}

function addCustomerToCartDisplay(customer) {
    var customer_name = document.getElementById('customer__name');
    var customer_code = document.getElementById('customer__code');
    var customer_phone = document.getElementById('customer__phone');
    var customer_price_type = document.getElementById('customer__price__type');
    customer_name.innerHTML = customer.Name;
    customer_code.innerHTML = customer.Code;
    customer_phone.innerHTML = customer.Phone;
    customer_price_type.innerHTML = `${customer.PriceTypeName.split('Price')[0]} ${'Customer'}`

}

function removeCustomerFromCartDisplay() {
    var customer_name = document.getElementById('customer__name');
    var customer_code = document.getElementById('customer__code');
    var customer_phone = document.getElementById('customer__phone');
    var customer_price_type = document.getElementById('customer__price__type');
    customer_name.innerHTML = ''
    customer_code.innerHTML = ''
    customer_phone.innerHTML = ''
    customer_price_type.innerHTML = ''
}

function getCustomerByInvoiceTemp(recID) {
    fetch(`customer/getCustomerByInvoiceTemp.php?recID=${recID}`)
        .then(r => r.json())
        .then(j => {
            addCustomerToCartDisplay(j)
        }).catch(() => {
            removeCustomerFromCartDisplay()  
        })
}