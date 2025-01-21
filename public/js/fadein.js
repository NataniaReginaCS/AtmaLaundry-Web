// ambil elemen yg muncul
const items = document.querySelectorAll('.appear');

// tambah class baru jika terlihat
const active = function(entries){
    entries.forEach(entry => {
        if(entry.isIntersecting){
            entry.target.classList.add('inview'); 
        }else{
            entry.target.classList.remove('inview'); 
        }
    });
}

// buat konstruktor observer
const io = new IntersectionObserver(active);

// elemen yg akan di pantau
for(let i=0; i < items.length; i++){
    io.observe(items[i]);
}