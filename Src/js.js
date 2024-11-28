// script.js
// Add event listeners to the input fields for validation and formatting
<script>
// Card Number Formatting
const cardNumberInput = document.getElementById('card_number');
cardNumberInput.addEventListener('input', function (e) {
    let value = e.target.value.replace(/\D/g, ''); // Remove non-numeric characters
    value = value.replace(/(\d{4})(?=\d)/g, '$1 '); // Add space after every 4 digits
    e.target.value = value;
});

// Expiry Month Validation
const expiryMonthInput = document.getElementById('expiry_month');
expiryMonthInput.addEventListener('input', function (e) {
    let value = e.target.value.replace(/\D/g, ''); // Remove non-numeric characters
    value = value.slice(0, 2); // Limit to 2 digits
    e.target.value = value;
});

// Expiry Year Validation
const expiryYearInput = document.getElementById('expiry_year');
const currentYear = new Date().getFullYear();
expiryYearInput.addEventListener('input', function (e) {
    let value = e.target.value.replace(/\D/g, ''); // Remove non-numeric characters
    value = value.slice(0, 4); // Limit to 4 digits
    if (value < currentYear) {
        value = currentYear; // Set to current year if entered year is less than the current year
    }
    e.target.value = value;
});

// CVV Validation
const cvvInput = document.getElementById('cvv');
cvvInput.addEventListener('input', function (e) {
    let value = e.target.value.replace(/\D/g, ''); // Remove non-numeric characters
    value = value.slice(0, 3); // Limit to 3 digits
    e.target.value = value;
});
</script>