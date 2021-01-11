<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <title>Вязник</title>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <script src="https://vk.com/js/api/openapi.js?168" type="text/javascript"></script>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>


<!--begin header-->
<div class="container">
    <header>
        <buttton id="menu" class="show">
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
        </buttton>
        <div class="container_content__blockText">
            <p class="header__text">В старину мужиков, которые что-то мастерили из лозы называли «вязниками». Отсюда и
                название
                города - Вязники.</p></div>
        <img class="header__img" src="<?= get_template_directory_uri() ?>/raw_html/img/header_logo.png" alt="">
        <div class="header__nav">
            <nav id="navigationMenu" class="header__nav-navigation">
                <div class="header__nav-navigation">
                    <?php get_header_menu('Menu 1'); ?>
            </nav>
            <div class="header__search"><input type="search">
                <button class="search_button">
                    <img src="<?= get_template_directory_uri() ?>/raw_html/img/search.svg" alt=""></button>
            </div>
        </div>
    </header>
</div>
<!--end header-->