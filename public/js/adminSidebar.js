// sidebar
sidebar = document.getElementsByClassName('sidebar')[0];

// komponen link sidebar user
adminHamburgerLink = document.getElementsByClassName("hamburger-link")[0];

adminDashboardLink = document.getElementsByClassName("dashboard-link")[0];
adminCustomerLink = document.getElementsByClassName("customer-link")[0];
adminOrderListLink = document.getElementsByClassName("order-link")[0];
adminServiceLink = document.getElementsByClassName("service-link")[0];
adminLogoutLink = document.getElementsByClassName("logout-link")[0];

adminLinks = document.getElementsByClassName("icon-link");

// icon hamburger
adminHamburgerIcon = document.getElementsByClassName("hamburger-icon")[0];

// buat array icon
let links = [adminDashboardLink, adminCustomerLink, adminOrderListLink, adminServiceLink, adminLogoutLink];

console.log(links);


// erase semua active 
function eraseActive() {
    Array.from(adminLinks).forEach((e) => {
        e.classList.remove('active');        
    });
}

// add active 
function addActive(e) {
    e.classList.add('active');
}

// detect icon active
links.forEach((e,i) => {
    e.addEventListener('click', () => {

        eraseActive();

        if(e === adminDashboardLink) {
            addActive(adminDashboardLink);
            localStorage.setItem('admin-active-link', 'dashboard');
        } else if(e === adminServiceLink) {
            addActive(adminServiceLink);
            localStorage.setItem('admin-active-link', 'service');
        } else if(e === adminOrderListLink) {
            addActive(adminOrderListLink);
            localStorage.setItem('admin-active-link', 'order');
        } else if(e === adminCustomerLink) {
            addActive(adminCustomerLink);
            localStorage.setItem('admin-active-link', 'customer');
        } else if(e === adminLogoutLink) {
            addActive(adminLogoutLink);
            localStorage.setItem('admin-active-link', 'logout');
        }

    });
});

eraseActive();

// pasang active
if(localStorage.getItem('admin-active-link') === 'dashboard') {
    addActive(adminDashboardLink);
} else if(localStorage.getItem('admin-active-link') === 'service') {
    addActive(adminServiceLink);
} else if(localStorage.getItem('admin-active-link') === 'order') {
    addActive(adminOrderListLink);
} else if(localStorage.getItem('admin-active-link') === 'customer') {
    addActive(adminCustomerLink);
} else if(localStorage.getItem('admin-active-link') === 'logout') {
    addActive(adminLogoutLink);
}

// open sidebar
function openSidebar() {
    if(sidebar.classList.contains('sidebar-opened')) {
        sidebar.classList.remove('sidebar-opened');
        adminHamburgerIcon.innerHTML = `<i class="bi bi-list"></i>`;
    } else {
        sidebar.classList.add('sidebar-opened');
        adminHamburgerIcon.innerHTML = `<i class="bi bi-x-lg"></i>`;
    }
}