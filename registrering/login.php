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
                <li class="nav-item ">
                    <a class="nav-link active" href="login.php">Login</a>
                </li>
                 <?php
                 }
                 if ($_SESSION['inloggad'] == true) {

                 
                 ?>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logga ut</a>
                </li>
                <?php
                 }
                ?>
            </ul>
        </nav>
        <main>
            <form action="login.php" method="POST">
                <h3>Login</h3>
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
                <button type="submit" class="btn btn-primary">Sign in</button>
            </form>

            <?php
            //Ta emot data
            $email = filter_input(INPUT_POST, 'email');
            $pw = filter_input(INPUT_POST, 'pw');

            //Testa att allt funkar
            if ($email && $pw) {

                //Check the variables above
                //var_dump($name, $pw, $email);

                //Check if $name or $email is not already in use
                $sql = "SELECT * FROM `Register` WHERE `Email` = '$email'";

                //Kör SQL-kommandot
                $resultat = $conn->query($sql);

                // Gick bra att köra SQL-satsen?
                if (!$resultat) {
                    die("<p class=\"alert alert-danger\">You died because SQL</p>");
                } else {
                // Plocka ut svaret och lägg det i arrayen $rad
                $rad = $resultat->fetch_assoc();

                // Kolla om lösenordet och hashen matchar
                if (password_verify($pw, $rad["hash"])) {
                    echo "<p class=\"alert alert-success\">Epost eller lösenord stämmer </p>";

                    // Kom ihåg att vi lyckats logga in
                    $_SESSION['inloggad'] =true;

                    header("Location: admin.php");
                } else {
                    echo "<p class=\"alert alert-danger\">Epost eller lösenord stämmer inte </p>";
                }
            }
        }
            ?>

        </main>
    </div>
</body>
</html>