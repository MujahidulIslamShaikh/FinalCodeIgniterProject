<?= $this->extend('/index') ?>
<?= $this->section('contentIndex') ?>

<style>
    .product-card {
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .product-card img {
        object-fit: cover;
        height: 200px;
    }

    @media (max-width: 576px) {
        .product-card img {
            height: 150px;
        }
    }
</style>



<!-- Product Display Section -->
<div class="container mt-5">
    <div class="row g-4">
        <?php foreach ($products as $prod): ?>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card h-100 shadow-sm product-card">
                    <img src="/uploads/<?= $prod['image'] ?>" class="card-img-top" alt="<?= $prod['name'] ?>">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?= $prod['name'] ?></h5>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<?= $this->endSection() ?>