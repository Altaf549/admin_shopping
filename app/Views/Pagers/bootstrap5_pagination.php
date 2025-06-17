<?php
$segment = $segment ?? 'default';
$pager->setSurroundCount(1);
?>

<style>
.pagination {
    display: flex;
    justify-content: center;
    flex-wrap: wrap; /* Optional: wrap if not fitting */
    list-style: none;
    padding: 0;
}

.page-item {
    margin: 0 5px;
}

.page-link {
    display: inline-block;
    padding: 6px 12px;
    text-decoration: none;
    border: 1px solid #ddd;
    border-radius: 4px;
    color: #007bff;
}

.page-item.active .page-link {
    background-color: #007bff;
    color: white;
    border-color: #007bff;
}
</style>

<div class="d-flex justify-content-center">
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php if ($pager->hasPrevious($segment)) : ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $pager->getFirst($segment) ?>" aria-label="First">
                        <span aria-hidden="true">&laquo;&laquo;</span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="<?= $pager->getPrevious($segment) ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php foreach ($pager->links($segment) as $link): ?>
                <?php if ($link['title'] === '...') : ?>
                    <li class="page-item disabled"><span class="page-link">…</span></li>
                <?php elseif ($link['active']) : ?>
                    <li class="page-item active"><span class="page-link"><?= $link['title'] ?></span></li>
                <?php else : ?>
                    <li class="page-item"><a class="page-link" href="<?= $link['uri'] ?>"><?= $link['title'] ?></a></li>
                <?php endif; ?>
            <?php endforeach; ?>

            <?php if ($pager->hasNext($segment)) : ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $pager->getNext($segment) ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="<?= $pager->getLast($segment) ?>" aria-label="Last">
                        <span aria-hidden="true">&raquo;&raquo;</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>