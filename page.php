<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('head.php'); ?>
<?php $this->need('header.php'); ?>
<div class="layoutSingleColumn  min-height-100">
    <article class="entry" itemscope="itemscope" itemtype="http://schema.org/Article">
        <header class="entry--header">
            <h2 class="entry--title" itemprop="headline"><?php $this->title() ?></h2>            
        </header>
        <div class="grap entry--content" itemprop="articleBody">
            <p>  
                <?php $this->content(); ?>
            </p>
        </div>
        <div class="comments-area">
        <?php if ($this->allow('comment')): ?>
        <?php $this->need('comments.php'); ?>
        <?php endif; ?> 
	    </div>            
    </article>
</div>
<?php $this->need('footer.php'); ?>