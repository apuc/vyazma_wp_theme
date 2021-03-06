<?php
/**
 * @var $args array
 */

$sp_obj = new SpClass();

?>
<article class="oldSingleArticle">
    <a href="<?= get_permalink()?>" class="ArticleHref"></a>
    <div class="oldSingleArticle_blockImg">
        <img class="oldArticleImg" src="<?= $sp_obj->get_thumbnail(get_the_ID(), '') ?>"
             alt="<?= mb_substr(get_the_excerpt(get_the_ID()), 0, 70) . '...' ?>">
    </div>
    <div class="OldArticleDescription">
        <a href="<?= get_permalink()?>" class="oldSingleArticle_title"><?= the_title() ?></a>
        <p class="oldSingleArticle_description">
            <?= close_tags(mb_substr(str_replace(array('<pre>', '</pre>'), '', get_the_excerpt()), 0, 75) . '...'); ?>
        </p>
    </div>
</article>