<?php

helper('number');
$session = session();
$role = $session->get('role');

?>

<div class="card">
    <h3 class="card-header">
        Kategori
        <?php if ($role == 'admin') : ?>
            <a href="<?= base_url('penarikan/tambah') ?>" class="btn btn-primary">Tambah</a>
        <?php endif; ?>
    </h3>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <?php if (in_array($role, ['admin', 'teller'])) : ?>
                            <th scope="col">ID</th>
                        <?php endif; ?>
                        <th scope="col">Nama</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Taksiran (Kg)</th>
                        <?php if (in_array($role, ['admin', 'teller'])) : ?>
                            <th scope="col">Stok (kg)</th>
                        <?php endif; ?>
                        <th scope="col">Terakhir Diperbarui</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($kategori_list as $i => $kategori) : ?>
                        <tr>
                            <th scope="row"><?= $i + 1 ?></th>
                            <?php if (in_array($role, ['admin', 'teller'])) : ?>
                                <td><?= $kategori['id']; ?></td>
                            <?php endif; ?>
                            <td><?= $kategori['nama']; ?></td>
                            <td><?= $kategori['deskripsi']; ?></td>
                            <td><?= number_to_currency($kategori['taksiran'], 'IDR', 'id_ID'); ?></td>
                            <?php if (in_array($role, ['admin', 'teller'])) : ?>
                                <td><?= $kategori['stok']; ?></td>
                            <?php endif; ?>
                            <td><?= $kategori['terakhir_diperbarui']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if (current_url() == base_url()) :  ?>
        <div class="card-footer text-center">
            <a href="<?= base_url('kategori') ?>">Full</a>
        </div>
    <?php endif;  ?>
</div>