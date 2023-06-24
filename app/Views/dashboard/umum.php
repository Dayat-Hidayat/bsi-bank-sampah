<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row g-5">
        <div class="col-lg-6 text-center">
            <div class="card">
                <img src="https://images.unsplash.com/photo-1604187351574-c75ca79f5807?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=30" class="card-img-top" />
                <div class="card-body">
                    <h2 class="card-title">
                        Selamat datang di website resmi Bank Sampah
                    </h2>
                    <p class="card-text">Silahkan datang ke lokasi untuk menjadi nasabah dan mulai menabung</p>
                    <p class="card-text"> Sudah menjadi nasabah? <a href="<?= base_url('auth/login') ?>">Login</a></p>
                </div>
                <h6 class="card-footer">Lokasi: Psr. Soekarno Hatta No. 906, Singkawang 56193, Gorontalo</h6>

            </div>

        </div>
        <div class="col-lg-6">
            <?= $this->include('components/list/kategori') ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>