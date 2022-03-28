<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biltema shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="kontainer">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="./shop.php">Lägg till</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./lista.php">kundvagnen</a>
            </li>
        </ul>
        <form class="form-control" action="./shop.php" method="post">
            <h3>Kundvagn</h3>
            <label class="form-label">Namn på vara</label>
            <input class="form-control" type="text" name="namn">

            <label class="form-label">Pris</label>
            <input class="form-control" type="text" name="pris">

            <label class="form-label">Art.</label>
            <input class="form-control" type="text" name="artnr">

            <button class="btn btn-success">Lägg till vara</button>
        </form>
        <?php
        // Ta emor data från formuläret
        $namn = filter_input(INPUT_POST, "namn");
        $pris = filter_input(INPUT_POST, "pris");
        $artnr = filter_input(INPUT_POST, "artnr");

        // Får vi data från formuläret isåfall spara ned
        if ($namn && $pris && $artnr) {
            // Kolla att det funkar
            // var_dump($namn, $pris, $artnr);

            // Klockslag
            $klockslag = date('m.d.y h:i:s');

            // Spara ned i en textfil som heter kundvagn.txt
            file_put_contents("kundvagn.txt", "$klockslag\t $namn\t $pris\t $artnr\n", FILE_APPEND);

            // Meddela användaren att vi lyckats spara i kundvagnen
            echo "<p class=\"alert alert-success\">Sparat inköp av <strong>$namn</strong> med pris <strong>$pris:-</strong> 
            och artikelnummer <strong>$artnr</strong> i kundvagnen</p>";
        }

        ?>
    </div>
</body>

</html>