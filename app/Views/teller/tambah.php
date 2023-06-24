<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <h1>Buat Teller Baru</h1>
    <form method="POST" action="<?= base_url('teller/tambah') ?>" class="row">
        <label>
            <span>Username</span>
            <input type="text" name="username">
        </label>
        <label>
            <span>Password</span>
            <input type="password" name="password">
        </label>
        <label>
            <span>Konfirmasi Password</span>
            <input type="password" name="konfirmasi_password">
        </label>
        <label>
            <span>Nama Lengkap</span>
            <input type="text" name="nama_lengkap">
        </label>
        <label>
            <span>Email</span>
            <input type="email" name="email">
        </label>
        <label>
            <span>Nomor Telepon</span>
            <input type="text" name="nomor_telepon">
        </label>
        <button>TAMBAH TELLER BARU</button>
    </form>
</div>

<?= $this->endSection(); ?>