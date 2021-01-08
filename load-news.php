<?php
/**
 * @var $args array
 */

$sp_obj = new SpClass();

?>
<article class="oldSingleArticle">
    <a href="<?= get_permalink()?>" class="ArticleHref"></a>
    <div class="oldSingleArticle_blockImg">
        <img class="oldArticleImg"
             src="<?= $sp_obj->get_thumbnail(get_the_ID(), '') ?>" alt="<?= strip_tags(get_the_content()) ?>">
    </div>
    <div class="OldArticleDescription">
        <a href="<?= get_permalink()?>" class="oldSingleArticle_title"><?= the_title() ?></a>
        <p class="oldSingleArticle_description">
            <?= mb_substr(str_replace(array('<pre>', '</pre>'), '',get_the_content()), 0, 20) . '...'; ?></p>
    </div>
</article>