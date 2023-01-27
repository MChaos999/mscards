<main class="page">
    <section class="breadcrums">
        <div class="breadcrums__container _container">
            <ul class="breadcrums__list">
                <li class="breadcrums__item">
                    <a href="/<?=$lclang?>" class="breadcrums__link"><?=$menu['all'][1]->title?></a>
                </li>
                <li class="breadcrums__item">
                    <span class="breadcrums__link"><?=$page_name?></span>
                </li>
            </ul>
        </div>
    </section>
    <section class="contacts">
        <div class="contacts__container _container">
            <h2 class="contacts__title"><?=$page_name?></h2>
            <div class="contacts__content">
                <div class="contacts__info info-contacts">
                    <ul class="info-contacts__list">
                        <li class="info-contacts__item">
                            <div class="info-contacts__name">
                                <picture>
                                    <source srcset="/app/img/icons/contacts/local.svg" type="image/webp">
                                    <img src="/app/img/icons/contacts/local.svg" alt="Icon"></picture>
                                <span><?=THE_ADDRESS?></span>
                            </div>
                            <div class="info-contacts__value">
                                <p><?=CONTACT_ADDRESS?></p>
                            </div>
                        </li>
                        <li class="info-contacts__item">
                            <div class="info-contacts__name">
                                <picture>
                                    <source srcset="/app/img/icons/contacts/phone.svg" type="image/webp">
                                    <img src="/app/img/icons/contacts/phone.svg" alt="Icon"></picture>
                                <span><?=THE_PHONE?></span>
                            </div>
                            <div class="info-contacts__value">
                                <a href="tel:<?=CONTACT_PHONE?>"><?=CONTACT_PHONE?></a>
                            </div>
                        </li>
                        <li class="info-contacts__item">
                            <div class="info-contacts__name">
                                <picture>
                                    <source srcset="/app/img/icons/contacts/mail.svg" type="image/webp">
                                    <img src="/app/img/icons/contacts/mail.svg" alt="Icon"></picture>
                                <span><?=THE_EMAIL?></span>
                            </div>
                            <div class="info-contacts__value">
                                <a href="mailto:<?=CONTACT_EMAIL?>"><?=CONTACT_EMAIL?></a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="contacts__feedback feedback-contacts">
                    <h3 class="feedback-contacts__title"><?=WRITE_TO_US?></h3>
                    <form action="" class="feedback-contacts__form" method="post">
                        <div class="feedback-contacts__main">
                            <div class="feedback-contacts__info">
                                <div class="feedback-contacts__item">
                                    <label class="feedback-contacts__label"><?=YOUR_NAME?></label>
                                    <input type="text" name="name" class="feedback-contacts__input">
                                </div>
                                <div class="feedback-contacts__item">
                                    <label class="feedback-contacts__label"><?=YOUR_PHONE?></label>
                                    <input type="tel" name="phone" class="feedback-contacts__input">
                                </div>
                                <div class="feedback-contacts__item">
                                    <label class="feedback-contacts__label"><?=THE_EMAIL?></label>
                                    <input type="email" name="email" class="feedback-contacts__input">
                                </div>
                            </div>
                            <div class="feedback-contacts__massage">
                                <label class="feedback-contacts__label"><?=YOUR_MESSAGE?></label>
                                <textarea name="message" class="feedback-contacts__textarea"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="feedback-contacts__button">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.91202 11.9998H4.00002L2.02302 4.1348C2.01036 4.0891 2.00265 4.04216 2.00002 3.9948C1.97802 3.2738 2.77202 2.7738 3.46002 3.1038L22 11.9998L3.46002 20.8958C2.78002 21.2228 1.99602 20.7368 2.00002 20.0288C2.00204 19.9655 2.01316 19.9029 2.03302 19.8428L3.50002 14.9998"
                                      stroke="#2779F6" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                            <?=SEND?>
                        </button>
                    </form>
                </div>
            </div>
            <div class="contacts__map" id="map">
                <?=CONTACT_MAP?>
            </div>
        </div>
    </section>
</main>
<?php if (!empty($messaje)){?>
        <div id="popup_success" class="quiz">
            <div class="popup_bg"></div>
            <div class="popup-block quiz__form-wrapper">
                <a href="/en" class="main-header__logo">mscards<span>.ro</span></a>
                <h1 class="popup-block__title"><?= $messaje ?></h1>
            </div>
        </div>
<?php } ?>
