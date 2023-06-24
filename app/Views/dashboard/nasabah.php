<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row g-5">
        <div class="col-sm-12">
            <?= $this->include('components/list/kategori') ?>
        </div>
        <div class="col-sm-6">
            <?= $this->include('components/list/setoran') ?>
        </div>
        <div class="col-sm-6">
            <?= $this->include('components/list/penarikan') ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>