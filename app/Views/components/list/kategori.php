<?php

$session = session();
$role = $session->get('role');

?>

<div class="card">
    <h3 class="card-header">
        Kategori
        <?php if ($role == 'admin') : ?>
            <a href="<?= base_url('kategori/tambah') ?>" class="btn btn-sm btn-primary">Tambah</a>
        <?php endif; ?>
    </h3>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="align-middle">
                    <tr>
                        <th scope="col">#</th>
                        <?php if (in_array($role, ['admin', 'teller'])) : ?>
                            <th scope="col">ID</th>
                        <?php endif; ?>
                        <th scope="col">Nama</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Taksiran (kg)</th>
                        <?php if (in_array($role, ['admin', 'teller'])) : ?>
                            <th scope="col">Stok (kg)</th>
                        <?php endif; ?>
                        <th scope="col">Terakhir Diperbarui</th>
                        <th scope="col">Pilihan</th>
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
                            <td>
                                <a href="<?= base_url('kategori/ubah/') . $kategori['id']; ?>" class="btn btn-outline-warning">Ubah</a>
                                <a href="<?= base_url('kategori/hapus/') . $kategori['id']; ?>" onclick="return confirm('Kamu yakin akan menghapus <?= $title . ' ' . $kategori['nama']; ?> ?');" class="btn btn-outline-danger">Hapus</a>
                            </td>
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