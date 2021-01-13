<?php
/*
 * The main template file
 */
get_header();
$sp_obj = new SpClass();
?>

    <h1><?php $sp_obj->get_title(); ?></h1>
    <div class="container">
        <section>
            <?php get_main_news(); ?>

            <div class="container_oldArticle">
                <div class="container_oldArticle_top">
                    <?php
                    get_VK_comments_widget();
                     $first_posts_num = 2; // also offset
                    render_news_posts( get_news_posts_query($first_posts_num, null, null, get_exclude_news_id())); ?>
                </div>
                <div>
                </div>
            </div>
            <div class="add_OlderArticle">
            </div>
            <script> var this_page = 1 ; </script>
            <?php
            get_load_news_button(get_news_posts_query(4, null, $first_posts_num, get_exclude_news_id()));
            ?>
        </section>
    </div>
<?php
get_footer();