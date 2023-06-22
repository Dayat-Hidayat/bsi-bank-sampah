<?php

$session = session();
$error_list = $session->getFlashdata('error_list');
$sukses_list = $session->getFlashdata('sukses_list');

?>

<?php if ($error_list || $sukses_list) : ?>
    <div class="container">
        <?php if (isset($error_list)) : ?>
            <div class="row alert alert-danger">
                <?php foreach ($error_list as $key => $error) : ?>
                    <div>
                        <b style="text-transform: capitalize"><?= join(" ", explode("_", $key)) ?></b> <?= $error ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($sukses_list)) : ?>
            <div class="row alert alert-success">
                <?php foreach ($sukses_list as $key => $sukses) : ?>
                    <div>
                        <b style="text-transform: capitalize"><?= join(" ", explode("_", $key)) ?></b> <?= $sukses ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
<?php endif; ?>