<?php

@include 'config.php';

if (isset($_POST['submit'])) {

   $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $name = mysqli_real_escape_string($conn, $filter_name);
   $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $email = mysqli_real_escape_string($conn, $filter_email);
   $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $pass = mysqli_real_escape_string($conn, md5($filter_pass));
   $filter_cpass = filter_var($_POST['cpass'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $cpass = mysqli_real_escape_string($conn, md5($filter_cpass));

   // Check for existing username or email
   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' OR name = '$name'") or die('query failed');

   if (mysqli_num_rows($select_users) > 0) {
      $message[] = 'Username or email is already taken!';
   } else {
      // Validate username format
      if (!preg_match('/^[a-zA-Z0-9_]+$/', $name)) {
         $message[] = 'Username can only contain letters, numbers, and underscores!';
      } else {
         // Password validation
         if (strlen($_POST['pass']) < 6) {
            $message[] = 'Password must have at least 6 characters!';
         } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/', $_POST['pass'])) {
            $message[] = 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one symbol!';
         } elseif ($pass != $cpass) {
            $message[] = 'Confirm password does not match!';
         } else {
            // Prepare the insert statement
            $stmt = mysqli_prepare($conn, "INSERT INTO `users`(name, email, password) VALUES (?, ?, ?)") or die('query failed');
            mysqli_stmt_bind_param($stmt, "sss", $name, $email, $pass);
            
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
               // Redirect to login page
               header("location: login.php");
            } else {
               echo "Oops! Something went wrong. Please try again later.";
            }
         }
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Daftar</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<style>
    body{
        background-image: url("images/home-bg.png");
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   
<section class="form-container">

   <form action="" method="post">
      <h3>Daftar sekarang</h3>
      <input type="text" name="name" class="box" placeholder="masukkan nama" required>
      <input type="email" name="email" class="box" placeholder="masukkan email" required>
      <input type="password" name="pass" class="box" placeholder="masukkan kata sandi Anda" required>
      <input type="password" name="cpass" class="box" placeholder="konfirmasi password Anda" required>
      <input type="submit" class="btn" name="submit" value="daftar sekarang!">
      <p>Sudah memiliki akun? <a href="login.php">Masuk sekarang</a></p>
   </form>

</section>

</body>
</html>