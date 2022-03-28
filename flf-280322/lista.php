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
                <a class="nav-link" href="./shop.php">Lägg till</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page"  href="./lista.php">kundvagnen</a>
            </li>
        </ul>
        <h3>Spara i kundvagnen</h3>
        <?php
        $varor = file_get_contents("Kundvagn.txt");

        echo "<pre>$varor</pre>";
        ?>
    </div>
</body>

</html>