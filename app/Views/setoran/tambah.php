<?php

$session = session();
$role = $session->get('role');
$logged_in_user = $session->get('user');

?>

<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <h1>Buat Setoran Baru</h1>
    <form method="POST" action="<?= base_url('setoran/tambah') ?>" class="row">
        <label>
            <span>Nasabah</span>
            <select name="id_nasabah" id="">
                <?php foreach ($nasabah_list as $nasabah) : ?>
                    <option value="<?= $nasabah['id'] ?>"><?= $nasabah['nama_lengkap'] ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <label>
            <span>Teller</span>

            <?php
            // Jika yang login adalah seorang teller, maka teller tidak dapat memilih teller lain
            // Jika yang login adalah seorang admin, maka admin dapat memilih teller lain
            if ($role == 'teller') :
            ?>
                <input type="text" value="<?= $logged_in_user['nama_lengkap'] ?>" readonly />
                <input type="hidden" name="id_teller" value="<?= $logged_in_user['id'] ?>">
            <?php else : ?>
                <select name="id_teller">
                    <?php foreach ($teller_list as $teller) : ?>
                        <option value="<?= $teller['id'] ?>"><?= $teller['nama_lengkap'] ?></option>
                    <?php endforeach; ?>
                </select>
            <?php endif; ?>
        </label>
        <label>
            <span>Kategori Sampah</span>
            <select name="id_kategori_sampah" id="">
                <?php foreach ($kategori_sampah_list as $kategori_sampah) : ?>
                    <option value="<?= $kategori_sampah['id'] ?>"><?= $kategori_sampah['nama'] ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <label>
            <span>Berat</span>
            <input type="number" name="berat" step="0.01">
            <span>kg</span>
        </label>
        <button>TAMBAH SETORAN BARU</button>
    </form>
</div>

<?= $this->endSection(); ?>