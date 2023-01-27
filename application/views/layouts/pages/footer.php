<footer class="footer">
    <div class="footer__content _container">
        <div class="footer__column">
            <a href="/<?=$lclang?>" class="footer__logo">mscards<span>.ro</span></a>
            <p class="footer__copy"><?=RIGHTS_RESERVED?></p>
            <a href="<?=$ilab_linc?>" target="_blank" class="footer__dev"><?=$ilab?></a>
        </div>
        <div class="footer__column">
            <p class="footer__name"><?=COMPANY?></p>
            <ul class="footer__list">
                <li class="footer__item">
                    <a href="/<?=$lclang?>/<?=$menu['all'][4]->uri?>" class="footer__link"><?=$menu['all'][4]->title?></a>
                </li>
                <li class="footer__item">
                    <a href="/<?=$lclang?>/<?=$menu['all'][5]->uri?>" class="footer__link"><?=$menu['all'][5]->title?></a>
                </li>
                <li class="footer__item">
                    <a href="/<?=$lclang?>/<?=$menu['all'][6]->uri?>" class="footer__link"><?=$menu['all'][6]->title?></a>
                </li>
            </ul>
        </div>
        <div class="footer__column">
            <p class="footer__name"><?=INFORMATION?></p>
            <ul class="footer__list">
                <li class="footer__item">
                    <a href="/<?=$lclang?>/<?=$menu['all'][7]->uri?>" class="footer__link"><?=$menu['all'][7]->title?></a>
                </li>
                <li class="footer__item">
                    <a href="/<?=$lclang?>/<?=$menu['all'][8]->uri?>" class="footer__link"><?=$menu['all'][8]->title?></a>
                </li>
                <li class="footer__item">
                    <a href="/<?=$lclang?>/<?=$menu['all'][9]->uri?>" class="footer__link"><?=$menu['all'][9]->title?></a>
                </li>
            </ul>
        </div>
        <div class="footer__column">
            <p class="footer__name"><?=CONTACTS?></p>
            <ul class="footer__contacts contacts-footer">
                <li class="contacts-footer__item">
                    <div class="contacts-footer__icon">
                        <picture>
                            <source srcset="/app/img/icons/mail-icon.svg" type="image/webp">
                            <img src="/app/img/icons/mail-icon.svg" alt="Icon"></picture>
                    </div>
                    <a href="mailto:<?=CONTACTEMAIL?>" class="contacts-footer__link"><?=CONTACTEMAIL?></a>
                </li>
                <li class="contacts-footer__item">
                    <div class="contacts-footer__icon">
                        <picture>
                            <source srcset="/app/img/icons/phone-icon.svg" type="image/webp">
                            <img src="/app/img/icons/phone-icon.svg" alt="Icon"></picture>
                    </div>
                    <a href="tel:<?=CONTACTPHONE?>" class="contacts-footer__link"><?=CONTACTPHONE?></a>
                </li>
                <li class="contacts-footer__item">
                    <div class="contacts-footer__icon">
                        <picture>
                            <source srcset="/app/img/icons/location-icon.svg" type="image/webp">
                            <img src="/app/img/icons/location-icon.svg" alt="Icon"></picture>
                    </div>
                    <p class="contacts-footer__text"><?=CONTACTADDRESS?></p>
                </li>
            </ul>
        </div>
    </div>
</footer>