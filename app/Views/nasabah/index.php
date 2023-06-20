<?php

$session = session();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Test Ini Adalah Menu Nasabah</h1>
    <?php foreach ($nasabah as $n) : ?>
        <ul>
            <li><?= $n['username']; ?></li>
            <li><?= $n['nama_lengkap']; ?></li>
            <li><?= $n['saldo']; ?></li>
        </ul>
    <?php endforeach; ?>
</body>

</html>