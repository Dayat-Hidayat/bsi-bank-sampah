<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <h1>Buat Kategori Baru</h1>
    <form method="POST" action="<?= base_url('kategori/tambah') ?>" class="row">
        <label>
            <span>Nama Kategori</span>
            <input type="text" name="nama">
        </label>
        <label>
            <span>Deskripsi</span>
            <textarea name="deskripsi" id="" cols="30" rows="10"></textarea>
        </label>
        <label>
            <span>Taksiran Harga Per Kg</span>
            <input type="number" name="taksiran">
            <span>Rupiah</span>
        </label>
        <label>
            <span>Stok</span>
            <input type="number" name="stok">
        </label>
        <button>TAMBAH</button>
    </form>
</div>

<?= $this->endSection(); ?>