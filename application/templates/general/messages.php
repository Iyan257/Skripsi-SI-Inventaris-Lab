<?php if($this->session->flashdata('message') != null): ?>
    <div class="alert alert-success">
        <b>Success!</b> <?= $this->session->flashdata('message') ?>
    </div>
<?php endif; ?>

<?php if($this->session->flashdata('errors') != null): ?>
    <div class="alert alert-danger">
        <?php $errors = $this->session->flashdata('errors'); $len_error = is_array($errors)? count($errors) : 0; ?>
        <b>Error!</b> <?= $len_error <= 1? (is_array($errors)? $errors[0] : $errors) : ''?>
        <?php if($len_error > 1): ?>
            <ul class="mb-0">
                <?php foreach($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
<?php endif; ?>