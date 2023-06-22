<?php

$session = session();
helper('number');

?>

<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- Start Konten -->
<div class="container">
    <h1>Test Ini Adalah Menu Nasabah</h1>

    <!-- Start Melihat Harga Taksiran Sampah -->
    <h1>Harga Taksiran Sampah</h1>
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Harga Taksiran (KG)</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($kategori as $k) : ?>
                <tr>
                    <th scope="row"><?= $i++; ?></th>
                    <td><?= $k['nama']; ?></td>
                    <td><?= number_to_currency($k['taksiran'], 'IDR', 'id_ID', 2); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- End Melihat Harga Taksiran Sampah -->

    <!-- Start Melihat Riwayat Setoran -->
    <h1>Melihat Riwayat Setoran</h1>
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">ID Teller</th>
                <th scope="col">Kategori Sampah</th>
                <th scope="col">Harga Taksiran (KG)</th>
                <th scope="col">Berat (KG)</th>
                <th scope="col">Total</th>
                <th scope="col">Tanggal Setor</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($setoran as $s) : ?>
                <tr>
                    <th scope="row"><?= $i++; ?></th>
                    <td><?= $s['id_teller']; ?></td>
                    <td><?= $s['kategori_sampah']; ?></td>
                    <td><?= number_to_currency($s['taksiran'], 'IDR', 'id_ID', 2); ?></td>
                    <td><?= $s['berat']; ?></td>
                    <td><?= number_to_currency($s['nominal'], 'IDR', 'id_ID', 2); ?></td>
                    <td><?= $s['tanggal_setor']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- End Melihat Riwayat Setoran -->

    <!-- Start Melihat Nama Teller -->
    <h1>Melihat Nama Teller</h1>
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">ID</th>
                <th scope="col">Nama Teller</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($teller as $t) : ?>
                <tr>
                    <th scope="row"><?= $i++; ?></th>
                    <td><?= $t['id']; ?></td>
                    <td><?= $t['username']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- End Melihat Nama Teller -->

    <!-- Start Melihat Tabungan -->
    <h1>Melihat Tabungan</h1>

    <?php foreach ($nasabah as $n) : ?>
        <ul>
            <li>Nama Lengkap : <?= $n['nama_lengkap']; ?></li>
            <li>Alamat : <?= $n['alamat']; ?></li>
            <li>Nomor Telepon : <?= $n['nomor_telepon']; ?></li>
            <li>Saldo : <?= number_to_currency($n['saldo'], 'IDR', 'id_ID'); ?></li>
        </ul>
    <?php endforeach; ?>
    <!-- End Melihat Tabungan -->

    <form action="/auth/logout" method="post">
        <button class="btn btn-primary">Logout</button>
    </form>

</div>
<!-- End Konten -->

<?= $this->endSection(); ?>