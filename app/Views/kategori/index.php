<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <?= $this->include('components/list/kategori') ?>
</div>

<?= $this->endSection(); ?>