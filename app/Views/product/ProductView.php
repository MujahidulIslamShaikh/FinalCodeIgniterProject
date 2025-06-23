<?= $this->extend('/index') ?>
<?= $this->section('contentIndex') ?>


<?php
echo view('/product/ProductListTable'); 

?>



<?= $this->endSection(); ?>