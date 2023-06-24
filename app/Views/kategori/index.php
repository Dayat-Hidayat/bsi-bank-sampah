<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <h1>Menu Kategori</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Kategori Sampah</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Taksiran</th>
                <th scope="col">Stok</th>
                <th scope="col">Terakhir Diperbarui</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($kategori_list as $i => $setoran) : ?>
                <tr>
                    <td scope="row"><?= $i + 1 ?></td>
                    <td scope="row"><?= $setoran['nama']; ?></td>
                    <td scope="row"><?= $setoran['deskripsi']; ?></td>
                    <td scope="row"><?= $setoran['taksiran']; ?></td>
                    <td scope="row"><?= $setoran['stok']; ?></td>
                    <td scope="row"><?= $setoran['terakhir_diperbarui']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection(); ?>