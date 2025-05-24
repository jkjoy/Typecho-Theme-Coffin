<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="initial-scale=1.0,minimal-ui">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> <?php if($this->_currentPage>1) echo '第 '.$this->_currentPage.' 页 - '; ?>
        <?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'date'      =>  _t('在<span> %s </span>发布的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?>
        <?php if ($this->is('post')) $this->category(',', false);?>
        <?php if ($this->is('post')) echo ' - ';?>
        <?php $this->options->title(); ?>
        <?php if ($this->is('index')) echo ' - '; ?>
        <?php if ($this->is('index')) $this->options->description() ?>
    </title>
    <link rel="stylesheet" href="<?php $this->options->themeUrl('style.css'); ?>">
    <?php if ($this->options->icoUrl): ?>
    <link rel='icon' href='<?php $this->options->icoUrl() ?>' type='image/x-icon' />
    <?php endif; ?>
    <?php $this->header("generator=&template=&pingback=&wlw=&xmlrpc=&rss1=&atom=&rss2=/feed"); ?>
    <?php $this->options->addhead(); ?>
</head>
<body class="home blog wp-theme-Coffin">
            <script>
            window.DEFAULT_THEME = "auto";
            if (localStorage.getItem("theme") == null) {
                localStorage.setItem("theme", window.DEFAULT_THEME);
            }
            if (localStorage.getItem("theme") == "dark") {
                document.querySelector("body").classList.add("dark");
            }
            if (localStorage.getItem("theme") == "auto") {
                document.querySelector("body").classList.add("auto");
            }
        </script>
        <header class="metabar">
        <div class="layoutSingleColumn--wide metabar--inner">
            <?php if ($this->options->logoUrl): ?>
            <a href="<?php $this->options->siteUrl(); ?>" class="u-flex">
                <img class="logo logo--rounded" src="<?php $this->options->logoUrl() ?>" width=38 />
            </a>
            <?php else: ?>
                <a href="<?php $this->options->siteUrl(); ?>" class="u-flex">
                </a>
            <?php endif; ?>
                <ul id="menu-farallon" class="subnav-ul">
                    <li id="menu-item-13" class="menu-item menu-item-type-post_type menu-item-object-page">
                        <a href="/">首页</a>
                    </li>
                <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                    <?php while($pages->next()): ?>
                    <li>
                        <?php $this->is('page', $pages->slug) ?> 
                        <a 
                            class="menu-item menu-item-type-post_type menu-item-object-page"
                            href="<?php $pages->permalink(); ?>" 
                            title="<?php $pages->title(); ?>">
                            <?php $pages->title(); ?>
                        </a>
                    </li>
                    <?php endwhile; ?>		 
                </ul>                        
            <form role="search" method="get" class="search-form" action="<?php $this->options->siteUrl(); ?>">
                <label>
                    <span class="screen-reader-text">搜索</span>
                    <input type="text" name="s" class="search-field" placeholder="搜索..." value="<?php echo htmlspecialchars($this->request->s); ?>" required/>
                </label>
                <input type="submit" class="search-submit submit" value="搜索" />
            </form>        
        </div>
    </header>