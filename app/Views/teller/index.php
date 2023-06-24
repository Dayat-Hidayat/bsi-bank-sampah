<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <h1>Menu Akun Teller</h1>
    <table class="table align-middle">
        <thead class="align-middle">
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Username</th>
                <th scope="col">Nama Lengkap</th>
                <th scope="col">Nomor Telepon</th>
                <th scope="col">Tanggal Daftar</th>
                <th scope="col">Terakhir Login</th>
                <th scope="col">Status Akun</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($teller_list as $index => $teller) : ?>
                <tr>
                    <td scope="row"><?= $index + 1 ?></td>
                    <td scope="row"><?= $teller['username']; ?></td>
                    <td scope="row"><?= $teller['nama_lengkap']; ?></td>
                    <td scope="row"><?= $teller['nomor_telepon']; ?></td>
                    <td scope="row"><?= $teller['tanggal_daftar']; ?></td>
                    <td scope="row"><?= $teller['terakhir_login']; ?></td>
                    <td scope="row"><?= $teller['is_active'] ? 'Aktif' : 'Nonaktif' ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<?= $this->endSection(); ?>