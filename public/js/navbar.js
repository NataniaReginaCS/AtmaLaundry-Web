// semua nav link
const navLink = document.getElementsByClassName('nav-link');

// masing - masing nav link
const homeLink = document.getElementById("home-link");
const hiwLink = document.getElementById("hiw-link");
const locationLink = document.getElementById("location-link");
const myorderLink = document.getElementById("myorder-link");
const reviewLink = document.getElementById("reviews-link");

// tambah tag active
function addActive(e) {
    e.classList.add('active');
}

// hapus semua active
function eraseActive() {
    Array.from(navLink).forEach((e) => {
        e.classList.remove('active');
    });
}

// jika blm di define
if(localStorage.getItem('navbar-active-link') === null) localStorage.setItem('navbar-active-link','home');

// detect icon active
Array.from(navLink).forEach((e,i) => {
    e.addEventListener('click', () => {
        eraseActive();

        if(e === homeLink || e === reviewLink) {
            addActive(homeLink);
            localStorage.setItem('navbar-active-link','home');
        } else if(e === hiwLink) {
            addActive(hiwLink);
            localStorage.setItem('navbar-active-link','hiw');
        } else if(e === locationLink) {
            addActive(locationLink);
            localStorage.setItem('navbar-active-link','location');
        } else if(e === myorderLink) {
            addActive(myorderLink);
            localStorage.setItem('navbar-active-link','myorder');
            localStorage.setItem('user-active-link', 'dashboard');
            localStorage.setItem('admin-active-link', 'dashboard');
        }

    });
});

eraseActive();

// pasang active
if(localStorage.getItem('navbar-active-link') === 'home') {
    addActive(homeLink);
} else if(localStorage.getItem('navbar-active-link') === 'hiw') {
    addActive(hiwLink);
} else if(localStorage.getItem('navbar-active-link') === 'location') {
    addActive(locationLink);
} else if(localStorage.getItem('navbar-active-link') === 'myorder') {
    addActive(myorderLink);
}