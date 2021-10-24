function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.sidebar .nav-link').forEach(function (element) {

        element.addEventListener('click', function (e) {

            let nextEl = element.nextElementSibling;
            let parentEl = element.parentElement;

            if (nextEl) {
                e.preventDefault();
                let mycollapse = new bootstrap.Collapse(nextEl);

                if (nextEl.classList.contains('show')) {
                    mycollapse.hide();
                } else {
                    mycollapse.show();
                    var opened_submenu = parentEl.parentElement.querySelector('.submenu.show');
                    if (opened_submenu) {
                        new bootstrap.Collapse(opened_submenu);
                    }
                }
            }
        });
    })

    // Auto Sum Grand Total Penjualan
    let elmGrandTotal = document.querySelector('td.grand-total')
    let elmHargaBarang = document.querySelectorAll('td.harga-barang')
    let elmInputBarang = document.querySelectorAll('input.jml-barang')

    elmInputBarang.forEach(function (el) {
        el.addEventListener('keyup', function (e) {
            let total = 0;
            elmInputBarang.forEach(function (_, i) {
                let hargabarang = elmHargaBarang[i].textContent.replace(',', '')
                total += hargabarang * elmInputBarang[i].value

            })
            elmGrandTotal.innerText = numberWithCommas(total) + '.00'

        })
    })

    // Truncate Text
    document.querySelectorAll(".text-truncate").forEach(function (elm) {
        let len = elm.textContent.length
        if (len > 10) {
            elm.textContent = elm.textContent.substr(0, 8) + '...'
        }
    })

    // Cookie Nama pelanggan penjualan
    let elmInputNamePelanggan = document.querySelector(".nama-pelanggan")
    let namaPelanggan = getCookie("namaPelanggan")

    if (!(namaPelanggan == "")) {
        elmInputNamePelanggan.value = namaPelanggan
    }

    elmInputNamePelanggan.addEventListener("keyup", function (e) {
        document.cookie = `namaPelanggan=${elmInputNamePelanggan.value}`
    })

    let elmBtnSimpan = document.querySelector(".btn-simpan")
    elmBtnSimpan.addEventListener("click", function () {
        document.cookie = "namaPelanggan=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=*;"
    })
});