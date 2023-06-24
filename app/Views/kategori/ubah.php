<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <h1>Ubah Kategori <?= $kategori['nama'] ?></h1>
    <form method="POST" action="<?= base_url('kategori/ubah/' . $kategori['id']) ?>" class="row">
        <label>
            <span>Nama Kategori</span>
            <input type="text" name="nama" value="<?= $kategori['nama'] ?>">
        </label>
        <label>
            <span>Deskripsi</span>
            <textarea name="deskripsi" id="" cols="30" rows="10"><?= $kategori['deskripsi'] ?></textarea>
        </label>
        <label>
            <span>Taksiran Harga Per Kg</span>
            <input type="number" name="taksiran" value="<?= $kategori['taksiran'] ?>">
            <span>Rupiah</span>
        </label>
        <label>
            <span>Stok</span>
            <input type="number" name="stok" value="<?= $kategori['stok'] ?>">
            <span>Kg</span>
        </label>
        <button>TAMBAH KATEGORI BARU</button>
    </form>
    <form method="POST" action="<?= base_url('kategori/hapus/' . $kategori['id']) ?>">
        <button>HAPUS KATEGORI</button>
    </form>
</div>

<?= $this->endSection(); ?>