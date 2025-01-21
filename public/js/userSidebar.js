// sidebar
sidebar = document.getElementsByClassName('sidebar')[0];

// komponen link sidebar user
userHamburgerLink = document.getElementsByClassName("hamburger-link")[0];

userDashboardLink = document.getElementsByClassName("dashboard-link")[0];
userServiceLink = document.getElementsByClassName("service-link")[0];
userOrderListLink = document.getElementsByClassName("order-link")[0];
userProfileLink = document.getElementsByClassName("profile-link")[0];
userLogoutLink = document.getElementsByClassName("logout-link")[0];

userLinks = document.getElementsByClassName("icon-link");

// icon hamburger
userHamburgerIcon = document.getElementsByClassName("hamburger-icon")[0];

// buat array icon
let links = [userDashboardLink, userServiceLink, userOrderListLink, userProfileLink, userLogoutLink];

// erase semua active 
function eraseActive() {
    Array.from(userLinks).forEach((e) => {
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

        if(e === userDashboardLink) {
            addActive(userDashboardLink);
            localStorage.setItem('user-active-link', 'dashboard');
        } else if(e === userServiceLink) {
            addActive(userServiceLink);
            localStorage.setItem('user-active-link', 'service');
        } else if(e === userOrderListLink) {
            addActive(userOrderListLink);
            localStorage.setItem('user-active-link', 'order');
        } else if(e === userProfileLink) {
            addActive(userProfileLink);
            localStorage.setItem('user-active-link', 'profile');
        } else if(e === userLogoutLink) {
            addActive(userLogoutLink);
            localStorage.setItem('user-active-link', 'logout');
        }

    });
});

eraseActive();

// pasang active
if(localStorage.getItem('user-active-link') === 'dashboard') {
    addActive(userDashboardLink);
} else if(localStorage.getItem('user-active-link') === 'service') {
    addActive(userServiceLink);
} else if(localStorage.getItem('user-active-link') === 'order') {
    addActive(userOrderListLink);
} else if(localStorage.getItem('user-active-link') === 'profile') {
    addActive(userProfileLink);
} else if(localStorage.getItem('user-active-link') === 'logout') {
    addActive(userLogoutLink);
}

// open sidebar
function openSidebar() {
    if(sidebar.classList.contains('sidebar-opened')) {
        sidebar.classList.remove('sidebar-opened');
        userHamburgerIcon.innerHTML = `<i class="bi bi-list"></i>`;
    } else {
        sidebar.classList.add('sidebar-opened');
        userHamburgerIcon.innerHTML = `<i class="bi bi-x-lg"></i>`;
    }
}