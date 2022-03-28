<?php
include "config.php";
session_start();

// Om det inte finns en seesion betyder det att man inte är inloggad
if (!isset($_SESSION['inloggad'])) {
    $_SESSION['inloggad'] = false;
}  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrera</title>
    <link rel="stylesheet" href="../bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
    if (isset($_SESSION['inloggad']) && $_SESSION['inloggad']== true) {
        echo "<p class=\"alert alert-warning\">Du är inloggad</p>";
    } else {
        echo "<p class=\"alert alert-warning\">Du är utloggad</p>";
    }
?>
    <div class="kontainer">
        <h1>Bloggen</h1>
        <nav>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php">Sign up</a>
                </li>
                <?php
                 if ($_SESSION['inloggad'] == false) {
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                 <?php
                 }
                 ?>
                <li class="nav-item active">
                    <a class="nav-link active" href="#">Logga ut</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="admin.php">Admin</a>
                </li>
            </ul>
        </nav>
        <main>
       
            <?php
                $_SESSION['inloggad'] = false;     
                header("Location: login.php");
            ?>

        </main>
    </div>
</body>
</html>