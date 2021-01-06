<?php
/*
 * The main template file
 */
get_header();
$sp_obj = new SpClass();
?>

    <h1><?php $sp_obj->get_title(); ?>
    </h1>
        <div class="container">

        </div>

<?php
get_footer();