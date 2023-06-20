<?php

$session = session();

?>

<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <h1>Test Ini Adalah Menu Akun Teller</h1>
    <table>
        <tr>
            <th>Username</th>
            <th>Nama Lengkap</th>
            <th>Saldo</th>
        </tr>
    </table>
    <?php foreach ($teller_list as $teller) : ?>
        <ul>
            <li><?= $n['username']; ?></li>
            <li><?= $n['nama_lengkap']; ?></li>
            <li><?= $n['saldo']; ?></li>
        </ul>
    <?php endforeach; ?>
</div>

<?= $this->endSection(); ?>