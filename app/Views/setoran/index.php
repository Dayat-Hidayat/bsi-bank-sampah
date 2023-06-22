<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <h1>Menu Setoran</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Nasabah</th>
                <th scope="col">Teller</th>
                <th scope="col">Kategori Sampah</th>
                <th scope="col">Taksiran</th>
                <th scope="col">Berat</th>
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
                    <td scope="row"><?= $setoran['taksiran']; ?></td>
                    <td scope="row"><?= $setoran['berat']; ?></td>
                    <td scope="row"><?= $setoran['nominal']; ?></td>
                    <td scope="row"><?= $setoran['tanggal_setor']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection(); ?>