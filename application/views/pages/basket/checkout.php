<div class="wrapper">
    <div class="mini-header">
        <div class="mini-header__container _container-m">
            <div class="mini-header__content">
                <a href="mailto:<?= CONTACTEMAIL ?>" class="mini-header__mail">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 20H4C3.46957 20 2.96086 19.7893 2.58579 19.4142C2.21071 19.0391 2 18.5304 2 18V5.913C2.02243 5.39779 2.24301 4.91116 2.61568 4.5547C2.98835 4.19824 3.4843 3.99951 4 4H20C20.5304 4 21.0391 4.21071 21.4142 4.58579C21.7893 4.96086 22 5.46957 22 6V18C22 18.5304 21.7893 19.0391 21.4142 19.4142C21.0391 19.7893 20.5304 20 20 20ZM4 7.868V18H20V7.868L12 13.2L4 7.868ZM4.8 6L12 10.8L19.2 6H4.8Z"
                              fill="#2779F6"/>
                    </svg>
                    <?= CONTACTEMAIL ?>
                </a>
                <a href="/<?= $lclang ?>" class="mini-header__logo">mscards<span>.ro</span></a>
                <div class="mini-header__language language">
                    <?php select_language($clang, $lang_urls); ?>
                </div>
            </div>
        </div>
    </div>
    <main class="page">
        <section class="order">
            <div class="order__container _container-m">
                <div class="order__head">
                    <a href="javascript:history.back();" class="order__back">
                        <picture>
                            <source srcset="/app/img/icons/back.svg" type="image/webp">
                            <img src="/app/img/icons/back.svg" alt="Back"></picture>
                    </a>
                    <h2 class="order__title"><?= $page_name ?></h2>
                </div>
                <form action="" class="order__form" method="post">
                    <div class="order__row">
                        <div class="order__top">
                            <span class="order__step">1</span>
                            <p class="order__name"><?= CHECKOUT_ENTER_YOUR_DETAILS ?></p>
                        </div>
                        <div class="order__body">
                            <div class="order__data data-order">
                                <div class="data-order__row _requred">
                                    <label class="data-order__label"><?= YOUR_NAME ?></label>
                                    <input autocomplete="off" type="text" name="name"
                                           data-error="<?= REQUIRED_FIELD ?>" data-value=""
                                           class="data-order__input _req">
                                </div>
                                <div class="data-order__row _requred">
                                    <label class="data-order__label"><?= YOUR_PHONE ?></label>
                                    <input autocomplete="off" type="tel" name="phone"
                                           data-error="<?= REQUIRED_FIELD ?>" data-value=""
                                           class="data-order__input _req">
                                </div>
                                <div class="data-order__row _requred">
                                    <label class="data-order__label"><?= THE_EMAIL ?></label>
                                    <input autocomplete="off" type="text" name="email"
                                           data-error="<?= REQUIRED_FIELD ?>" data-value=""
                                           class="data-order__input _req">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="order__row delivery_row">
                        <div class="order__top">
                            <span class="order__step">2</span>
                            <p class="order__name"><?= CHECKOUT_DELIVERY_METHOD ?></p>
                        </div>
                        <div class="order__body">
                            <div class="order__delivery delivery-order _tabs">
                                <div class="delivery-order__head head-delivery-order">
                                    <label class="head-delivery-order__item _tabs-item _requred">
                                        <input type="radio" name="delivery" value="1" required
                                               class="head-delivery-order__radio">
                                        <div class="head-delivery-order__content">
                                            <div class="head-delivery-order__icon">
                                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M18 19C18 18.7348 18.1054 18.4804 18.2929 18.2929C18.4804 18.1054 18.7348 18 19 18H23C23.2652 18 23.5196 18.1054 23.7071 18.2929C23.8946 18.4804 24 18.7348 24 19V23C24 23.2652 23.8946 23.5196 23.7071 23.7071C23.5196 23.8946 23.2652 24 23 24H19C18.7348 24 18.4804 23.8946 18.2929 23.7071C18.1054 23.5196 18 23.2652 18 23V19ZM20 22H22V20H20V22ZM8.376 2.22L3.376 6.22C3.044 6.484 3 6.94 3 7.34V11C3 12.126 3.372 13.164 4 14V29C4 29.2652 4.10536 29.5196 4.29289 29.7071C4.48043 29.8946 4.73478 30 5 30H27C27.2652 30 27.5196 29.8946 27.7071 29.7071C27.8946 29.5196 28 29.2652 28 29V14C28.628 13.164 29 12.126 29 11V7.332C29 6.932 28.956 6.484 28.624 6.22L23.624 2.22C23.447 2.07799 23.2269 2.0004 23 2H9C8.77306 2.0004 8.55301 2.07799 8.376 2.22ZM11 8V11C11 11.7956 10.6839 12.5587 10.1213 13.1213C9.55871 13.6839 8.79565 14 8 14C7.20435 14 6.44129 13.6839 5.87868 13.1213C5.31607 12.5587 5 11.7956 5 11V8H11ZM19 8V11C19 11.7956 18.6839 12.5587 18.1213 13.1213C17.5587 13.6839 16.7956 14 16 14C15.2044 14 14.4413 13.6839 13.8787 13.1213C13.3161 12.5587 13 11.7956 13 11V8H19ZM27 8V11C27 11.7956 26.6839 12.5587 26.1213 13.1213C25.5587 13.6839 24.7956 14 24 14C23.2044 14 22.4413 13.6839 21.8787 13.1213C21.3161 12.5587 21 11.7956 21 11V8H27ZM12.058 4L11.308 6H6.85L9.35 4H12.06H12.058ZM13.444 6L14.194 4H17.78L18.446 6H13.444ZM19.888 4H22.648L25.148 6H20.554L19.888 4ZM26 15.584V28H16V19C16 18.7348 15.8946 18.4804 15.7071 18.2929C15.5196 18.1054 15.2652 18 15 18H9C8.73478 18 8.48043 18.1054 8.29289 18.2929C8.10536 18.4804 8 18.7348 8 19V28H6V15.584C7.03211 16.0358 8.1867 16.1252 9.27603 15.8376C10.3654 15.55 11.3254 14.9024 12 14C12.912 15.214 14.364 16 16 16C17.636 16 19.088 15.214 20 14C20.6746 14.9024 21.6346 15.55 22.724 15.8376C23.8133 16.1252 24.9679 16.0358 26 15.584ZM14 28H10V20H14V28Z"
                                                          fill="#A4A4A4"/>
                                                </svg>
                                            </div>
                                            <div class="head-delivery-order__info">
                                                <p class="head-delivery-order__name"><?= CHECKOUT_PICK_UP_AT_THE_STORE ?></p>
                                                <div class="head-delivery-order__other">
                                                    <p class="head-delivery-order__address"><?= CHECKOUT_PICK_UP_AT_THE_STORE_ADDRESS ?></p>
                                                    <a href="/<?= $lclang ?>/<?= $menu['all'][6]->uri ?>" target="_blank"
                                                       class="head-delivery-order__map"><?= CHECKOUT_SEE_ON_THE_MAP ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                    <label class="head-delivery-order__item _tabs-item _requred" >
                                        <input type="radio" name="delivery" value="2" required
                                               class="head-delivery-order__radio">
                                        <div class="head-delivery-order__content">
                                            <div class="head-delivery-order__icon">
                                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12.0744 6H8.18995V2H6.24773V6H2.36328V8H6.24773V12H8.18995V8H12.0744V6Z"
                                                          fill="#A4A4A4"/>
                                                    <path d="M29.4757 16.606L26.5624 9.606C26.4876 9.42608 26.3632 9.27273 26.2045 9.165C26.0459 9.05727 25.86 8.99989 25.6699 9H22.7566V7C22.7566 6.73478 22.6543 6.48043 22.4722 6.29289C22.2901 6.10536 22.0431 6 21.7855 6H14.9877V8H20.8144V20.556C20.3719 20.8206 19.9846 21.1728 19.6749 21.5922C19.3653 22.0117 19.1393 22.4902 19.0101 23H12.9076C12.6964 22.1418 12.2132 21.3806 11.5347 20.8368C10.8561 20.2931 10.0209 19.9979 9.16106 19.9979C8.30126 19.9979 7.46601 20.2931 6.78745 20.8368C6.10889 21.3806 5.62576 22.1418 5.41451 23H4.3055V14H2.36328V24C2.36328 24.2652 2.46559 24.5196 2.64771 24.7071C2.82983 24.8946 3.07684 25 3.33439 25H5.41451C5.62576 25.8582 6.10889 26.6194 6.78745 27.1632C7.46601 27.7069 8.30126 28.0021 9.16106 28.0021C10.0209 28.0021 10.8561 27.7069 11.5347 27.1632C12.2132 26.6194 12.6964 25.8582 12.9076 25H19.0101C19.2213 25.8582 19.7044 26.6194 20.383 27.1632C21.0616 27.7069 21.8968 28.0021 22.7566 28.0021C23.6164 28.0021 24.4517 27.7069 25.1302 27.1632C25.8088 26.6194 26.2919 25.8582 26.5032 25H28.5833C28.8408 25 29.0878 24.8946 29.27 24.7071C29.4521 24.5196 29.5544 24.2652 29.5544 24V17C29.5544 16.8645 29.5277 16.7305 29.4757 16.606ZM9.16106 26C8.77692 26 8.40142 25.8827 8.08202 25.6629C7.76262 25.4432 7.51368 25.1308 7.36668 24.7654C7.21968 24.3999 7.18121 23.9978 7.25616 23.6098C7.3311 23.2219 7.51608 22.8655 7.7877 22.5858C8.05933 22.3061 8.4054 22.1156 8.78215 22.0384C9.1589 21.9613 9.54942 22.0009 9.90431 22.1522C10.2592 22.3036 10.5625 22.56 10.776 22.8889C10.9894 23.2178 11.1033 23.6044 11.1033 24C11.1025 24.5302 10.8976 25.0384 10.5336 25.4133C10.1695 25.7882 9.67593 25.9992 9.16106 26ZM22.7566 11H25.029L27.1111 16H22.7566V11ZM22.7566 26C22.3725 26 21.997 25.8827 21.6776 25.6629C21.3582 25.4432 21.1092 25.1308 20.9622 24.7654C20.8152 24.3999 20.7768 23.9978 20.8517 23.6098C20.9267 23.2219 21.1116 22.8655 21.3833 22.5858C21.6549 22.3061 22.001 22.1156 22.3777 22.0384C22.7545 21.9613 23.145 22.0009 23.4999 22.1522C23.8548 22.3036 24.1581 22.56 24.3715 22.8889C24.5849 23.2178 24.6988 23.6044 24.6988 24C24.6983 24.5303 24.4935 25.0387 24.1294 25.4136C23.7653 25.7886 23.2716 25.9995 22.7566 26ZM27.6122 23H26.5032C26.2892 22.1434 25.8054 21.3842 25.1273 20.8413C24.4493 20.2983 23.6155 20.0025 22.7566 20V18H27.6122V23Z"
                                                          fill="#A4A4A4"/>
                                                </svg>
                                            </div>
                                            <div class="head-delivery-order__info">
                                                <p class="head-delivery-order__name"><?= CHECKOUT_DELIVERY ?></p>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="delivery-order__body body-delivery-order">
                                    <div class="body-delivery-order__column _tabs-block"></div>
                                    <div class="body-delivery-order__column _tabs-block">
                                        <p class="body-delivery-order__title"><?= CHECKOUT_ADDRESS ?></p>
                                        <div class="body-delivery-order__content">
                                            <div class="body-delivery-order__row">
                                                <input type="text" name="address" class="body-delivery-order__input">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="order__row invoice_list" >
                        <div class="order__top">
                            <span class="order__step">3</span>
                            <p class="order__name"><?= CHECKOUT_INVOICE_DATA ?></p>
                        </div>
                        <div class="order__body">
                            <div class="order__invoice invoice-order">
                                <p class="invoice-order__text"><?= CHECKOUT_INVOICE_DATA_ADDRESS ?></p>
                                <a href="#invoice" class="invoice-order__button _popup-link">
                                    <?= CHECKOUT_INVOICE_DATA_ADD ?>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M6.5 12.0009C6.5 11.802 6.57902 11.6113 6.71967 11.4706C6.86032 11.33 7.05109 11.2509 7.25 11.2509H15.9395L12.719 8.03195C12.5782 7.89112 12.4991 7.70011 12.4991 7.50095C12.4991 7.30178 12.5782 7.11078 12.719 6.96995C12.8598 6.82912 13.0508 6.75 13.25 6.75C13.4492 6.75 13.6402 6.82912 13.781 6.96995L18.281 11.4699C18.3508 11.5396 18.4063 11.6224 18.4441 11.7135C18.4819 11.8046 18.5013 11.9023 18.5013 12.0009C18.5013 12.0996 18.4819 12.1973 18.4441 12.2884C18.4063 12.3795 18.3508 12.4623 18.281 12.5319L13.781 17.0319C13.6402 17.1728 13.4492 17.2519 13.25 17.2519C13.0508 17.2519 12.8598 17.1728 12.719 17.0319C12.5782 16.8911 12.4991 16.7001 12.4991 16.5009C12.4991 16.3018 12.5782 16.1108 12.719 15.9699L15.9395 12.7509H7.25C7.05109 12.7509 6.86032 12.6719 6.71967 12.5313C6.57902 12.3906 6.5 12.1999 6.5 12.0009Z"
                                              fill="#2779F6"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="order__row">
                        <div class="order__top">
                            <span class="order__step">4</span>
                            <p class="order__name"><?= CHECKOUT_PAYMENT_METHOD ?></p>
                        </div>
                        <div class="order__body">
                            <div class="order__pay pay-order">
                                <div class="pay-order__body">
                                    <label class="pay-order__item">
                                        <input type="radio" name="pay" value="1" checked class="pay-order__radio">
                                        <div class="pay-order__content">
                                            <div class="pay-order__icon">
                                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M16 20C17.0609 20 18.0783 19.5786 18.8284 18.8284C19.5786 18.0783 20 17.0609 20 16C20 14.9391 19.5786 13.9217 18.8284 13.1716C18.0783 12.4214 17.0609 12 16 12C14.9391 12 13.9217 12.4214 13.1716 13.1716C12.4214 13.9217 12 14.9391 12 16C12 17.0609 12.4214 18.0783 13.1716 18.8284C13.9217 19.5786 14.9391 20 16 20Z"
                                                          fill="#A4A4A4"/>
                                                    <path d="M0 8C0 7.46957 0.210714 6.96086 0.585786 6.58579C0.960859 6.21071 1.46957 6 2 6H30C30.5304 6 31.0391 6.21071 31.4142 6.58579C31.7893 6.96086 32 7.46957 32 8V24C32 24.5304 31.7893 25.0391 31.4142 25.4142C31.0391 25.7893 30.5304 26 30 26H2C1.46957 26 0.960859 25.7893 0.585786 25.4142C0.210714 25.0391 0 24.5304 0 24V8ZM6 8C6 9.06087 5.57857 10.0783 4.82843 10.8284C4.07828 11.5786 3.06087 12 2 12V20C3.06087 20 4.07828 20.4214 4.82843 21.1716C5.57857 21.9217 6 22.9391 6 24H26C26 22.9391 26.4214 21.9217 27.1716 21.1716C27.9217 20.4214 28.9391 20 30 20V12C28.9391 12 27.9217 11.5786 27.1716 10.8284C26.4214 10.0783 26 9.06087 26 8H6Z"
                                                          fill="#A4A4A4"/>
                                                </svg>
                                            </div>
                                            <p class="pay-order__name"><?= CHECKOUT_PAYMENT_CASH ?></p>
                                        </div>
                                    </label>
                                    <label class="pay-order__item">
                                        <input type="radio" name="pay" value="2" class="pay-order__radio">
                                        <div class="pay-order__content">
                                            <div class="pay-order__icon">
                                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M0 8C0 6.93913 0.421427 5.92172 1.17157 5.17157C1.92172 4.42143 2.93913 4 4 4H28C29.0609 4 30.0783 4.42143 30.8284 5.17157C31.5786 5.92172 32 6.93913 32 8V24C32 25.0609 31.5786 26.0783 30.8284 26.8284C30.0783 27.5786 29.0609 28 28 28H4C2.93913 28 1.92172 27.5786 1.17157 26.8284C0.421427 26.0783 0 25.0609 0 24V8ZM4 6C3.46957 6 2.96086 6.21071 2.58579 6.58579C2.21071 6.96086 2 7.46957 2 8V10H30V8C30 7.46957 29.7893 6.96086 29.4142 6.58579C29.0391 6.21071 28.5304 6 28 6H4ZM30 14H2V24C2 24.5304 2.21071 25.0391 2.58579 25.4142C2.96086 25.7893 3.46957 26 4 26H28C28.5304 26 29.0391 25.7893 29.4142 25.4142C29.7893 25.0391 30 24.5304 30 24V14Z"
                                                          fill="#A4A4A4"/>
                                                    <path d="M4 20C4 19.4696 4.21071 18.9609 4.58579 18.5858C4.96086 18.2107 5.46957 18 6 18H8C8.53043 18 9.03914 18.2107 9.41421 18.5858C9.78929 18.9609 10 19.4696 10 20V22C10 22.5304 9.78929 23.0391 9.41421 23.4142C9.03914 23.7893 8.53043 24 8 24H6C5.46957 24 4.96086 23.7893 4.58579 23.4142C4.21071 23.0391 4 22.5304 4 22V20Z"
                                                          fill="#A4A4A4"/>
                                                </svg>
                                            </div>
                                            <p class="pay-order__name"><?= CHECKOUT_PAYMENT_CARD ?></p>
                                        </div>
                                    </label>
                                    <label class="pay-order__item">
                                        <input type="radio" name="pay" value="3" class="pay-order__radio">
                                        <div class="pay-order__content">
                                            <div class="pay-order__icon">
                                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M27.5518 14.4379C28.4895 14.4379 28.881 13.1973 28.1193 12.6254L16.5297 3.94414C16.3642 3.81927 16.1643 3.75195 15.9592 3.75195C15.754 3.75195 15.5541 3.81927 15.3886 3.94414L3.79903 12.6254C3.03731 13.1941 3.42879 14.4379 4.36955 14.4379H6.24805V26.1254H4.06305C3.92952 26.1254 3.82027 26.2379 3.82027 26.3754V28.0004C3.82027 28.1379 3.92952 28.2504 4.06305 28.2504H27.8553C27.9888 28.2504 28.098 28.1379 28.098 28.0004V26.3754C28.098 26.2379 27.9888 26.1254 27.8553 26.1254H25.6703V14.4379H27.5518ZM11.9837 26.1254H8.43305V14.4379H11.9837V26.1254ZM17.7193 26.1254H14.1687V14.4379H17.7193V26.1254ZM23.4853 26.1254H19.9043V14.4379H23.4853V26.1254Z"
                                                          fill="#A4A4A4"/>
                                                </svg>
                                            </div>
                                            <p class="pay-order__name"><?= CHECKOUT_PAYMENT_CREDIT ?></p>
                                        </div>
                                    </label>
                                    <label class="pay-order__item">
                                        <input type="radio" name="pay" value="4" class="pay-order__radio">
                                        <div class="pay-order__content">
                                            <div class="pay-order__icon">
                                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M25.3789 9.3L18.5812 2.3C18.3869 2.1 18.1927 2 17.9014 2H8.19027C7.12205 2 6.24805 2.9 6.24805 4V28C6.24805 29.1 7.12205 30 8.19027 30H23.728C24.7963 30 25.6703 29.1 25.6703 28V10C25.6703 9.7 25.5732 9.5 25.3789 9.3ZM17.9014 4.4L23.3396 10H17.9014V4.4ZM23.728 28H8.19027V4H15.9592V10C15.9592 11.1 16.8332 12 17.9014 12H23.728V28Z"
                                                          fill="#A4A4A4"/>
                                                    <path d="M10.1329 22H21.7863V24H10.1329V22ZM10.1329 16H21.7863V18H10.1329V16Z"
                                                          fill="#A4A4A4"/>
                                                </svg>
                                            </div>
                                            <p class="pay-order__name"><?= CHECKOUT_PAYMENT_ENUMERAT ?></p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="order__row">
                        <div class="order__top">
                            <span class="order__step">5</span>
                            <p class="order__name"><?= CHECKOUT_PAYMENT_COMMENT ?></p>
                        </div>
                        <div class="order__body">
                            <div class="order__comment comment-order">
                                <div class="comment-order__content">
                                    <label class="comment-order__label"><?= CHECKOUT_PAYMENT_COMMENT ?></label>
                                    <textarea name="comment" class="comment-order__textarea"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="order__row">
                        <div class="order__top">
                            <span class="order__step">6</span>
                            <p class="order__name"><?= CHECKOUT_CONFIRMATION ?></p>
                        </div>
                        <div class="order__body">
                            <div class="order__info info-order">
                                <ul class="info-order__list">
                                    <li class="info-order__item">
                                        <p class="info-order__name"><?= ORDER_PRODUCTS ?></p>
                                        <div class="info-order__content">
                                            <p class="info-order__value">
                                                <span><?= $total_price_cart ?></span> <?= EUR_SYMBOL ?></p>
                                        </div>
                                    </li>
                                    <?php if (!empty($price_delivery)) { ?>
                                        <li class="info-order__item delivery">
                                            <p class="info-order__name"><?= ORDER_DELIVERY ?></p>
                                            <div class="info-order__content">
                                                <p class="info-order__value">
                                                    <span><?= SHIPPING_PRICE ?></span> <?= EUR_SYMBOL ?></p>
                                            </div>
                                        </li>
                                    <?php } ?>
                                    <?php if (!empty($option_price_off)) { ?>
                                        <li class="info-order__item">
                                            <p class="info-order__name"><?= ORDER_ADDITIONAL_SERVICES ?></p>
                                            <div class="info-order__content">
                                                <p class="info-order__value">
                                                    <span><?= $option_price ?></span> <?= EUR_SYMBOL ?></p>
                                            </div>
                                        </li>
                                    <?php } ?>
                                </ul>
                                <div class="info-order__total">
                                    <p class="info-order__total_name"><?= ORDER_TO_PAY ?></p>
                                    <div class="info-order__total_content"
                                         data-total="<?= number_format($total_price_cart + ((($total_price_cart) * (float)TVA_RATE) / 100), 2, '.', ''); ?>"
                                         data-total-delivery="<?= number_format($total_price_cart + $price_delivery + ((($total_price_cart + $price_delivery) * (float)TVA_RATE) / 100), 2, '.', ''); ?>"
                                    >
                                        <p class="info-order__total_value">
                                            <span><?= number_format($total_price_cart + $price_delivery + ((($total_price_cart + $price_delivery) * (float)TVA_RATE) / 100), 2, '.', ''); ?></span> <?= EUR_SYMBOL ?>
                                        </p>
                                        <span>(<?= ORDER_VAT ?> <span class="tva"
                                                                      data-tva="<?= number_format((($total_price_cart) * (float)TVA_RATE) / 100, 2, '.', '') ?>"
                                                                      data-tva-delivery="<?= number_format((($total_price_cart + $price_delivery) * (float)TVA_RATE) / 100, 2, '.', '') ?>"
                                            ><?= number_format((($total_price_cart + $price_delivery) * (float)TVA_RATE) / 100, 2, '.', '') ?></span> <?= EUR_SYMBOL ?>)</span>
                                    </div>
                                </div>
                                <button type="submit" class="info-order__button"><?= CHECKOUT_SEND ?></button>
                            </div>
                        </div>
                    </div>

                    <div class="popup popup_invoice invoice-popup">
                        <div class="popup__content">
                            <div class="popup__body">
                                <div class="popup__close"></div>
                                <h2 class="invoice-popup__title"><?=ADD_PAYMENT_DETAILS?></h2>
                                <form action="#" class="invoice-popup__form">
                                    <div class="invoice-popup__head head-invoice-popup">
                                        <label class="head-invoice-popup__item">
                                            <input type="radio" name="invoice[person]" value="1" class="head-invoice-popup__radio">
                                            <div class="head-invoice-popup__content">
                                                <div class="head-invoice-popup__icon">
                                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M18 19C18 18.7348 18.1054 18.4804 18.2929 18.2929C18.4804 18.1054 18.7348 18 19 18H23C23.2652 18 23.5196 18.1054 23.7071 18.2929C23.8946 18.4804 24 18.7348 24 19V23C24 23.2652 23.8946 23.5196 23.7071 23.7071C23.5196 23.8946 23.2652 24 23 24H19C18.7348 24 18.4804 23.8946 18.2929 23.7071C18.1054 23.5196 18 23.2652 18 23V19ZM20 22H22V20H20V22ZM8.376 2.22L3.376 6.22C3.044 6.484 3 6.94 3 7.34V11C3 12.126 3.372 13.164 4 14V29C4 29.2652 4.10536 29.5196 4.29289 29.7071C4.48043 29.8946 4.73478 30 5 30H27C27.2652 30 27.5196 29.8946 27.7071 29.7071C27.8946 29.5196 28 29.2652 28 29V14C28.628 13.164 29 12.126 29 11V7.332C29 6.932 28.956 6.484 28.624 6.22L23.624 2.22C23.447 2.07799 23.2269 2.0004 23 2H9C8.77306 2.0004 8.55301 2.07799 8.376 2.22ZM11 8V11C11 11.7956 10.6839 12.5587 10.1213 13.1213C9.55871 13.6839 8.79565 14 8 14C7.20435 14 6.44129 13.6839 5.87868 13.1213C5.31607 12.5587 5 11.7956 5 11V8H11ZM19 8V11C19 11.7956 18.6839 12.5587 18.1213 13.1213C17.5587 13.6839 16.7956 14 16 14C15.2044 14 14.4413 13.6839 13.8787 13.1213C13.3161 12.5587 13 11.7956 13 11V8H19ZM27 8V11C27 11.7956 26.6839 12.5587 26.1213 13.1213C25.5587 13.6839 24.7956 14 24 14C23.2044 14 22.4413 13.6839 21.8787 13.1213C21.3161 12.5587 21 11.7956 21 11V8H27ZM12.058 4L11.308 6H6.85L9.35 4H12.06H12.058ZM13.444 6L14.194 4H17.78L18.446 6H13.444ZM19.888 4H22.648L25.148 6H20.554L19.888 4ZM26 15.584V28H16V19C16 18.7348 15.8946 18.4804 15.7071 18.2929C15.5196 18.1054 15.2652 18 15 18H9C8.73478 18 8.48043 18.1054 8.29289 18.2929C8.10536 18.4804 8 18.7348 8 19V28H6V15.584C7.03211 16.0358 8.1867 16.1252 9.27603 15.8376C10.3654 15.55 11.3254 14.9024 12 14C12.912 15.214 14.364 16 16 16C17.636 16 19.088 15.214 20 14C20.6746 14.9024 21.6346 15.55 22.724 15.8376C23.8133 16.1252 24.9679 16.0358 26 15.584ZM14 28H10V20H14V28Z"
                                                              fill="#A4A4A4"/>
                                                    </svg>
                                                </div>
                                                <p class="head-invoice-popup__name"><?=INDEVIDUAL?></p>
                                            </div>
                                        </label>
                                        <label class="head-invoice-popup__item">
                                            <input type="radio" name="invoice[person]" value="2" class="head-invoice-popup__radio">
                                            <div class="head-invoice-popup__content">
                                                <div class="head-invoice-popup__icon">
                                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12.0744 6H8.18995V2H6.24773V6H2.36328V8H6.24773V12H8.18995V8H12.0744V6Z"
                                                              fill="#A4A4A4"/>
                                                        <path d="M29.4757 16.606L26.5624 9.606C26.4876 9.42608 26.3632 9.27273 26.2045 9.165C26.0459 9.05727 25.86 8.99989 25.6699 9H22.7566V7C22.7566 6.73478 22.6543 6.48043 22.4722 6.29289C22.2901 6.10536 22.0431 6 21.7855 6H14.9877V8H20.8144V20.556C20.3719 20.8206 19.9846 21.1728 19.6749 21.5922C19.3653 22.0117 19.1393 22.4902 19.0101 23H12.9076C12.6964 22.1418 12.2132 21.3806 11.5347 20.8368C10.8561 20.2931 10.0209 19.9979 9.16106 19.9979C8.30126 19.9979 7.46601 20.2931 6.78745 20.8368C6.10889 21.3806 5.62576 22.1418 5.41451 23H4.3055V14H2.36328V24C2.36328 24.2652 2.46559 24.5196 2.64771 24.7071C2.82983 24.8946 3.07684 25 3.33439 25H5.41451C5.62576 25.8582 6.10889 26.6194 6.78745 27.1632C7.46601 27.7069 8.30126 28.0021 9.16106 28.0021C10.0209 28.0021 10.8561 27.7069 11.5347 27.1632C12.2132 26.6194 12.6964 25.8582 12.9076 25H19.0101C19.2213 25.8582 19.7044 26.6194 20.383 27.1632C21.0616 27.7069 21.8968 28.0021 22.7566 28.0021C23.6164 28.0021 24.4517 27.7069 25.1302 27.1632C25.8088 26.6194 26.2919 25.8582 26.5032 25H28.5833C28.8408 25 29.0878 24.8946 29.27 24.7071C29.4521 24.5196 29.5544 24.2652 29.5544 24V17C29.5544 16.8645 29.5277 16.7305 29.4757 16.606ZM9.16106 26C8.77692 26 8.40142 25.8827 8.08202 25.6629C7.76262 25.4432 7.51368 25.1308 7.36668 24.7654C7.21968 24.3999 7.18121 23.9978 7.25616 23.6098C7.3311 23.2219 7.51608 22.8655 7.7877 22.5858C8.05933 22.3061 8.4054 22.1156 8.78215 22.0384C9.1589 21.9613 9.54942 22.0009 9.90431 22.1522C10.2592 22.3036 10.5625 22.56 10.776 22.8889C10.9894 23.2178 11.1033 23.6044 11.1033 24C11.1025 24.5302 10.8976 25.0384 10.5336 25.4133C10.1695 25.7882 9.67593 25.9992 9.16106 26ZM22.7566 11H25.029L27.1111 16H22.7566V11ZM22.7566 26C22.3725 26 21.997 25.8827 21.6776 25.6629C21.3582 25.4432 21.1092 25.1308 20.9622 24.7654C20.8152 24.3999 20.7768 23.9978 20.8517 23.6098C20.9267 23.2219 21.1116 22.8655 21.3833 22.5858C21.6549 22.3061 22.001 22.1156 22.3777 22.0384C22.7545 21.9613 23.145 22.0009 23.4999 22.1522C23.8548 22.3036 24.1581 22.56 24.3715 22.8889C24.5849 23.2178 24.6988 23.6044 24.6988 24C24.6983 24.5303 24.4935 25.0387 24.1294 25.4136C23.7653 25.7886 23.2716 25.9995 22.7566 26ZM27.6122 23H26.5032C26.2892 22.1434 25.8054 21.3842 25.1273 20.8413C24.4493 20.2983 23.6155 20.0025 22.7566 20V18H27.6122V23Z"
                                                              fill="#A4A4A4"/>
                                                    </svg>
                                                </div>
                                                <p class="head-invoice-popup__name"><?=ENTITY?></p>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="invoice-popup__body body-invoice-popup">
                                        <div class="body-invoice-popup__row">
                                            <label class="body-invoice-popup__label"><?=YOUR_NAME?></label>
                                            <input type="text" name="invoice[name]" class="body-invoice-popup__input">
                                        </div>
                                        <div class="body-invoice-popup__row">
                                            <label class="body-invoice-popup__label"><?=YOUR_SURNAME?></label>
                                            <input type="text" name="invoice[surname]" class="body-invoice-popup__input">
                                        </div>
                                        <div class="body-invoice-popup__row">
                                            <label class="body-invoice-popup__label"><?=YOUR_PHONE?></label>
                                            <input type="tel" name="invoice[phone]" class="body-invoice-popup__input">
                                        </div>
                                        <div class="body-invoice-popup__row">
                                            <label class="body-invoice-popup__label"><?=THE_EMAIL?></label>
                                            <input type="email" name="invoice[email]" class="body-invoice-popup__input">
                                        </div>
                                        <div class="body-invoice-popup__row">
                                            <label class="body-invoice-popup__label"><?=THE_ADDRESS?></label>
                                            <input type="text" name="invoice[address]" class="body-invoice-popup__input">
                                        </div>
                                    </div>
                                    <div class="invoice-popup__footer footer-invoice-popup">
                                        <a href="#" class="footer-invoice-popup__save _popup-close"><?=SAVE?></a>
                                        <a href="#" class="footer-invoice-popup__cancel _popup-close"><?=CANCEL?></a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <div class="mini-footer">
        <div class="mini-footer__container _container-m">
            <div class="mini-footer__content">
                <div class="mini-footer__left">
                    <p class="mini-footer__logo">mscards<span>.ro</span></p>
                    <p class="mini-footer__copy"><?= RIGHTS_RESERVED ?></p>
                </div>
                <div class="mini-footer__right">
                    <div class="mini-footer__contacts">
                        <a href="mailto:<?= CONTACTEMAIL ?>" class="mini-footer__contact">
                            <div class="mini-footer__icon">
                                <picture>
                                    <source srcset="/app/img/icons/mail-icon.svg" type="image/webp">
                                    <img src="/app/img/icons/mail-icon.svg" alt="Mail"></picture>
                            </div>
                            <span><?= CONTACTEMAIL ?></span>
                        </a>
                        <a href="tel:<?= CONTACTPHONE ?>" class="mini-footer__contact">
                            <div class="mini-footer__icon">
                                <picture>
                                    <source srcset="/app/img/icons/phone-icon.svg" type="image/webp">
                                    <img src="/app/img/icons/phone-icon.svg" alt="Phone"></picture>
                            </div>
                            <span><?= CONTACTPHONE ?></span>
                        </a>
                    </div>
                    <a href="<?= $ilab_linc ?>" class="mini-footer__dev">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_443_5273)">
                                <path d="M5.09785 5.65154C4.61323 5.62846 4.12908 5.74385 3.64446 6.02031C3.13677 6.27415 2.65262 6.73523 2.19154 7.40446C1.3377 8.97323 0.899695 10.7266 0.922772 12.6411C0.899695 14.4171 1.26893 16.0325 1.98385 17.4854C2.51462 18.57 3.22954 19.5849 4.1757 20.5306C6.36708 22.722 8.99693 23.8066 12.0878 23.8066C15.1557 23.8066 17.7625 22.722 19.9538 20.5306C20.8995 19.5849 21.6375 18.57 22.1683 17.4854C22.7217 16.3551 23.0678 15.1325 23.1832 13.8175C23.2063 13.4252 23.2294 13.0334 23.2525 12.6411C23.2294 12.2488 23.2063 11.8569 23.1832 11.4646C22.9294 8.88092 21.8683 6.64338 19.9538 4.752C18.3163 3.09092 16.4014 2.076 14.2331 1.68415C14.1408 1.29185 13.9562 0.969231 13.6562 0.669231C13.4023 0.415385 13.1258 0.230769 12.8028 0.115385C12.5951 0.0461538 12.3643 0 12.1105 0C11.8566 0 11.6028 0.0461538 11.3955 0.115385C11.0955 0.230769 10.8186 0.415385 10.5652 0.669231C10.1268 1.08462 9.91954 1.59185 9.91954 2.19185C9.91954 2.79138 10.1272 3.32215 10.5652 3.76015C10.9802 4.17554 11.4878 4.38323 12.1109 4.38323C12.7105 4.38323 13.2182 4.17554 13.6566 3.76015C13.9335 3.46015 14.1182 3.16062 14.2105 2.81446C16.0788 3.20677 17.7168 4.10631 19.1471 5.53662C21.1077 7.49723 22.0995 9.87323 22.0995 12.6415C22.0995 14.4185 21.6846 16.0329 20.8769 17.4858C20.4154 18.2935 19.8389 19.0311 19.1471 19.7234C17.186 21.684 14.8331 22.6532 12.0883 22.6532C9.32 22.6532 6.944 21.684 4.98339 19.7234C4.29108 19.0311 3.71462 18.2935 3.27616 17.4858C2.46893 16.0329 2.05354 14.4185 2.05354 12.6415C2.05354 10.6809 2.53816 8.95061 3.48385 7.40538C3.89877 6.94385 4.36031 6.75969 4.89108 6.82846C5.39877 6.89769 5.88293 7.17461 6.36754 7.68185L7.8897 9.20446C7.86662 9.20446 7.84354 9.22754 7.84354 9.25061C7.03585 10.2194 6.62093 11.3497 6.644 12.6646C6.62093 14.1637 7.1517 15.432 8.23585 16.5166C8.62816 16.9089 9.06616 17.2315 9.52769 17.4858C10.2888 17.9238 11.1652 18.1311 12.1114 18.1311C13.0575 18.1311 13.9105 17.9238 14.6951 17.4858C15.1335 17.2315 15.5715 16.9089 15.9639 16.5166C17.048 15.432 17.5788 14.1637 17.5788 12.6646C17.5788 11.1646 17.0485 9.87323 15.9639 8.81215C14.8797 7.728 13.6109 7.19723 12.1114 7.19723C10.7965 7.19723 9.64308 7.61215 8.67431 8.41985C7.98246 7.70492 7.33677 7.08185 6.73677 6.528C6.11323 5.95154 5.58246 5.67461 5.09785 5.65154ZM7.68154 12.6642C7.68154 11.4415 8.12 10.4031 8.97339 9.54969C9.82723 8.67323 10.8878 8.23477 12.1105 8.23477C13.3331 8.23477 14.3711 8.67323 15.2475 9.54969C16.1009 10.4031 16.5394 11.4415 16.5394 12.6642C16.5394 13.8863 16.1009 14.9238 15.2475 15.8012C14.3711 16.6551 13.3331 17.0931 12.1105 17.0931C10.8878 17.0931 9.82677 16.6551 8.97339 15.8012C8.12 14.9243 7.68154 13.8868 7.68154 12.6642Z"
                                      fill="#434854"/>
                                <path d="M10.5655 11.1414C10.127 11.5563 9.9198 12.064 9.9198 12.664C9.9198 13.2636 10.1275 13.7943 10.5655 14.2323C10.9809 14.6468 11.4881 14.8554 12.1112 14.8554C12.7112 14.8554 13.2184 14.6473 13.6569 14.2323C14.0953 13.7943 14.3026 13.2631 14.3026 12.664C14.3026 12.0636 14.0949 11.5563 13.6569 11.1414C13.2184 10.703 12.7112 10.4727 12.1112 10.4727C11.4881 10.4727 10.9809 10.703 10.5655 11.1414Z"
                                      fill="#434854"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_443_5273">
                                    <rect width="24" height="24" fill="#434854"/>
                                </clipPath>
                            </defs>
                        </svg>
                        <?= $ilab ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>