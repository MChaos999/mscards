<?php if (!empty($paginator)) { ?>
    <div class="catalog-market__pagging pagging">
        <?php if ($paginator->getNumPages() > 1) { ?>
            <?php if ($paginator->getPrevUrl()) { ?>
                <a href="<?= $paginator->getPrevUrl(); ?>" class="pagging__arrow _prev">
                    <picture>
                        <source srcset="/app/img/icons/pagging-prev.svg" type="image/webp">
                        <img src="/app/img/icons/pagging-prev.svg" alt="Prev"></picture>
                </a>
            <?php } ?>
        <?php } ?>
        <ul class="pagging__list">
            <? foreach ($paginator->getPages() as $page) { ?>
                <?php if ($page['isCurrent']) { ?>
                    <li>
                        <a href="javascript:;" class="pagging__item _active"><?= $page['num'] ?></a>
                    </li>
                <?php } else { ?>
                    <li>
                        <a href="<?= str_replace("(:num)", $page['num'], $paginator->geturlPattern()); ?>"
                           class="pagging__item"><?= $page['num'] ?></a>
                    </li>
                <?php } ?>
            <?php } ?>
        </ul>
        <?php if ($paginator->getNextUrl()) { ?>
            <a href="<?= $paginator->getNextUrl(); ?>" class="pagging__arrow _next">
                <picture>
                    <source srcset="/app/img/icons/pagging-next.svg" type="image/webp">
                    <img src="/app/img/icons/pagging-next.svg" alt="Next"></picture>
            </a>
        <?php } ?>
    </div>
<?php } ?>