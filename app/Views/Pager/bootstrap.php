<?php if ($pager->getPageCount() > 1): ?>
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center pagination-lg">
        <?php if ($pager->getPrevious()): ?>
            <li class="page-item mx-1">
                <a class="page-link rounded-pill px-4 py-2" href="<?= $pager->getPrevious()['uri'] ?>" aria-label="Previous">
                    &laquo;
                </a>
            </li>
        <?php endif; ?>

        <?php foreach ($pager->links() as $link): ?>
            <li class="page-item mx-1 <?= $link['active'] ? 'active' : '' ?>">
                <a class="page-link px-4 py-2 rounded-pill <?= $link['active'] ? 'bg-primary text-white border-primary' : '' ?>"
                   href="<?= $link['uri'] ?>">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach; ?>

        <?php if ($pager->getNext()): ?>
            <li class="page-item mx-1">
                <a class="page-link rounded-pill px-4 py-2" href="<?= $pager->getNext()['uri'] ?>" aria-label="Next">
                    &raquo;
                </a>
            </li>
        <?php endif; ?>
    </ul>
</nav>
<?php endif; ?>
