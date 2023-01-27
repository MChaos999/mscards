<main class="page">
    <section class="breadcrums">
        <div class="breadcrums__container _container">
            <ul class="breadcrums__list">
                <li class="breadcrums__item">
                    <a href="/<?= $lclang ?>" class="breadcrums__link"><?= $menu['all'][1]->title ?></a>
                </li>
                <li class="breadcrums__item">
                    <span class="breadcrums__link"><?= $page_name ?></span>
                </li>
            </ul>
        </div>
    </section>
    <form action="" class="form_cards_send" method="post">
        <section class="customs">
            <div class="customs__container _container">
                <h2 class="customs__title"><?= $page_name ?></h2>
                <div class="customs__content">
                    <div class="customs__row">
                        <div class="customs__head">
                            <div class="customs__step">1</div>
                            <p class="customs__name"><?= CARD_SIZE ?></p>
                        </div>
                        <div class="customs__body">
                            <div class="customs__card card-customs">
                                <label class="card-customs__item">
                                    <input type="radio" name="size" value="<?= CARD_SIZE1 ?>" class="card-customs__radio">
                                    <div class="card-customs__content">
                                        <div class="card-customs__image">
                                            <picture>
                                                <source srcset="/app/img/customs/size/big.svg" type="image/webp">
                                                <img src="/app/img/customs/size/big.svg" alt="Image"></picture>
                                        </div>
                                        <p class="card-customs__text"><?= CARD_SIZE1 ?></p>
                                        <div class="card-customs__icon"></div>
                                    </div>
                                </label>
                                <label class="card-customs__item">
                                    <input type="radio" name="size" value="<?= CARD_SIZE2 ?>" class="card-customs__radio">
                                    <div class="card-customs__content">
                                        <div class="card-customs__image _mini">
                                            <picture>
                                                <source srcset="/app/img/customs/size/small.svg" type="image/webp">
                                                <img src="/app/img/customs/size/small.svg" alt="Image"></picture>
                                        </div>
                                        <p class="card-customs__text"><?= CARD_SIZE2 ?></p>
                                        <div class="card-customs__icon"></div>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="customs__next"><?= THE_NEXT_STEP ?></div>
                    </div>
                    <div class="customs__row">
                        <div class="customs__head">
                            <div class="customs__step">2</div>
                            <p class="customs__name"><?= CARD_TYPE ?></p>
                        </div>
                        <div class="customs__body">
                            <div class="customs__card card-customs">
                                <label class="card-customs__item">
                                    <input type="radio" name="type-card" value="<?= CARD_TYPE1 ?>" class="card-customs__radio">
                                    <div class="card-customs__content">
                                        <div class="card-customs__image">
                                            <picture>
                                                <source srcset="/app/img/customs/type/01.svg" type="image/webp">
                                                <img src="/app/img/customs/type/01.svg" alt="Image"></picture>
                                        </div>
                                        <p class="card-customs__text"><?= CARD_TYPE1 ?></p>
                                        <div class="card-customs__icon"></div>
                                    </div>
                                </label>
                                <label class="card-customs__item">
                                    <input type="radio" name="type-card" value="<?= CARD_TYPE2 ?>" class="card-customs__radio">
                                    <div class="card-customs__content">
                                        <div class="card-customs__image">
                                            <picture>
                                                <source srcset="/app/img/customs/type/02.svg" type="image/webp">
                                                <img src="/app/img/customs/type/02.svg" alt="Image"></picture>
                                        </div>
                                        <p class="card-customs__text"><?= CARD_TYPE2 ?></p>
                                        <div class="card-customs__icon"></div>
                                    </div>
                                </label>
                                <label class="card-customs__item">
                                    <input type="radio" name="type-card" value="<?= CARD_TYPE3 ?>" class="card-customs__radio">
                                    <div class="card-customs__content">
                                        <div class="card-customs__image">
                                            <picture>
                                                <source srcset="/app/img/customs/type/03.svg" type="image/webp">
                                                <img src="/app/img/customs/type/03.svg" alt="Image"></picture>
                                        </div>
                                        <p class="card-customs__text"><?= CARD_TYPE3 ?></p>
                                        <div class="card-customs__icon"></div>
                                    </div>
                                </label>
                                <label class="card-customs__item">
                                    <input type="radio" name="type-card" value="<?= CARD_TYPE4 ?>" class="card-customs__radio">
                                    <div class="card-customs__content">
                                        <div class="card-customs__image">
                                            <picture>
                                                <source srcset="/app/img/customs/type/04.svg" type="image/webp">
                                                <img src="/app/img/customs/type/04.svg" alt="Image"></picture>
                                        </div>
                                        <p class="card-customs__text"><?= CARD_TYPE4 ?></p>
                                        <div class="card-customs__icon"></div>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="customs__next"><?= THE_NEXT_STEP ?></div>
                    </div>
                    <div class="customs__row">
                        <div class="customs__head">
                            <div class="customs__step">3</div>
                            <p class="customs__name"><?= CARD_COATING ?></p>
                        </div>
                        <div class="customs__body">
                            <div class="customs__selected selected-customs">
                                <div class="selected-customs__content">
                                    <label class="selected-customs__item">
                                        <input type="radio" name="coating" value="<?= CARD_COATING1 ?>" class="selected-customs__input">
                                        <p class="selected-customs__text"><span><?= CARD_COATING1 ?></span></p>
                                    </label>
                                    <label class="selected-customs__item">
                                        <input type="radio" name="coating" value="<?= CARD_COATING2 ?>" class="selected-customs__input">
                                        <p class="selected-customs__text"><span><?= CARD_COATING2 ?></span></p>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="customs__next"><?= THE_NEXT_STEP ?></div>
                    </div>
                    <div class="customs__row">
                        <div class="customs__head">
                            <div class="customs__step">4</div>
                            <p class="customs__name"><?= CARD_ADDITIONALLY ?></p>
                        </div>
                        <div class="customs__body">
                            <div class="customs__card card-customs">
                                <label class="card-customs__item">
                                    <input type="radio" name="add" value="<?= CARD_ADDITIONALLY1 ?>" class="card-customs__radio">
                                    <div class="card-customs__content">
                                        <div class="card-customs__image">
                                            <picture>
                                                <source srcset="/app/img/customs/add/01.svg" type="image/webp">
                                                <img src="/app/img/customs/add/01.svg" alt="Image"></picture>
                                        </div>
                                        <p class="card-customs__text"><?= CARD_ADDITIONALLY1 ?></p>
                                        <div class="card-customs__icon"></div>
                                    </div>
                                </label>
                                <label class="card-customs__item">
                                    <input type="radio" name="add" value="<?= CARD_ADDITIONALLY2 ?>" class="card-customs__radio">
                                    <div class="card-customs__content">
                                        <div class="card-customs__image">
                                            <picture>
                                                <source srcset="/app/img/customs/add/02.svg" type="image/webp">
                                                <img src="/app/img/customs/add/02.svg" alt="Image"></picture>
                                        </div>
                                        <p class="card-customs__text"><?= CARD_ADDITIONALLY2 ?></p>
                                        <div class="card-customs__icon"></div>
                                    </div>
                                </label>
                                <label class="card-customs__item">
                                    <input type="radio" name="add" value="<?= CARD_ADDITIONALLY3 ?>" class="card-customs__radio">
                                    <div class="card-customs__content">
                                        <div class="card-customs__image">
                                            <picture>
                                                <source srcset="/app/img/customs/add/03.svg" type="image/webp">
                                                <img src="/app/img/customs/add/03.svg" alt="Image"></picture>
                                        </div>
                                        <p class="card-customs__text"><?= CARD_ADDITIONALLY3 ?></p>
                                        <div class="card-customs__icon"></div>
                                    </div>
                                </label>
                                <label class="card-customs__item">
                                    <input type="radio" name="add" value="<?= CARD_ADDITIONALLY4 ?>" class="card-customs__radio">
                                    <div class="card-customs__content">
                                        <div class="card-customs__image">
                                            <picture>
                                                <source srcset="/app/img/customs/add/04.svg" type="image/webp">
                                                <img src="/app/img/customs/add/04.svg" alt="Image"></picture>
                                        </div>
                                        <p class="card-customs__text"><?= CARD_ADDITIONALLY4 ?></p>
                                        <div class="card-customs__icon"></div>
                                    </div>
                                </label>
                                <label class="card-customs__item">
                                    <input type="radio" name="add" value="<?= CARD_ADDITIONALLY5 ?>" class="card-customs__radio">
                                    <div class="card-customs__content">
                                        <div class="card-customs__image">
                                            <picture>
                                                <source srcset="/app/img/customs/add/04.svg" type="image/webp">
                                                <img src="/app/img/customs/add/04.svg" alt="Image"></picture>
                                        </div>
                                        <p class="card-customs__text"><?= CARD_ADDITIONALLY5 ?></p>
                                        <div class="card-customs__icon"></div>
                                    </div>
                                </label>
                                <label class="card-customs__item">
                                    <input type="radio" name="add" value="<?= CARD_ADDITIONALLY6 ?>" class="card-customs__radio">
                                    <div class="card-customs__content">
                                        <div class="card-customs__image">
                                            <picture>
                                                <source srcset="/app/img/customs/add/05.svg" type="image/webp">
                                                <img src="/app/img/customs/add/05.svg" alt="Image"></picture>
                                        </div>
                                        <p class="card-customs__text"><?= CARD_ADDITIONALLY6 ?></p>
                                        <div class="card-customs__icon"></div>
                                    </div>
                                </label>
                                <label class="card-customs__item">
                                    <input type="radio" name="add" value="<?= CARD_ADDITIONALLY7 ?>" class="card-customs__radio">
                                    <div class="card-customs__content">
                                        <div class="card-customs__image">
                                            <picture>
                                                <source srcset="/app/img/customs/add/06.svg" type="image/webp">
                                                <img src="/app/img/customs/add/06.svg" alt="Image"></picture>
                                        </div>
                                        <p class="card-customs__text"><?= CARD_ADDITIONALLY7 ?></p>
                                        <div class="card-customs__icon"></div>
                                    </div>
                                </label>
                                <label class="card-customs__item">
                                    <input type="radio" name="add" value="<?= CARD_ADDITIONALLY8 ?>" class="card-customs__radio">
                                    <div class="card-customs__content">
                                        <div class="card-customs__image">
                                            <picture>
                                                <source srcset="/app/img/customs/add/07.svg" type="image/webp">
                                                <img src="/app/img/customs/add/07.svg" alt="Image"></picture>
                                        </div>
                                        <p class="card-customs__text"><?= CARD_ADDITIONALLY8 ?></p>
                                        <div class="card-customs__icon"></div>
                                    </div>
                                </label>
                                <label class="card-customs__item">
                                    <input type="radio" name="add" value="<?= CARD_ADDITIONALLY9 ?>" class="card-customs__radio">
                                    <div class="card-customs__content">
                                        <div class="card-customs__image">
                                            <picture>
                                                <source srcset="/app/img/customs/add/08.svg" type="image/webp">
                                                <img src="/app/img/customs/add/08.svg" alt="Image"></picture>
                                        </div>
                                        <p class="card-customs__text"><?= CARD_ADDITIONALLY9 ?></p>
                                        <div class="card-customs__icon"></div>
                                    </div>
                                </label>
                                <label class="card-customs__item">
                                    <input type="radio" name="add" value="<?= CARD_ADDITIONALLY10 ?>" class="card-customs__radio">
                                    <div class="card-customs__content">
                                        <div class="card-customs__image">
                                            <picture>
                                                <source srcset="/app/img/customs/add/09.svg" type="image/webp">
                                                <img src="/app/img/customs/add/09.svg" alt="Image"></picture>
                                        </div>
                                        <p class="card-customs__text"><?= CARD_ADDITIONALLY10 ?></p>
                                        <div class="card-customs__icon"></div>
                                    </div>
                                </label>
                                <label class="card-customs__item">
                                    <input type="radio" name="add" value="<?= CARD_ADDITIONALLY11 ?>" class="card-customs__radio">
                                    <div class="card-customs__content">
                                        <div class="card-customs__image">
                                            <picture>
                                                <source srcset="/app/img/customs/add/10.svg" type="image/webp">
                                                <img src="/app/img/customs/add/10.svg" alt="Image"></picture>
                                        </div>
                                        <p class="card-customs__text"><?= CARD_ADDITIONALLY11 ?></p>
                                        <div class="card-customs__icon"></div>
                                    </div>
                                </label>
                                <label class="card-customs__item">
                                    <input type="radio" name="add" value="<?= CARD_ADDITIONALLY12 ?>" class="card-customs__radio">
                                    <div class="card-customs__content">
                                        <div class="card-customs__image">
                                            <picture>
                                                <source srcset="/app/img/customs/add/11.svg" type="image/webp">
                                                <img src="/app/img/customs/add/11.svg" alt="Image"></picture>
                                        </div>
                                        <p class="card-customs__text"><?= CARD_ADDITIONALLY12 ?></p>
                                        <div class="card-customs__icon"></div>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="customs__next"><?= THE_NEXT_STEP ?></div>
                    </div>
                    <div class="customs__row">
                        <div class="customs__head">
                            <div class="customs__step">5</div>
                            <p class="customs__name"><?= CARD_HOLDERS ?></p>
                        </div>
                        <div class="customs__body">
                            <div class="customs__selected selected-customs">
                                <div class="selected-customs__content">
                                    <label class="selected-customs__item">
                                        <input type="radio" name="card-holder" value="<?= CARD_HOLDERS1 ?>" checked class="selected-customs__input">
                                        <p class="selected-customs__text"><span><?= CARD_HOLDERS1 ?></span></p>
                                    </label>
                                    <label class="selected-customs__item">
                                        <input type="radio" name="card-holder" value="<?= CARD_HOLDERS2 ?>" class="selected-customs__input">
                                        <p class="selected-customs__text"><span><?= CARD_HOLDERS2 ?></span></p>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="customs__next"><?= THE_NEXT_STEP ?></div>
                    </div>
                </div>
            </div>
        </section>
        <section class="custom-order">
            <div class="custom-order__container _container">
                <div class="custom-order__content">
                    <h2 class="custom-order__title"><?= CARD_SUBMIT_APP ?></h2>
                    <div class="custom-order__form">
                        <div class="custom-order__main">
                            <div class="custom-order__info">
                                <div class="custom-order__row">
                                    <label class="custom-order__label"><?= YOUR_NAME ?></label>
                                    <input type="text" name="name" class="custom-order__input" required>
                                </div>
                                <div class="custom-order__row">
                                    <label class="custom-order__label"><?= YOUR_PHONE ?></label>
                                    <input type="tel" name="phone" class="custom-order__input" required>
                                </div>
                                <div class="custom-order__row">
                                    <label class="custom-order__label"><?= THE_EMAIL ?></label>
                                    <input type="email" name="email" class="custom-order__input" required>
                                </div>
                            </div>
                            <div class="custom-order__message">
                                <label class="custom-order__label"><?= YOUR_MESSAGE ?></label>
                                <textarea name="messages" class="custom-order__textarea"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="custom-order__btn">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.91202 11.9998H4.00002L2.02302 4.1348C2.01036 4.0891 2.00265 4.04216 2.00002 3.9948C1.97802 3.2738 2.77202 2.7738 3.46002 3.1038L22 11.9998L3.46002 20.8958C2.78002 21.2228 1.99602 20.7368 2.00002 20.0288C2.00204 19.9655 2.01316 19.9029 2.03302 19.8428L3.50002 14.9998"
                                      stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <?= SUBMIT_AN_INQUIRY ?>
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </form>
</main>
<?php if (!empty($messaje)) { ?>
    <div id="popup_success" class="quiz">
        <div class="popup_bg"></div>
        <div class="popup-block quiz__form-wrapper">
            <a href="/en" class="main-header__logo">mscards<span>.ro</span></a>
            <h1 class="popup-block__title"><?= $messaje ?></h1>
        </div>
    </div>
<?php } ?>