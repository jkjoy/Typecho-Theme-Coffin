<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
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