<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;?>
    <main class="layoutSingleColumn--wide min-height-100">
        <div class="sandraList">
        <?php while($this->next()): ?>
            <?php $thumbnail = get_post_main_thumbnail($this); ?>
            <article class="sandraItem" itemscope="itemscope" itemtype="http://schema.org/Article">
                <div class="sandraItem-image">
                    <a style="background-image: url(<?php echo htmlspecialchars($thumbnail); ?>);" href="<?php $this->permalink() ?>" title="<?php $this->title() ?>" aria-label="<?php $this->title() ?>">
                    </a>
                </div>
                <div class="sandraItem--content">
                    <div class="sandraItem-meta">
                        <h2 class="sandraItem-title" itemprop="headline">
                            <a href="<?php $this->permalink() ?>" aria-label="<?php $this->title() ?>" title="<?php $this->title() ?>"><?php $this->title() ?></a>
                        </h2>
                    </div>
                    <div class="sandraItem-info">
                        <time itemprop="datePublished" datetime="<?php $this->date('Y-m-d'); ?> " class="humane--time">
                        <?php $this->date('Y-m-d'); ?>         
                        </time>
                        <span class="middotDivider"></span>
                        <?php get_post_view($this) ?> 浏览                    
                    </div>
                </div>
            </article> 
	<?php endwhile; ?>
    </div>
    <nav class="navigation pagination" aria-label="文章分页">
    <h2 class="screen-reader-text">文章分页</h2>
    <?php
            $this->pageNav(
                ' ',
                ' ',
                1,
                '...',
                array(
                    'wrapTag' => 'div',
                    'wrapClass' => 'nav-links',
                    'itemTag' => '',
                    'textTag' => 'span',
                    'itemClass'   => 'page-numbers', 
                    'currentClass' => 'page-numbers current',
                    'prevClass' => 'hidden',
                    'nextClass' => 'hidden'
                )
            );
        ?>
	</nav>
</main>