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
            searchResults.addEventListener('click', () => {
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
    fetch(`customer/addCustomerToInvoiceTemp.php?recID=${invoiceTempRecID}&code=${selectedCustomer.Code}&phone=${selectedCustomer.Phone}&name=${selectedCustomer.Name}`)
        .then(r => r.json())
        .then(j => {
            addCustomerToCartDisplay(j);
        })
}

function addCustomerToCartDisplay() {

}
