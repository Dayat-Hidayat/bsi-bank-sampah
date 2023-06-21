<?php

$session = session();

?>

<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <h1>Menu Penarikan</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Nasabah</th>
                <th scope="col">Teller</th>
                <th scope="col">Nominal</th>
                <th scope="col">Tanggal Penarikan</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($penarikan_list as $i => $penarikan) : ?>
                <tr>
                    <td scope="row"><?= $i + 1 ?></td>
                    <td scope="row"><?= $penarikan['nasabah_nama_lengkap']; ?></td>
                    <td scope="row"><?= $penarikan['teller_nama_lengkap']; ?></td>
                    <td scope="row"><?= $penarikan['nominal']; ?></td>
                    <td scope="row"><?= $penarikan['tanggal_penarikan']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection(); ?>