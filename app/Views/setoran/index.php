<?php helper('number'); ?>
<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <h1>Menu Setoran</h1>
    <table class="table align-middle">
        <thead class="align-middle">
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Nama Nasabah</th>
                <th scope="col">Nama Teller</th>
                <th scope="col">Kategori Sampah</th>
                <th scope="col">Taksiran</th>
                <th scope="col">Berat (Kg)</th>
                <th scope="col">Nominal</th>
                <th scope="col">Tanggal Setor</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($setoran_list as $i => $setoran) : ?>
                <tr>
                    <td scope="row"><?= $i + 1 ?></td>
                    <td scope="row"><?= $setoran['nasabah_nama_lengkap']; ?></td>
                    <td scope="row"><?= $setoran['teller_nama_lengkap']; ?></td>
                    <td scope="row"><?= $setoran['kategori_sampah']; ?></td>
                    <td scope="row"><?= number_to_currency($setoran['taksiran'], 'IDR', 'id_ID'); ?></td>
                    <td scope="row"><?= $setoran['berat']; ?></td>
                    <td scope="row"><?= number_to_currency($setoran['nominal'], 'IDR', 'id_ID'); ?></td>
                    <td scope="row"><?= $setoran['tanggal_setor']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection(); ?>