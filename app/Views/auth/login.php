<?php

$session = session();

?>

<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container centered">
    <form action="<?= base_url('auth/login') ?>" method="POST">
        <input type="text" name="username">
        <input type="password" name="password">
        <select name="role" id="">
            <option value="admin">Admin</option>
            <option value="teller">Teller</option>
            <option value="nasabah" selected>Nasabah</option>
        </select>
        <button>LOGIN</button>
    </form>
    <form action="<?= base_url("auth/logout") ?>" method="POST">
        <button>LOGOUT</button>
    </form>
    <?= var_dump($session->get('role')) ?>
    <?= var_dump($session->get('user')) ?>
</div>
<?= $this->endSection(); ?>