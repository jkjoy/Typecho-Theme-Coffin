<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('head.php'); ?>
<?php $this->need('header.php'); ?>
<?php
    $categoryImage = '';
    if ($this->categories) {
        $category = $this->categories[0];
        $categoryId = $category['mid'];
        $categoryName = $category['name'];
        $themeUrl = Helper::options()->themeUrl . '/img/';
        $categoryImage = $themeUrl . $categoryId . '.png';
    }
?>
<main class="layoutSingleColumn--wide min-height-100">
<?php if ($this->have()): ?>
<header class="collectionHeader">
    <?php if ($this->is('category')): ?>
    <img src="<?php echo $categoryImage; ?>" alt="<?php echo $categoryName; ?>" class="archive-header-image">
    <?php endif; ?>
    <div class="collectionHeader-nameAndDescription u-flex1">
        <h1 class="collectionHeader-name"><?php $this->archiveTitle(array(
            'category'  =>  _t('  <span> %s </span> '),
            'search'    =>  _t('包含关键字<span> %s </span>的文章'),
            'date'      =>  _t('在 <span> %s </span>发布的文章'),
            'tag'       =>  _t('标签 <span> %s </span>下的文章'),
            'author'    =>  _t('作者 <span>%s </span>发布的文章')
        ), '', ''); ?></h1>
        <div class="collectionHeader-description">
            <p><?php echo $this->getDescription(); ?></p>
        </div>        
    </div>
</header>
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
        <?php else: ?>   
    <header class="archive-header u-textAlignCenter">
        <h3 class="page-title"><span>Sorry</span></h3>
    </header>
    <div class="sandraList">
    <p>很遗憾,未找到您期待的内容</p>
    </div>           
        <?php endif; ?>
</main>
<?php $this->need('footer.php'); ?>