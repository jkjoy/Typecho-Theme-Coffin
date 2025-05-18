<?php 
/**
 * 友情链接
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('head.php'); ?>
<?php $this->need('header.php'); ?>
<main class="layoutSingleColumn layoutSingleColumn--wide">
    <article class="page--single" itemscope="itemscope" itemtype="http://schema.org/Article">
            <header class="page-archive-header">
                <h2 class="page-archive-title" itemprop="headline"><?php $this->title(); ?></h2>
            </header>
            <div class="grap" itemprop="articleBody">
                <?php $this->content(); ?>
            </div>
        <div class="link-items">
        <?php
            Links_Plugin::output('<a class="link-item" href="{url}" target="_blank" title="{title}">
            <img alt="" src="{image}" class="avatar avatar-64 photo" height=64 width=64 decoding="async"/>
            <strong>{name}</strong><span class="sitename">{title}</span>     
            </a>');
        ?>
        </div>   
    </article>
    <?php if ($this->allow('comment')): ?>
       <?php $this->need('comments.php'); ?>
    <?php endif; ?>
</main>
<?php $this->need('footer.php'); ?>