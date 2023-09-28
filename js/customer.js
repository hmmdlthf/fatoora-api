var term = ''
var customer_name_input = document.getElementById('customer_name');
var customer_code_input = document.getElementById('customer_code');
var customer_phone_input = document.getElementById('customer_phone');
const input_list = [customer_name_input, customer_code_input, customer_phone_input]
const searchResults = document.getElementById("customer__search__results");
var selectedCustomer = {}

input_list.forEach((x) => {
    x.addEventListener('input', (e) => {
        term = e.target.value.toLowerCase()
        getCustomersBySearchTerm()
    })
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
        const nameAR = customer.NameAR.toLowerCase();
        const phone = customer.Phone.toLowerCase();
        const code = customer.Code.toLowerCase();
        var Name = customer.Name
        var NameAR = customer.NameAR
        var Phone = customer.Phone
        var Code = customer.Code

        if (name.includes(term)) {
            Name = hightlightText(name, term, customer.Name)
        } else if (nameAR.includes(term)) {
            NameAR = hightlightText(nameAR, term, customer.NameAR)
        } else if (phone.includes(term)) {
            Phone = hightlightText(phone, term, customer.Phone)
        } else if (code.includes(term)) {
            Code = hightlightText(code, term, customer.Code)
        }

        const resultItem = document.createElement("div");
        resultItem.innerHTML = `${Name ? Name + '&nbsp;&nbsp;' : null} ${NameAR ? NameAR + '&nbsp;&nbsp;' : null} ${Phone ? Phone + '&nbsp;&nbsp;' : null} ${Code ? Code : null}`
        searchResults.appendChild(resultItem);
        resultItem.addEventListener('click', () => {
            selectCustomer(customer);
        })
    });
}

function hightlightText(origin_field, term, field) {
    const matchStart = origin_field.indexOf(term);
    const matchEnd = matchStart + term.length;
    var result = field.substring(0, matchStart) +
        `<span class="h">${field.substring(matchStart, matchEnd)}</span>` +
        field.substring(matchEnd);
    return result
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
    var customer_nameAR = document.getElementById('customer__nameAR');
    var customer_code = document.getElementById('customer__code');
    var customer_phone = document.getElementById('customer__phone');
    var customer_price_type = document.getElementById('customer__price__type');
    customer_name.innerHTML = customer.Name;
    customer_nameAR.innerHTML = customer.NameAR;
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