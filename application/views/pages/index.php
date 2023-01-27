<!DOCTYPE html>
<html lang="<?= $lclang ?>">

<head>
    <title><?= $page_title ?></title>
    <meta content="<?= $description_for_layout ?>" name="description">
    <meta content="<?= $keywords_for_layout ?>" name="keywords">
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="<?= $otitle ?>"/>
    <meta property="og:description" content="<?= $description_for_layout ?>"/>
    <meta property="og:image" content="<?= $og_img ?>"/>
    <meta property="og:image:secure_url" content="<?= $site_url . $og_img ?>"/>
    <meta property="og:image:type" content="image/jpeg"/>
    <meta property="og:image:width" content="<?= $og_img_width ?>"/>
    <meta property="og:image:height" content="<?= $og_img_height ?>"/>
    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="/app/img/cart/01.png" type="image/x-icon">
    <link rel="stylesheet" href="/app/css/style.css?v=<?= time() ?>">
    <link rel="stylesheet" href="/app/css/media.css?v=<?= time() ?>">
    <script src="/app/js/jquery-3.3.1.min.js"></script>

</head>

<body>

<div class="preloader"></div>
<div class="wrapper">
    <?php if (!empty($page) && ($page->id == 12 || $page->id == 14)  ){
        $this->load->view($inner_view);
    } else {
        $this->load->view('/layouts/pages/header');
        $this->load->view($inner_view);
        $this->load->view('/layouts/pages/footer');
    }?>
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<script src="/app/js/vendors.min.js"></script>
<script src="/app/js/app.js?v=<?= time() ?>"></script>
<script src="/app/js/main.js?v=<?= time() ?>"></script>
</body>

</html>
