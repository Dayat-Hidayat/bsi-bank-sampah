<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <?= $this->include('components/list/setoran') ?>
</div>

<?= $this->endSection(); ?>