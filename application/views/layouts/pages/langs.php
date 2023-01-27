<div data-da=".main-header__container,991,3" class="top-header__language language">
    <ul class="language__list">
    <?php if (!empty($langs_array)) : ?>
        <?php foreach ($langs_array as $lang => $link): ?>
            <?php
            $langLink = $protocol . $host . '/' . \strtolower($lang);
            $langLink .= (isset($page_uri)) ? '/' . $page_uri : '';
            if (is_array($link)) {
                foreach ($link as $item) {
                    $langLink .= (!empty($item)) ? '/' . $item : '';
                }
            } else {
                $langLink .= (!empty($link)) ? '/' . $link : '';
            }
            $data_link_without_get = $langLink;
            $langLink .= (!empty($get_data)) ? '?' . $get_data : '';
            ?>
            <li class="language__item <?= uri(1) == $lang || $_SESSION['lang'] == $lang ? '_active' : '' ?>">
                <a href="javascript:;"
                   class="language__link"
                   data-link="<?= $data_link_without_get ?>"
                   title="<?= $lang ?>" onclick="changeLangue(this)">
                    <?= $lang_title[$lang] ?>
                </a>
            </li>
        <?php endforeach; ?>
    <?php endif; ?>
    </ul>
</div>