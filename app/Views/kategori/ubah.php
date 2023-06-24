<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container" style="max-width:640px">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title text-center py-4">
                Ubah Kategori <?= $kategori['nama'] ?>
            </h2>
            <form action="<?= base_url('kategori/ubah/' . $kategori['id']) ?>" method="POST" class="mx-auto">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Kategori</label>
                    <input type="text" id="nama" name="nama" placeholder="Nama Kategori" class="form-control" value="<?= $kategori['nama'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" placeholder="Deskripsi" class="form-control"><?= $kategori['deskripsi'] ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="taksiran" class="form-label">Taksiran (kg)</label>
                    <input type="number" id="taksiran" name="taksiran" placeholder="Taksiran (kg)" class="form-control" value="<?= $kategori['taksiran'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="stok" class="form-label">Stok (kg)</label>
                    <input type="number" id="stok" name="stok" placeholder="Stok (kg)" class="form-control" value="<?= $kategori['stok'] ?>" required>
                </div>
                <button class="btn btn-primary w-100">Ubah Kategori</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>