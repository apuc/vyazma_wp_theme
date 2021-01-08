<?php
/**
 * @var $args array
 */

$sp_obj = new SpClass();
?>
<article class="oldSingleArticle">
    <div class="oldSingleArticle_blockImg">
        <img class="oldArticleImg"
             src="<?= $sp_obj->get_thumbnail(get_the_ID(), '') ?>" alt="">
    </div>
    <div class="OldArticleDescription">
        <a href="" class="oldSingleArticle_title"><?= the_title() ?></a>
        <p class="oldSingleArticle_description">
            <?= substr(strip_tags(get_the_content()), 0,    40) . '...'; ?>
        </p>
    </div>
</article>
