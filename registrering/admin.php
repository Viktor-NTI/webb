<?php
include "config.php";
session_start();

// Om det inte finns en seesion betyder det att man inte är inloggad
if (!isset($_SESSION['inloggad'])) {
    $_SESSION['inloggad'] = false;
}
 // Skickas direkt till login.php
 if ($_SESSION['inloggad'] == false) {
    header("Location: login.php");
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
                <?php
                 if ($_SESSION['inloggad'] == false) {
                     ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Sign up</a>
                    </li>
                <li class="nav-item ">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                 <?php
                 }
                 if ($_SESSION['inloggad'] == true) {
                 ?>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logga ut</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link active" href="admin.php">Admin</a>
                </li>
                <?php
                 }
                ?>
            </ul>
        </nav>
        <main>
            <h3>Registrerade användare</h3>
            <?php 
            // Lista alla användare
            // Steg 1: SQL-satsen
            $sql = "SELECT * FROM `Register`";

            // Steg 2: kör SQL-satsen
            $resultat = $conn->query($sql);

             // Gick bra att köra SQL-satsen?
             if (!$resultat) {
                die("<p class=\"alert alert-danger\">You died because SQL</p>");
            } else {
                // Steg 3: bearbeta resultatet
                echo "<table class=\"table table-striped\">
                <thead>
                    <tr>
                      <th>Id</th>
                      <th>Namn</th>
                      <th>Email</th>
                    </tr>
                </thead>
                <tbody>";
                while ($rad = $resultat->fetch_assoc()) {
                    echo "<tr>
                    <td>$rad[id]</td>
                    <td>$rad[namn]</td>
                    <td>$rad[email]</td>
                    </tr>";
                }
                echo "</tbody>
                </table>";
            }
            ?>
        </main>
    </div>
</body>
</html>