<?php
// Регистрируем свои колонки (столбцы). Обязательно.
add_filter( 'manage_news_posts_columns', function ( $columns ) {
    $columns_in_head = [
        'id'    => 'ID',
        'image' => 'Миниатюра',
    ];

    $columns_in_tale = [
        'is_main' => 'Главная'
    ];

    return array_slice( $columns, 0, 1 ) + $columns_in_head + $columns + $columns_in_tale;
} );



add_filter( 'manage_news_posts_custom_column', function ( $column_name, $post_ID ) {
    if ( $column_name === 'id' ) {
        the_ID();
    }

    if ( $column_name === 'image' && has_post_thumbnail() ) {
        ?>
        <a href="<?php echo get_edit_post_link(); ?>">
            <?php the_post_thumbnail( 'thumbnail' ); ?>
        </a>
        <?php
    }

    if($column_name === 'is_main'){

    }
}, 10, 2 );

// Выводим стили для своих столбцов. Необязательно.
add_action( 'admin_print_footer_scripts-edit.php', function () {
    ?>
    <style>
        .column-id {
            width: 20px;
        }

        .column-image img {
            max-width: 100%;
            height: auto;
        }
    </style>
    <?php
} );
