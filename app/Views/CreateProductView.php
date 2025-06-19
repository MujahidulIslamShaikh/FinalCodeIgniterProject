

<?= $this->extend('/index') ?>
<?= $this->section('contentIndex') ?>


<div class="container my-4">

    <h1 class="mb-3">Create New Product here...</h1>
    <?= view('partials/product_form') ?> <!-- Form include -->


</div>

  
<?= $this->endSection() ?>
