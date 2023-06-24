<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row g-5">
        <div class="col-sm-6 text-center">
            <h2>Selamat datang di website Bank Sampah</h2>
            <p>Silahkan datang ke untuk menjadi nasabah dan mulai menabung</p>
            <h3>Sudah menjadi nasabah?</h3>
            <a href="<?= base_url('auth/login') ?>" class="btn btn-primary">Login</a>
        </div>
        <div class="col-sm-6">
            <?= $this->include('components/list/kategori') ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>