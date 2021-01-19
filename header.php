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

    <?php
    get_open_graph();

    wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<!— Yandex.Metrika counter —>
<script type="text/javascript">
    (function (m, e, t, r, i, k, a) {
        m[i] = m[i] || function () {
            (m[i].a = m[i].a || []).push(arguments)
        };
        m[i].l = 1 * new Date();
        k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
    })
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(71309620, "init", {
        clickmap: true,
        trackLinks: true,
        accurateTrackBounce: true,
        webvisor: true
    });
</script>
<noscript>
    <div><img src="https://mc.yandex.ru/watch/71309620" style="position:absolute; left:-9999px;" alt=""/></div>
</noscript>
<!— /Yandex.Metrika counter —>

<!--begin header-->
<div class="container">
    <header>
        <button id="menu" class="show">
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
        </button>
        <div id="navOverlay" class="nav_overlay"></div>
        <div class="container_content__blockText">
            <p class="header__text">В старину мужиков, которые что-то мастерили из лозы, называли «вязниками». Отсюда и
                название
                города - Вязники.</p></div>
        <img class="header__img" src="<?= get_template_directory_uri() ?>/raw_html/img/header_logo.png" alt="">
        <div class="header__nav">
            <nav id="navigationMenu" class="header__nav-navigation">
                <?php get_header_menu('Menu 1'); ?>
            </nav>

            <div class="header__nav_link">
                <?php echo do_shortcode('[widget id="zoom-social-icons-widget-3"]'); ?>
            </div>

            <div class="header__search">
                <input type="search" class="search-field" id="search-field">
                <button class="search_button">
                    <img src="<?= get_template_directory_uri() ?>/raw_html/img/search.svg" alt="">
                </button>
            </div>
        </div>
    </header>
</div>
<!--end header-->