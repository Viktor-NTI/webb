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
                    <a class="nav-link active" aria-current="page" href="#">Sign up</a>
                </li>
                <?php
                  if ($_SESSION['inloggad']== false) {
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                 <?php
                 } else {
                 ?>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logga ut</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="admin.php">Admin</a>
                </li>
                <?php
                 }
                 ?>
            </ul>
        </nav>
        <main>
            <form action="index.php" method="POST">
                <h3>Register user</h3>
                <div class="row mb-3">
                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" name="name">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail" name="email">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword" name="pw">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary fuck-you-bootstrap">Sign up</button>
            </form>
            <?php
            //Ta emot data
            $name = filter_input(INPUT_POST, 'name');
            $email = filter_input(INPUT_POST, 'email');
            $pw = filter_input(INPUT_POST, 'pw');

            //Testa att allt funkar
            if ($name && $email && $pw) {

                //Check the variables above
                //var_dump($name, $pw, $email);

                //Check if $name or $email is not already in use
                $sql = "SELECT * FROM `Register` WHERE `Namn` = '$name' OR `Email` = '$email'";

                //Kör SQL-kommandot
                $resultat = $conn->query($sql);

                if ($resultat->num_rows > 0) {
                    echo ("<p class=\"alert alert-danger\">The name or email is already in use. Please try again</p>");
                } else {
                    //Räkna fram ett hash från lösenordet
                    $hash = password_hash($pw, PASSWORD_DEFAULT);

                    //Lagra i databasen
                    //1. SQL-kommandot
                    $sql = "INSERT INTO Register (Namn, Email, Hash) VALUES ('$name', '$email', '$hash')";

                    /* Check the data sent to SQL
                    echo $sql;
                    die(); 
                    */

                    //2. Kör SQL-kommandot
                    $resultat = $conn->query($sql);

                    //3. Funkade SQL-Kommandot
                    if (!$resultat) {
                        die("<p class=\"alert alert-danger\">You died because SQL</p>");
                    } else {
                        echo "<p class=\"alert alert-success\">User $name is registered</p>";
                    }
                }
            } else {
                echo ("<p class=\"alert alert-danger\">One of the fields are empty</p>");
            }
            ?>
        </main>
    </div>
</body>
</html>