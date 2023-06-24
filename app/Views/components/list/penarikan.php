<?php

helper('number');
$session = session();
$role = $session->get('role');

?>

<div class="card">
    <h3 class="card-header">
        Penarikan
        <?php if ($role != 'nasabah') : ?>
            <a href="<?= base_url('penarikan/tambah') ?>" class="btn btn-primary">Tambah</a>
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
                        <th scope="col">Nominal</th>
                        <th scope="col">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($penarikan_list as $i => $penarikan) : ?>
                        <tr>
                            <th scope="row"><?= $i + 1 ?></th>
                            <?php if ($role == 'teller' || $role == 'admin') : ?>
                                <td><?= $penarikan['nasabah_nama_lengkap']; ?></td>
                            <?php endif; ?>
                            <?php if ($role == 'nasabah' || $role == 'admin') : ?>
                                <td><?= $penarikan['teller_nama_lengkap']; ?></td>
                            <?php endif; ?>
                            <td><?= number_to_currency($penarikan['nominal'], 'IDR', 'id_ID'); ?></td>
                            <td><?= $penarikan['tanggal_penarikan']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if (current_url() == base_url()) :  ?>
        <div class="card-footer text-center">
            <a href="<?= base_url('penarikan') ?>">Full</a>
        </div>
    <?php endif;  ?>
</div>