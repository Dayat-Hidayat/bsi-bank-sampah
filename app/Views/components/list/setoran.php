<?php

helper('number');
$session = session();
$role = $session->get('role');

?>

<div class="card">
    <h3 class="card-header">
        Setoran
        <?php if ($role != 'nasabah') : ?>
            <a href="<?= base_url('setoran/tambah') ?>" class="btn btn-primary">Tambah</a>
        <?php endif; ?>
    </h3>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <?php if ($role == 'teller' || $role == 'admin') : ?>
                            <th scope="col">Nasabah</th>
                        <?php endif; ?>
                        <?php if ($role == 'nasabah' || $role == 'admin') : ?>
                            <th scope="col">Teller</th>
                        <?php endif; ?>
                        <th scope="col">Kategori Sampah</th>
                        <th scope="col">Berat</th>
                        <th scope="col">Taksiran (Kg)</th>
                        <th scope="col">Total</th>
                        <th scope="col">Tanggal Setor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($setoran_list as $i => $setoran) : ?>
                        <tr>
                            <th scope="row"><?= $i + 1 ?></th>
                            <?php if ($role == 'teller' || $role == 'admin') : ?>
                                <td><?= $setoran['nasabah_nama_lengkap']; ?></td>
                            <?php endif; ?>
                            <?php if ($role == 'nasabah' || $role == 'admin') : ?>
                                <td><?= $setoran['teller_nama_lengkap']; ?></td>
                            <?php endif; ?>
                            <td><?= $setoran['kategori_sampah']; ?></td>
                            <td><?= $setoran['berat']; ?></td>
                            <td><?= number_to_currency($setoran['taksiran'], 'IDR', 'id_ID'); ?></td>
                            <td><?= number_to_currency(floor($setoran['berat'] * $setoran['taksiran']), 'IDR', 'id_ID'); ?></td>
                            <td><?= $setoran['tanggal_setor']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if (current_url() == base_url()) :  ?>
        <div class="card-footer text-center">
            <a href="<?= base_url('setoran') ?>">Full</a>
        </div>
    <?php endif;  ?>
</div>