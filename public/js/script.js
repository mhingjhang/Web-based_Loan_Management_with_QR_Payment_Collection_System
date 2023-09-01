function goBack() {
    window.history.back();
}

$(document).ready(function () {
    $("#success-alert").fadeTo(3000, 500).slideUp(500, function () {
        $("#success-alert").slideUp(500);
    });
});

document.addEventListener('DOMContentLoaded', function () {
    initializeChart();
});


// Select all the list items in the sidebar
var sidebarItems = document.querySelectorAll('#sidebar a');
var allDropdown = document.querySelectorAll('#sidebar .side-dropdown');

// Add a click event listener to each list item
sidebarItems.forEach(function (item) {
    item.addEventListener('click', function () {
        // Remove the active class from all list items
        sidebarItems.forEach(function (innerItem) {
            innerItem.classList.remove('active');
        });

        // If the clicked list item has a dropdown menu, toggle the show class
        var dropdown = this.nextElementSibling;
        if (dropdown && dropdown.classList.contains('side-dropdown')) {
            dropdown.classList.toggle('show');
        } else {
            // If the clicked list item doesn't have a dropdown menu, remove the show class from all dropdown menus
            allDropdown.forEach(function (dropdown) {
                dropdown.classList.remove('show');
            });
        }

        // Add the active class to the clicked list item
        this.classList.add('active');
    });
});

const loanAmountInput = document.getElementById('loanAmount');
const loanAmountResultInput = document.getElementById('loanAmountResult');
const interestInput = document.getElementById('interest');
const totalInput = document.getElementById('total');
const slider = document.querySelector('.slider');

const loanDurationInput = document.getElementById('loanDuration');
const dailyRepaymentInput = document.getElementById('dailyRepayment');
const loanAmountInput2 = document.getElementById('loanAmount2');
const serviceFeeInput = document.getElementById('serviceFee');
const totalDisbursementInput = document.getElementById('totalDisbursement');

// Update the loan amount value when the input changes
loanAmountInput.addEventListener('input', function () {
    loanAmountResultInput.value = this.value;
    calculateInterest();
    calculateTotalDisbursement();
});

// Update the loan amount value when the slider changes
loanAmountInput.addEventListener('input', function () {
    loanAmountInput.value = this.value;
    loanAmountResultInput.value = this.value;
    loanAmountInput2.value = this.value;
    slider.value = this.value
    calculateInterest();
    calculateTotalDisbursement();
});

// Update the loan amount value when the slider changes
slider.addEventListener('input', function () {
    loanAmountInput.value = this.value;
    loanAmountResultInput.value = this.value;
    loanAmountInput2.value = this.value;
    slider.value = this.value;
    calculateInterest();
    calculateTotalDisbursement();
});

// Calculate the interest based on the loan amount
function calculateInterest() {
    const loanAmount = parseFloat(loanAmountInput.value);
    const interest = (loanAmount * 0.1) * 2; // Assuming 10% interest rate
    interestInput.value = interest.toFixed(2);
    totalInput.value = (loanAmount + interest).toFixed(2);
   
}

// Update the loan amount value when the input changes
loanAmountInput.addEventListener('input', function () {
    calculateDailyRepayment();
    calculateTotalDisbursement();
});

// Update the loan amount value when the input changes
slider.addEventListener('input', function () {
    calculateDailyRepayment();
    calculateTotalDisbursement();
});

// Calculate the daily repayment based on the loan duration
function calculateDailyRepayment() {
    const loanDuration = parseInt(loanDurationInput.value);
    const loanAmount = parseFloat(loanAmountInput2.value);
    const dailyRepayment = loanAmount / loanDuration;
    dailyRepaymentInput.value = dailyRepayment.toFixed(2);
    
}

// Calculate the total disbursement based on the loan amount and service fee
function calculateTotalDisbursement() {
    const loanAmount = parseFloat(loanAmountInput2.value);
    const serviceFee = loanAmount * 0.011; // Assuming 1.1% service fee
    serviceFeeInput.value = serviceFee.toFixed(2);
    totalDisbursementInput.value = (loanAmount - serviceFee).toFixed(2);
}



// SIDEBAR COLLAPSE
const toggleSidebar = document.querySelector('nav .toggle-sidebar');
const allSideDivider = document.querySelectorAll('#sidebar .divider');

if (sidebar.classList.contains('hide')) {
    allSideDivider.forEach(item => {
        item.textContent = '-'
    })
    allDropdown.forEach(item => {
        const a = item.parentElement.querySelector('a:first-child');
        a.classList.remove('active');
        item.classList.remove('show');
    })
} else {
    allSideDivider.forEach(item => {
        item.textContent = item.dataset.text;
    })
}

toggleSidebar.addEventListener('click', function () {
    sidebar.classList.toggle('hide');

    if (sidebar.classList.contains('hide')) {
        allSideDivider.forEach(item => {
            item.textContent = '-'
        })

        allDropdown.forEach(item => {
            const a = item.parentElement.querySelector('a:first-child');
            a.classList.remove('active');
            item.classList.remove('show');
        })
    } else {
        allSideDivider.forEach(item => {
            item.textContent = item.dataset.text;
        })
    }
})




sidebar.addEventListener('mouseleave', function () {
    if (this.classList.contains('hide')) {
        allDropdown.forEach(item => {
            const a = item.parentElement.querySelector('a:first-child');
            a.classList.remove('active');
            item.classList.remove('show');
        })
        allSideDivider.forEach(item => {
            item.textContent = '-'
        })
    }
})



sidebar.addEventListener('mouseenter', function () {
    if (this.classList.contains('hide')) {
        allDropdown.forEach(item => {
            const a = item.parentElement.querySelector('a:first-child');
            a.classList.remove('active');
            item.classList.remove('show');
        })
        allSideDivider.forEach(item => {
            item.textContent = item.dataset.text;
        })
    }
})







// MENU
const allMenu = document.querySelectorAll('main .content-data .head .menu');

allMenu.forEach(item => {
    const icon = item.querySelector('.icon');
    const menuLink = item.querySelector('.menu-link');

    icon.addEventListener('click', function () {
        menuLink.classList.toggle('show');
    })
})







function initializeChart() {
    //Chart 1
    var options = {
        chart: {
            height: 280,
            type: 'line'
        },
        series: [{
            name: 'sales',
            data: [30, 40, 35, 50, 49, 60, 70, 91, 125]
        }],
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep']
        }
    }

    var chart = new ApexCharts(document.querySelector("#chart"), options);

    chart.render();

    //Chart 2
    var options2 = {
        chart: {
            height: 280,
            type: 'line'
        },
        series: [{
            name: 'sales',
            data: [30, 40, 35, 50, 49, 60, 70, 91, 125]
        }],
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep']
        }
    }

    var chart2 = new ApexCharts(document.querySelector("#chart2"), options2);

    chart2.render();

    //Chart 3
    var options3 = {
        chart: {
            height: 280,
            type: 'line'
        },
        series: [{
            name: 'sales',
            data: [30, 40, 35, 50, 49, 60, 70, 91, 125]
        }],
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep']
        }
    }

    var chart3 = new ApexCharts(document.querySelector("#chart3"), options3);

    chart3.render();

    //Chart 4
    var options4 = {
        chart: {
            height: 280,
            type: 'line'
        },
        series: [{
            name: 'sales',
            data: [30, 40, 35, 50, 49, 60, 70, 91, 125]
        }],
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep']
        }
    }

    var chart4 = new ApexCharts(document.querySelector("#chart4"), options4);

    chart4.render();
}
