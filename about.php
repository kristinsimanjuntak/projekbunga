<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>tentang</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>tentang kami</h3>
    <p> <a href="home.php">home</a> / tentang </p>
</section>

<section class="about">

    <div class="flex">

        <div class="image">
            <img src="images/about-img-1.png" alt="">
        </div>

        <div class="content">
            <h3>mengapa memilih kami?</h3>
            <p>Sekarang Anda dapat memesan bunga secara online dari toko bunga online kami di Malaysia dan mendapatkan pengiriman bunga segar untuk semua kesempatan di depan pintu. bunga telah membuat prosesnya lebih mudah bagi Anda sekalian.</p>
            <a href="shop.php" class="btn">berbelanja sekarang</a>
        </div>

    </div>

    <div class="flex">

        <div class="content">
            <h3>apa yang kami sediakan?</h3>
            <p>Jika Anda ingin memukau atau mengejutkan keluarga atau orang-orang tersayang, pilihan apa yang lebih baik selain rangkaian bunga? Menjadi toko bunga online terpercaya di Malaysia, kami menyediakan berbagai layanan hadiah kepada klien kami dengan layanan pengiriman ke rumah yang menyajikan cherry on the cake. Pengiriman kami yang bebas repot di depan pintu Anda akan membuat pengalaman berbelanja Anda berharga.</p>
            <a href="contact.php" class="btn">Hubungi kami</a>
        </div>

        <div class="image">
            <img src="images/about-img-2.jpg" alt="">
        </div>

    </div>

    <div class="flex">

        <div class="image">
            <img src="images/about-img-3.jpg" alt="">
        </div>

        <div class="content">
            <h3>siapa kita?</h3>
            <p>bunga adalah toko bunga dan toko suvenir online pilihan Anda untuk semua acara penting dalam hidup. Didedikasikan untuk memberikan Anda bunga segar, terindah, dan hadiah unik, kami di sini untuk menghubungkan Anda dengan hadiah favorit Anda untuk setiap kesempatan dengan pengiriman di hari yang sama.</p>
            <a href="#reviews" class="btn">ulasan klien</a>
        </div>

    </div>

</section>

<section class="reviews" id="reviews">

    <h1 class="title">ulasan klien</h1>

    <div class="box-container">

        <div class="box">
            <img src="images/pic-1.jpg" alt="">
            <p>Pertama kali memesan dari mereka dan mereka sangat efisien! Terima kasih banyak. Senang dengan pembelian saya. Bunganya segar. Pengiriman dilakukan tanpa kerumitan.</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Hannah Delisha</h3>
        </div>

        <div class="box">
            <img src="images/pic-2.jpg" alt="">
            <p>Yang bisa saya katakan, saya senang dengan tampilan bunganya persis seperti foto yang ditampilkan. Bunga yang sempurna! Terima kasih telah mengirimkannya pagi-pagi sekali.</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Lee Sung Kyung</h3>
        </div>

        <div class="box">
            <img src="images/pic-3.jpg" alt="">
            <p>Terima kasih bunga atas layanan pelanggan Anda yang luar biasa. Saya senang dengan respons yang sangat cepat dan Anda melakukan yang terbaik dalam membantu saya dengan jangka waktu pengiriman.</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Joshua</h3>
        </div>

        <div class="box">
            <img src="images/pic-4.jpg" alt="">
            <p>Saya pelanggan tetap. Selalu menyenangkan berbelanja karena mereka memiliki banyak pilihan terbaru. Proses pengiriman selalu merupakan pengalaman yang luar biasa. Terima kasih bunga!</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Nur Asyiqin</h3>
        </div>

        <div class="box">
            <img src="images/pic-5.jpg" alt="">
            <p>Bunganya indah, dan ibuku menyukainya. Meja bantuan dukungan sangat profesional, membantu, dan ramah. Pasti akan menjadi pelanggan kembali. Pertahankan kerja bagus bunga.</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Farah Lee</h3>
        </div>

        <div class="box">
            <img src="images/pic-6.jpg" alt="">
            <p>Terima kasih bunga atas pengiriman cepat dan bunga segar. Itu adalah pesanan online pertama saya dan saya tidak menyesalinya. Bunganya seperti yang diiklankan di situs web, segar dan cantik!</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Imran Bard</h3>
        </div>

    </div>

</section>











<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>