<?php helper('number');
$session = session(); ?>
<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <h1>Test Ini Adalah Menu Akun Nasabah <?= $username_login; ?></h1>
    <table class="table align-middle">
        <thead class="align-middle">
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Username</th>
                <th scope="col">Nama Lengkap</th>
                <th scope="col">Alamat</th>
                <th scope="col">Nomor Telepon</th>
                <th scope="col">Tanggal Daftar</th>
                <th scope="col">Terakhir Login</th>
                <th scope="col">Saldo</th>
                <th scope="col">Status Akun</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($nasabah_list as $i => $nasabah) : ?>
                <tr>
                    <td scope="row"><?= $i + 1 ?></td>
                    <td scope="row"><?= $nasabah['username']; ?></td>
                    <td scope="row"><?= $nasabah['nama_lengkap']; ?></td>
                    <td scope="row"><?= $nasabah['alamat']; ?></td>
                    <td scope="row"><?= $nasabah['nomor_telepon']; ?></td>
                    <td scope="row"><?= $nasabah['tanggal_daftar']; ?></td>
                    <td scope="row"><?= $nasabah['terakhir_login']; ?></td>
                    <td scope="row"><?= number_to_currency($nasabah['saldo'], 'IDR', 'id_ID'); ?></td>
                    <td scope="row"><?= $nasabah['is_active'] ? 'Aktif' : 'Nonaktif' ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection(); ?>