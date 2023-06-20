<?php

$session = session();

?>

<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <h1>Test Ini Adalah Menu Nasabah</h1>
    <?php foreach ($nasabah as $n) : ?>
        <ul>
            <li><?= $n['username']; ?></li>
            <li><?= $n['nama_lengkap']; ?></li>
            <li><?= $n['saldo']; ?></li>
        </ul>
    <?php endforeach; ?>
</div>

<?= $this->endSection(); ?>