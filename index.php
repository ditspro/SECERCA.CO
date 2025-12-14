<?php include 'header.php'; ?>


<section class="hero">
    <h2>Hallo #wargasecerca</h2>
    <p>Buka Setiap Hari | 08.00 – 22.00</p>
    <button>Pesan Sekarang</button>
</section>

<section class="menu-section" id="menu">
    <h1>Menu</h1>

    <h3 class="menu-title">Signature</h3>
    <div class="menu-grid">
        <div class="menu-card" onclick="openDetail('Secerca Bold','Double shot espresso + condensed milk + Secerca milk','img/bold.jpeg','Rp 18.000')">
            <img src="img/bold.jpeg">
            <h4>Secerca Bold</h4>
        </div>

        <div class="menu-card" onclick="openDetail('Banjaran Latte','Single shot espresso + condensed milk + Secerca Milk','img/banjaran.jpeg','Rp 17.000')">
            <img src="img/banjaran.jpeg">
            <h4>Banjaran Latte</h4>
        </div>

        <div class="menu-card" onclick="openDetail('Sunset On Secerca','Espresso + Orange Juice','img/palms.jpg','Rp 18.000')">
            <img src="img/palms.jpg">
            <h4>Sunset On Secerca</h4>
        </div>
    </div>
</section>

<!-- POPUP DETAIL -->
<div id="popupDetail" class="popup">
    <div class="popup-content">
        <span class="close" onclick="closeDetail()">&times;</span>

        <img id="popupImg">
        <h3 id="popupTitle"></h3>
        <p id="popupDesc"></p>
        <h4 id="popupPrice"></h4>

        <button id="popupOrderBtn" class="order-btn">Order Now</button>
    </div>
</div>

<section id="about" class="about">
    <h2>Tentang SECERCA</h2>
    <p>
        Lahir pada Oktober 2023, Toko Kopi Secerca memperkenalkan menu berbasis espresso
        dengan biji kopi lokal Indonesia seperti Arabika Gayo dan Robusta Temanggung.
    </p>
</section>

<section id="contact" class="contact">
    <h2>Kontak Kami</h2>
    <p>Alamat: Jl. Argoboga no 19, Argomulyo, Salatiga</p>
    <p>Instagram: @secerca.co</p>
</section>



<script>
function openDetail(title, desc, img, price) {
    document.getElementById("popupTitle").innerText = title;
    document.getElementById("popupDesc").innerText = desc;
    document.getElementById("popupImg").src = img;
    document.getElementById("popupPrice").innerText = price;

    const hargaNumber = parseInt(price.replace(/\D/g, ""));

    document.getElementById("popupOrderBtn").onclick = function () {
        fetch("order.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `nama=${title}&harga=${hargaNumber}`
        })
        .then(res => res.text())
        .then(data => {
            alert("Pesanan berhasil ditambahkan ✅");
            closeDetail();
        });
    };

    document.getElementById("popupDetail").style.display = "flex";
}

function closeDetail() {
    document.getElementById("popupDetail").style.display = "none";
}
orderBtn.onclick = function () {
    fetch("order.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `nama=${encodeURIComponent(title)}&harga=${hargaNumber}`
    })
    .then(res => res.text())
    .then(text => {
        alert("SERVER: " + text);
    })
    .catch(err => {
        alert("FETCH ERROR");
        console.error(err);
    });
};


</script>


<?php include 'footer.php'; ?>
