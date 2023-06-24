<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container" style="max-width:640px">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title text-center py-4">
                Pendaftaran Nasabah Baru
            </h2>
            <form action="<?= base_url('nasabah/tambah') ?>" method="POST" class="mx-auto">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" placeholder="Username" class="form-control" required>
                </div>
                <div class="row">
                    <div class="col-md mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" placeholder="Password" class="form-control" required>
                    </div>
                    <div class="col-md mb-3">
                        <label for="konfirmasi_password" class="form-label">Konfirmasi Password</label>
                        <input type="password" id="konfirmasi_password" name="konfirmasi_password" placeholder="Konfirmasi Password" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea id="alamat" name="alamat" placeholder="Alamat" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                    <input type="tel" id="nomor_telepon" name="nomor_telepon" placeholder="Nomor Telepon: 1234-5678-9123" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" placeholder="Email" class="form-control" required>
                </div>
                <button class="btn btn-primary w-100">Daftarkan Nasabah</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>