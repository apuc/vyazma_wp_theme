<?php
/*
 * The template for displaying search results pages
 */

get_header();
$sp_obj = new SpClass();
?>
 <div class="container">
        <section>
            <?php search_news();?>
        </section>
    </div>
<?php
get_footer();