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
    <form action="<?= base_url('auth/login') ?>" method="POST">
        <input type="text" name="username">
        <input type="password" name="password">
        <button>LOGIN</button>
    </form>
    <form action="<?= base_url("auth/logout") ?>" method="POST">
        <button>LOGOUT</button>
    </form>
    <?= var_dump($session->get('user')) ?>
</body>

</html>