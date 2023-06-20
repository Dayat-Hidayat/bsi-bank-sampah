<?php

$session = session();

?>

<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <form action="<?= base_url('auth/login') ?>" method="POST">
        <input type="text" name="username">
        <input type="password" name="password">
        <button>LOGIN</button>
    </form>
    <form action="<?= base_url("auth/logout") ?>" method="POST">
        <button>LOGOUT</button>
    </form>
    <?= var_dump($session->get('user')) ?>
</div>
<?= $this->endSection(); ?>