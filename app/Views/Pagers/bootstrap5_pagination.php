<?php
/**
 * @var \CodeIgniter\Pager\Pager $pager
 */
?>

<div class="d-flex justify-content-center">
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php if ($pager->hasPrevious()) : ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $pager->getFirst() ?>" aria-label="First">
                        <span aria-hidden="true">&laquo;&laquo;</span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="<?= $pager->getPrevious() ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            <?php endif ?>

            <?php foreach ($pager->links() as $link) : ?>
                <?php if ($link['title'] === '...') : ?>
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                <?php elseif ($link['active']) : ?>
                    <li class="page-item active" aria-current="page">
                        <span class="page-link"><?= $link['title'] ?></span>
                    </li>
                <?php else : ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= $link['uri'] ?>"><?= $link['title'] ?></a>
                    </li>
                <?php endif ?>
            <?php endforeach ?>

            <?php if ($pager->hasNext()) : ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $pager->getNext() ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="<?= $pager->getLast() ?>" aria-label="Last">
                        <span aria-hidden="true">&raquo;&raquo;</span>
                    </a>
                </li>
            <?php endif ?>
        </ul>
    </nav>
</div>