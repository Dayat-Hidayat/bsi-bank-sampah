<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <h1>Perbarui Data Teller <?= $teller['nama_lengkap'] ?></h1>
    <form method="POST" action="<?= base_url('teller/ubah/' . $teller['id']) ?>" class="row">
        <label>
            <span>Username</span>
            <input type="text" name="username" value="<?= $teller['username'] ?>">
        </label>
        <label>
            <span>Nama Lengkap</span>
            <input type="text" name="nama_lengkap" value="<?= $teller['nama_lengkap'] ?>">
        </label>
        <label>
            <span>Email</span>
            <input type="email" name="email" value="<?= $teller['username'] ?>">
        </label>
        <label>
            <span>Nomor Telepon</span>
            <input type="text" name="nomor_telepon" value="<?= $teller['username'] ?>">
        </label>
        <button>PERBARUI DATA</button>
    </form>
    <form method="POST" action="<?= base_url('teller/ubah/' . $teller['id'] . '/ganti-password') ?>" class="row">
        <label>
            <span>Password Lama</span>
            <input type="password" name="password_lama">
        </label>
        <label>
            <span>Password Baru</span>
            <input type="password" name="password_baru">
        </label>
        <label>
            <span>Konfirmasi Password Baru</span>
            <input type="password" name="konfirmasi_password_baru">
        </label>
        <button>GANTI PASSWORD</button>
    </form>
</div>

<?= $this->endSection(); ?>