// ambil semua method
const payment = document.getElementsByClassName("payment-method");

// ambil komponent confirm button
const confirmLink = document.getElementsByClassName("confirmLink")[0];
const confirmBtn = document.getElementsByClassName("cfm-btn")[0];

// ambil check box
const pointBox = document.getElementById("usePoint");
const priceInfo = document.getElementById("priceInfo");

function checkIfActive() {
    let isActive = false;
    for (let i = 0; i < payment.length; i++) {
        if (payment[i].classList.contains('active')) {
            isActive = true;
            break;
        }
    }

    if (isActive) {
        confirmLink.href = "orderList";  
        confirmBtn.classList.remove('disable');
    } else {
        confirmLink.removeAttribute('href'); ;
        confirmBtn.classList.add('disable');
    }
}

function setActive(e) {
    for (let i = 0; i < payment.length; i++) {
        payment[i].classList.remove('active');
    }

    e.classList.add('active');

    checkIfActive();
}

for (let i = 0; i < payment.length; i++) {
    payment[i].addEventListener('click', function () {
        setActive(this);
    });
}

pointBox.addEventListener('click', function () {
    console.log(pointBox.checked);

    if(pointBox.checked) {
        priceInfo.innerHTML = `Total Payment Rp ${50000 - (pointBox.value*1000)}`;
    } else {
        priceInfo.innerHTML = `Total Payment Rp ${50000 - (0*1000)}`;
    }
});