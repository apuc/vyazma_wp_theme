<?php
/*
 * sp functions and definitions
 */


if (!function_exists('sp_setup')) :

    function sp_setup()
    {

        load_theme_textdomain('sp-theme', get_template_directory() . '/languages');

        add_theme_support('automatic-feed-links');
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');


        register_nav_menus(array(
            'menu-1' => esc_html__('Primary', 'sp-theme'),
        ));

        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));


        add_theme_support('custom-background', apply_filters('sp_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        add_theme_support('customize-selective-refresh-widgets');

        add_theme_support('custom-logo', array(
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        ));
    }
endif;

add_action('after_setup_theme', 'sp_setup');


add_action('init', 'register_news_post_type');
add_filter('post_type_link', 'news_permalink', 1, 2);
add_filter('post_updated_messages', 'news_updated_messages');
add_action('contextual_help', 'add_help_text', 10, 3);
//add_action('wp_enqueue_scripts', 'wp_vyaznik_styles');
//add_action('wp_enqueue_scripts', 'wp_vyaznik_js');

// ПРОСМОТРЫ

function getPostViews($postID)
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}

function setPostViews($postID)
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}


add_filter('manage_posts_columns', 'posts_column_views');
add_action('manage_posts_custom_column', 'posts_custom_column_views', 5, 2);
function posts_column_views($defaults)
{
    $defaults['post_views'] = __('Просмотры');
    return $defaults;
}

function posts_custom_column_views($column_name, $id)
{
    if ($column_name === 'post_views') {
        echo getPostViews(get_the_ID());
    }
}


// Регистрируем свои колонки (столбцы). Обязательно.
add_filter('manage_news_posts_columns', function ($columns) {
    $columns_in_head = [
        'id' => 'ID',
        'image' => 'Миниатюра',
    ];

    $columns_in_tale = [
        'is_main' => 'Главная'
    ];

    return array_slice($columns, 0, 1) + $columns_in_head + $columns + $columns_in_tale;
});

function set_main_id()
{
    var_dump($_POST);
    $id = $_POST['id'];
    update_option('main_post_id', $id);
    die();
}

add_action('wp_ajax_setmainid', 'set_main_id');
add_action('wp_ajax_nopriv_setmainid', 'set_main_id');


add_action('manage_news_posts_custom_column', function ($column_name, $post_ID) {
    if ($column_name === 'id') {
        the_ID();
    }

    if ($column_name === 'image' && has_post_thumbnail()) {
        ?>
        <a href="<?php echo get_edit_post_link(); ?>">
            <?php the_post_thumbnail('thumbnail'); ?>
        </a>
        <?php
    }

    if ($column_name === 'is_main') {
        ?>
        <button
                class="btn-setmainid"
                data-main-id="<?php the_ID() ?>"
        >
            Назначить
        </button>
        <?php
    }
}, 10, 2);

// Выводим стили для своих столбцов. Необязательно.
add_action('admin_print_footer_scripts-edit.php', function () { //TODO
    ?>

    <script type="text/javascript" src="http://vyaznik.ru/js/jquery/jquery.min.js?ver=3.5.1"
            id="jquery-core-js"></script>
    <script type="text/javascript"
            src="http://vyaznik.ru/wp-includes/js/jquery/jquery-migrate.min.js?ver=3.3.2"
            id="jquery-migrate-js"></script>
    <script type="text/javascript"
            src="<?= get_template_directory_uri() ?>/js/ajax-load-more.js?ver=5.6"
            id="wp_ajax_loadmore-js"></script>

    <style>
        .column-id {
            width: 20px;
        }

        .column-image {
            max-width: 100px;
        }

        .column-image img {
            max-width: 100%;
            height: auto;
        }
    </style>
    <?php
});


// Добавление в посты темы картинки
add_theme_support('post-thumbnails');


// добавляем настройки
$true_page = 'myparameters.php'; // это часть URL страницы, рекомендую использовать строковое значение, т.к.
// в данном случае не будет зависимости от того, в какой файл вы всё это вставите

/*
 * Функция, добавляющая страницу в пункт меню Настройки
 */
function true_options()
{
    global $true_page;
    add_options_page('Параметры', 'Параметры', 'manage_options',
        $true_page, 'true_option_page');
}

add_action('admin_menu', 'true_options');

/**
 * Возвратная функция (Callback)
 */
function true_option_page()
{
    global $true_page;
    ?>
    <div class="wrap">
    <h2>Дополнительные параметры сайта</h2>
    <form method="post" enctype="multipart/form-data" action="options.php">
        <?php
        settings_fields('true_options'); // меняем под себя только здесь (название настроек)
        do_settings_sections($true_page);
        ?>
        <p class="submit">
            <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>"/>
        </p>
    </form>
    </div><?php
}


/**
 * Возвращает массив id => заголовок
 * Используется для заполнения select'ов в настройках
 * @return array
 */
function get_news_title_and_id()
{
    $posts = get_posts(['post_type' => 'news', 'numberposts' => -1]);
    $data = array();
    foreach ($posts as $post) {
        $data += [$post->ID => $post->post_title];
    }
    return $data;
}

/*
 * Регистрируем настройки
 * Мои настройки будут храниться в базе под названием true_options (это также видно в предыдущей функции)
 */
function true_option_settings()
{
    global $true_page;
    // Присваиваем функцию валидации ( true_validate_settings() ). Вы найдете её ниже
    register_setting('true_options', 'true_options', 'true_validate_settings'); // true_options

    // Добавляем секцию
    add_settings_section('true_section_1', 'Настройка главных постов', '', $true_page);

    $true_field_params = array(
        'type' => 'select',
        'id' => 'important_news_id_1',
        'desc' => 'Выберите новость.',
        'vals' => get_news_title_and_id()
    );
    add_settings_field('important_news_id_1_field', 'Важный пост 1 :', 'true_option_display_settings',
        $true_page, 'true_section_1', $true_field_params);

    $true_field_params = array(
        'type' => 'select',
        'id' => 'important_news_id_2',
        'desc' => 'Выберите новость.',
        'vals' => get_news_title_and_id()
    );
    add_settings_field('important_news_id_2_field', 'Важный пост 2 :', 'true_option_display_settings',
        $true_page, 'true_section_1', $true_field_params);

    $true_field_params = array(
        'type' => 'select',
        'id' => 'important_news_id_3',
        'desc' => 'Выберите новость.',
        'vals' => get_news_title_and_id()
    );
    add_settings_field('important_news_id_3_field', 'Важный пост 3 :', 'true_option_display_settings',
        $true_page, 'true_section_1', $true_field_params);

    $true_field_params = array(
        'type' => 'select',
        'id' => 'important_news_id_4',
        'desc' => 'Выберите новость.',
        'vals' => get_news_title_and_id()
    );
    add_settings_field('important_news_id_4_field', 'Важный пост 4 :', 'true_option_display_settings',
        $true_page, 'true_section_1', $true_field_params);
}

add_action('admin_init', 'true_option_settings');

/*
 * Функция отображения полей ввода
 * Здесь задаётся HTML и PHP, выводящий поля
 */
function true_option_display_settings($args)
{
    extract($args);

    $option_name = 'true_options';

    $o = get_option($option_name);

    switch ($type) {
        case 'text':
            $o[$id] = esc_attr(stripslashes($o[$id]));
            echo "<input class='regular-text' type='text' id='$id' name='" . $option_name . "[$id]' value='$o[$id]' />";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            break;
        case 'textarea':
            $o[$id] = esc_attr(stripslashes($o[$id]));
            echo "<textarea class='code large-text' cols='50' rows='10' type='text' id='$id' name='" . $option_name . "[$id]'>$o[$id]</textarea>";
            echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
            break;
        case 'checkbox':
            $checked = ($o[$id] == 'on') ? " checked='checked'" : '';
            echo "<label><input type='checkbox' id='$id' name='" . $option_name . "[$id]' $checked /> ";
            echo ($desc != '') ? $desc : "";
            echo "</label>";
            break;
        case 'select':
            echo "<select id='$id' name='" . $option_name . "[$id]'>";
            foreach ($vals as $v => $l) {
                $selected = ($o[$id] == $v) ? "selected='selected'" : '';
                echo "<option value='$v' $selected>$l</option>";
            }
            echo ($desc != '') ? $desc : "";
            echo "</select>";
            break;
        case 'radio':
            echo "<fieldset>";
            foreach ($vals as $v => $l) {
                $checked = ($o[$id] == $v) ? "checked='checked'" : '';
                echo "<label><input type='radio' name='" . $option_name . "[$id]' value='$v' $checked />$l</label><br />";
            }
            echo "</fieldset>";
            break;
    }
}

/*
 * Функция проверки правильности вводимых полей
 */
function true_validate_settings($input)
{
    foreach ($input as $k => $v) {
        $valid_input[$k] = trim($v);

        /* Вы можете включить в эту функцию различные проверки значений, например
        if(! задаем условие ) { // если не выполняется
            $valid_input[$k] = ''; // тогда присваиваем значению пустую строку
        }
        */
    }
    return $valid_input;
}


function news_permalink($permalink, $post)
{
    // выходим если это не наш тип записи: без холдера %news%
    if (strpos($permalink, '%news%') === FALSE)
        return $permalink;

    // Получаем элементы таксы
    $terms = get_the_terms($post, 'news');
    // если есть элемент заменим холдер
    if (!is_wp_error($terms) && !empty($terms) && is_object($terms[0]))
        $taxonomy_slug = $terms[0]->slug;
    // элемента нет, а должен быть...
    else
        $taxonomy_slug = 'no-news';

    return str_replace('%news%', $taxonomy_slug, $permalink);
}

// Раздел "помощь" типа записи news
function add_help_text($contextual_help, $screen_id, $screen)
{
    //$contextual_help .= print_r($screen); // используйте чтобы помочь определить параметр $screen->id
    if ('news' == $screen->id) {
        $contextual_help = '
		<p>Напоминалка при редактировании записи news:</p>
		<ul>
			<li>Указать тему, например Киноиндустрия или Политика.</li>
			<li>Указать автора новости.</li>
		</ul>
		<p>Если нужно запланировать публикацию на будущее:</p>
		<ul>
			<li>В блоке с кнопкой "опубликовать" нажмите редактировать дату.</li>
			<li>Измените дату на нужную, будущую и подтвердите изменения кнопкой ниже "ОК".</li>
		</ul>
		<p><strong>За дополнительной информацией обращайтесь:</strong></p>
		<p><a href="/" target="_blank">Блог о WordPress</a></p>
		<p><a href="http://wordpress.org/support/" target="_blank">Форум поддержки</a></p>
		';
    } elseif ('edit-news' == $screen->id) {
        $contextual_help = '<p>Это раздел помощи показанный для типа записи News и т.д. и т.п.</p>';
    }

    return $contextual_help;
}

function news_updated_messages($messages)
{
    global $post;

    $messages['news'] = array(
        0 => '', // Не используется. Сообщения используются с индекса 1.
        1 => sprintf('News обновлено. <a href="%s">Посмотреть запись news</a>', esc_url(get_permalink($post->ID))),
        2 => 'Произвольное поле обновлено.',
        3 => 'Произвольное поле удалено.',
        4 => 'Запись News обновлена.',
        /* %s: дата и время ревизии */
        5 => isset($_GET['revision']) ? sprintf('Запись News восстановлена из ревизии %s', wp_post_revision_title((int)$_GET['revision'], false)) : false,
        6 => sprintf('Запись News опубликована. <a href="%s">Перейти к записи news</a>', esc_url(get_permalink($post->ID))),
        7 => 'Запись News сохранена.',
        8 => sprintf('Запись News сохранена. <a target="_blank" href="%s">Предпросмотр записи news</a>', esc_url(add_query_arg('preview', 'true', get_permalink($post->ID)))),
        9 => sprintf('Запись News запланирована на: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Предпросмотр записи news</a>',
            // Как форматировать даты в PHP можно посмотреть тут: http://php.net/date
            date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post->ID))),
        10 => sprintf('Черновик записи News обновлен. <a target="_blank" href="%s">Предпросмотр записи news</a>', esc_url(add_query_arg('preview', 'true', get_permalink($post->ID)))),
    );

    return $messages;
}

// Add taxonomy and news post type
function register_news_post_type()
{
    // Раздел новостей - news
    register_taxonomy('news', array('news'), array(
        'label' => 'Раздел новости', // определяется параметром $labels->name
        'labels' => array(
            'name' => 'Разделы новостей',
            'singular_name' => 'Раздел новости',
            'search_items' => 'Искать Раздел новости',
            'all_items' => 'Все Разделы новостей',
            'parent_item' => 'Родит. раздел новости',
            'parent_item_colon' => 'Родит. раздел новости:',
            'edit_item' => 'Ред. Раздел новости',
            'update_item' => 'Обновить Раздел новости',
            'add_new_item' => 'Добавить Раздел новости',
            'new_item_name' => 'Новый Раздел новости',
            'menu_name' => 'Раздел новости',
        ),
        'description' => 'Рубрики для раздела новостей', // описание таксономии
        'public' => true,
        'show_in_nav_menus' => true, // равен аргументу public
        'show_ui' => true, // равен аргументу public
        'show_tagcloud' => true, // равен аргументу show_ui
        'has_archive' => 'news',
        'hierarchical' => true,
        'rewrite' => array('slug' => 'news/%news%', 'hierarchical' => false, 'with_front' => false),
        'show_admin_column' => true, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
    ));

    // тип записи - новости - news
    register_post_type('news', [
        'label' => 'Новости',
        'labels' => [
            'name' => 'Новости', // основное название для типа записи
            'singular_name' => 'Новость', // название для одной записи этого типа
            'add_new' => 'Добавить новость', // для добавления новой записи
            'add_new_item' => 'Добавление новости', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item' => 'Редактирование новостей', // для редактирования типа записи
            'new_item' => 'Новая новость', // текст новой записи
            'view_item' => 'Смотреть новость', // для просмотра записи этого типа.
            'search_items' => 'Искать новости', // для поиска по этим типам записи
            'not_found' => 'Новости не найдены', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Новости не найдены в корзине', // если не было найдено в корзине
            'parent_item_colon' => '', // для родителей (у древовидных типов)
            'menu_name' => 'Новости', // название меню
        ],
        'description' => '',
        'public' => true,
        // 'publicly_queryable'  => null, // зависит от public
        // 'exclude_from_search' => null, // зависит от public
        // 'show_ui'             => null, // зависит от public
        // 'show_in_nav_menus'   => null, // зависит от public
        'show_in_menu' => true, // показывать ли в меню адмнки
        // 'show_in_admin_bar'   => null, // зависит от show_in_menu
        'show_in_rest' => null, // добавить в REST API. C WP 4.7
        'rest_base' => null, // $post_type. C WP 4.7
        'menu_position' => 3,
        'menu_icon' => 'dashicons-admin-site-alt2',
        //'capability_type'   => 'post',
        //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
        //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
        'hierarchical' => false,
        'supports' => [
            'title',
            'editor',
            'comments',
            'thumbnail'
        ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
        'taxonomies' => ['news'],
        'has_archive' => false,
        'rewrite' => true,
        'query_var' => true,
    ]);

}


function sp_content_width()
{
    $GLOBALS['content_width'] = apply_filters('sp_content_width', 640);
}

add_action('after_setup_theme', 'sp_content_width', 0);

//Register widget area.
function sp_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'sp-theme'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'sp-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}

add_action('widgets_init', 'sp_widgets_init');

function get_header_menu($menu_name)
{
    foreach (wp_get_nav_menu_items($menu_name) as $item) {
        ?>
        <a href="<?= $item->url ?>" class="header__nav_link"><?= $item->post_title ?></a>
        <?php
    }
}

function get_VK_comments_widget($class = null, $apiId = null)
{
    ?>
<div class="<?= (isset($class)) ? $class : 'apiVkComments' ?>">
    <h2>Последние коментарии</h2>
    <script type="text/javascript">
        VK.init({
            apiId: <?= (isset($apiId)) ? $apiId : '7727410' ?>,
            onlyWidgets: true
        });
    </script>
    <div id="vk_comments"></div>
    <script type="text/javascript">
        VK.Widgets.Comments("vk_comments");
    </script>

    </div><?php
}

function get_footer_menu($menu_name)
{
    foreach (wp_get_nav_menu_items($menu_name) as $item) {
        ?>
        <a href="<?= $item->url ?>" class="footer_links"><?= $item->post_title ?></a>
        <?php
    }
}

function get_main_news()
{
    $all_options = get_option('true_options');
    $main_post_id = get_option('main_post_id');
    get_template_part('load-main-news', null, ['main_post_id' => $main_post_id]);
    get_template_part('load-important-news', null, ['all_options' => $all_options]);
}

function get_news_posts_query($post_per_page, array $category = null, $offset = null,
                              array $exclude_id = null, array $args = null)
{
    $params = [
        'post_type' => 'news',
        'posts_per_page' => $post_per_page
    ];

    if (null !== $offset && !empty($offset)) {
        $params = array_merge($params, array('offset' => $offset));
    }

    if (null !== $category && !empty($category)) {
        $params = array_merge($params, array(
            'post__not_in' => array(get_the_ID()),
            'tax_query' => array(
                array(
                    'taxonomy' => 'news',
                    'field' => 'term_id',
                    'terms' => $category
                )
            )
        ));
    }

    if (null !== $exclude_id && !empty($exclude_id)) {
        $params = array_merge($params, array('post__not_in' => $exclude_id));
    }

    if (null !== $args && !empty($args)) {
        $params = array_merge($params, $args);
    }

    return new WP_Query($params);
}

function get_search_news_button()
{
    ?>
    <div class="header__search">
        <input type="search">
        <button class="search_button">
            <img src="<?= get_template_directory_uri() ?>/raw_html/img/search.svg" alt="">
        </button>
    </div>
    <?php
}

function get_load_news_button(WP_Query $news_posts_query)
{
    if ($news_posts_query->have_posts()) {
        ?>
        <button id="addOldArticle"
                class="btn-loadmore add_OlderArticle_button"
                title="Посмотреть еще"
                data-param-posts='<?= serialize($news_posts_query->query_vars) ?>'
                data-max-pages='<?= $news_posts_query->max_num_pages ?>'
                data-tpl='news'
        >
            <!--            <i class="fas fa-redo"></i> -->
            Загрузить ещё
        </button>
        <?php
    } else {
        echo "Новостей больше нет";
    }
}

function get_exclude_news_id(): array
{
    $id_array = array();

    $all_options = get_option('true_options');

    for ($i = 1; $i <= 4; $i++) {
        array_push($id_array, (int)$all_options['important_news_id_' . $i]);
    }

    array_push($id_array, get_option('main_post_id'));

    return $id_array;
}

function render_news_posts($news_posts_query)
{
    //$news_posts_query = get_news_posts_query($post_per_page, $category, $exclude_id);
    if ($news_posts_query->have_posts()) {
        $posts_id = array();
        while ($news_posts_query->have_posts()) {
            $news_posts_query->the_post();
            get_template_part('load-news');
            array_push($posts_id, get_the_ID());
        }
        wp_reset_postdata();
        return $posts_id;
    } else {
        echo "Новостей больше нет.";
        return null;
    }
}

function search_news()
{
    $post_per_page = 12;

    $addict_args = ['s' => $_GET['s']];

    if (isset($_GET['meta_key'])) {
        $addict_args = array_merge($addict_args, ['meta_key' => $_GET['meta_key']]);
    }

    if (isset($_GET['orderby'])) {
        $addict_args = array_merge($addict_args, ['orderby' => $_GET['orderby']]);
    }

    $news_search_query = get_news_posts_query($post_per_page, null, null, null,
        $addict_args);

    if ($news_search_query->have_posts()) { ?>
        <div class="add_OlderArticle"> <?php
            while ($news_search_query->have_posts()) {
                $news_search_query->the_post();
                get_template_part('load-news');
            }
            ?>
        </div>
        <script> var this_page = 2; </script>
        <?php
        if (1 < $news_search_query->max_num_pages && $news_search_query->have_posts()) {
            get_load_news_button($news_search_query);
        }
    } else {
        echo "<h2>По запросу \"{$_GET['s']}\" ничего не найдено</h2>";
    }
}

// AJAX загрузка постов
function load_posts()
{
    $args = unserialize(stripslashes($_POST['query']));
    $args['paged'] = $_POST['page'] + 1; // следующая страница

    if (1 != $_POST['page']) {
        $args['offset'] += ($_POST['page'] - 1) * $args['posts_per_page'];
    }

    query_posts($args);
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            get_template_part('load-news');
        }
    } else {
        echo "Новостей больше нет.";
    }
    die();
}


add_action('wp_ajax_loadmore', 'load_posts');
add_action('wp_ajax_nopriv_loadmore', 'load_posts');

//Enqueue scripts and styles.
function sp_scripts()
{
    // wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css');
    wp_enqueue_style('cms-style', get_stylesheet_uri());
    wp_enqueue_style('mediascreen', get_template_directory_uri() . '/css/mediascreen.css');
    wp_enqueue_style('swiper', get_template_directory_uri() . '/css/swiper.css');
    wp_enqueue_style('animate', get_template_directory_uri() . '/css/animate.css');
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/css/fontawesome-all.css');

    wp_enqueue_style('tpl-content', get_template_directory_uri() . '/raw_html/css/content.css');

    wp_enqueue_script('wp_ajax_loadmore', get_template_directory_uri() .
        '/js/ajax-load-more.js', array('jquery'), '', true);

        wp_enqueue_script('raw_html', get_template_directory_uri() . '/raw_html/js/mainScript.js',
                                                                                null, null, true );

    wp_enqueue_script('jquery');
    wp_enqueue_script('swiper', get_template_directory_uri() . '/js/swiper.js');
    wp_enqueue_script('wow', get_template_directory_uri() . '/js/wow.js');
    wp_enqueue_script('lazyload', get_template_directory_uri() . '/js/lazyload.js');
    wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js');

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'sp_scripts');

//Include the TGM_Plugin_Activation class.
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';

//Implement the Custom Header feature.
require get_template_directory() . '/inc/custom-header.php';

//Functions which enhance the theme by hooking into WordPress.
require get_template_directory() . '/inc/sp-class.php';

//Functions which enhance the theme by hooking into WordPress.
require get_template_directory() . '/inc/template-functions.php';

//Customizer additions.
require get_template_directory() . '/inc/customizer.php';
