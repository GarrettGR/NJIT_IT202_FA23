document.addEventListener('DOMContentLoaded', function() {
    let salesmanRevenueInput = document.getElementById('salesman-revenue');

    salesmanRevenueInput.addEventListener('focus', function() {
        salesmanRevenueInput.style.backgroundColor = 'yellow'
    });

    salesmanRevenueInput.addEventListener('blur', function() {
        salesmanRevenueInput.style.backgroundColor = 'white'
    });
});