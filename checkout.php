<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['order'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $address = mysqli_real_escape_string($conn, strtoupper($_POST['flat']).', '.strtoupper($_POST['street']).', '.$_POST['pin_code'].', '.strtoupper($_POST['city']).', '.strtoupper($_POST['country']).'.');
    date_default_timezone_set('Asia/Indonesia');
	$placed_on = date('d-M-Y H:i:s');

    $cart_total = 0;
    $cart_products[] = '';

    $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    if(mysqli_num_rows($cart_query) > 0){
        while($cart_item = mysqli_fetch_assoc($cart_query)){
            $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
            $sub_total = ($cart_item['price'] * $cart_item['quantity']);
            $cart_total += $sub_total;
        }
    }

    $total_products = implode(', ',$cart_products);

    $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

    if($cart_total == 0){
        $message[] = 'your cart is empty!';
    }elseif(mysqli_num_rows($order_query) > 0){
        $message[] = 'order placed already!';
    }else{
        mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
        mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        $message[] = 'order placed successfully!';
    }
}
if(isset($_POST['order'])){
    // Process form submission
    
    // Redirect to orders.php
    header('Location: orders.php');
    exit(); // Make sure to exit after redirection
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>pesanan pembayaran</h3>
    <p> <a href="home.php">home</a> / chekout </p>
</section>

<section class="display-order">
    <?php
        $grand_total = 0;
        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
    ?>    
    <p> <?php echo $fetch_cart['name'] ?> <span>(<?php echo 'Rp.'.$fetch_cart['price'].' x '.$fetch_cart['quantity']  ?>)</span> </p>
    <?php
        }
        }else{
            echo '<p class="empty">your cart is empty</p>';
        }
    ?>
    <div class="grand-total">Total keseluruhan: <span>Rp.<?php echo $grand_total; ?></span></div>
</section>

<section class="checkout">

    <form action="" method="POST">

        <h3>Tempatkan pesanan Anda</h3>

        <div class="flex">
            <div class="inputBox">
                <span>namamu :</span>
                <input type="text" name="name" placeholder="masukkan namamu" required>
            </div>
            <div class="inputBox">
                <span>nomormu :</span>
                <input type="text" name="number" placeholder="masukkan nomormu" required>
            </div>
            <div class="inputBox">
                <span>emailmu :</span>
                <input type="email" name="email" placeholder="tambahkan emailmu" required>
            </div>
            <div class="inputBox">
                <span>metode pembayaran :</span>
                <select name="method" required>
					<option value="" disabled selected>Pilih metode pembayaran</option>
                    <option value="Cash on delivery">Bayar di tempat</option>
                    <option value="Debit/Credit card">Kartu Debit/Kredit</option>
                    <option value="Online Banking">Perbankan online</option>
                    <option value="Touch 'n Go eWallet">Sentuh 'n Go eWallet</option>
					<option value="GrabPay">GrabPay</option>
                    <option value="Boost">Boost</option>
                </select>
            </div>
            <div class="inputBox">
                <span>baris alamat 01 :</span>
                <input type="text" name="flat" placeholder="" required>
            </div>
            <div class="inputBox">
                <span>baris alamat 02:</span>
                <input type="text" name="street" placeholder="" required>
            </div>
			<div class="inputBox">
                <span>code pos :</span>
                <input type="text" name="pin_code" placeholder="" required>
            </div>
            <div class="inputBox">
                <span>kota :</span>
                <input type="text" name="city" placeholder="" required>
            </div>
            <div class="inputBox">
				<span>provinsi :</span>
                <select name="state" required>
                    <option value="" disabled selected>Pilih provinsi bagian</option>
                    <option value="Sumatera Utara">Sumatera Utara</option>
                    <option value="Sumatera Selatan">Sumatera Selatan</option>
                    <option value="Sumatera Barat">Sumatera Barat</option>
                    <option value="Riau">Riau</option>
                    <option value="Bengkulu">Bengkulu</option>
                    <option value="Banten">Banten</option>
                    <option value="Bali">Bali</option>
                    <option value="Gorontalo">Gorontalo</option>
                    <option value="Maluku Utara">Maluku Utara</option>
                    <option value="Maluku">Maluku </option>
                    <option value="Papua Barat">Papua Barat</option>
                    <option value="DKI Jakarta">DKI Jakarta</option>
                    <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
                    <option value="Jawa Tengah">Jawa Tengah</option>
                    <option value="Jawa Barat">Jawa Barat</option>
                    <option value="Jambi">Jambi</option>
                </select>
            </div>
            <div class="inputBox">
                <span>negara :</span>
                <input type="text" name="country" placeholder="indonesia" required>
            </div>
        </div>

			<input type="submit" name="order" value="pesan sekarang" class="btn">

    </form>

</section>

<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>