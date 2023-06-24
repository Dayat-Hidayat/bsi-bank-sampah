<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <?= $this->include('components/list/penarikan') ?>
</div>

<?= $this->endSection(); ?>