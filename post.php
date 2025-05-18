<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('head.php'); ?>
<?php $this->need('header.php'); ?>
<main class="layoutSingleColumn">
    <article class="entry" itemscope="itemscope" itemtype="http://schema.org/Article">
        <header class="entry--header">
            <div class="entry--meta">
                <time itemprop="datePublished" datetime="<?php $this->date('Y-m-d'); ?>" class="humane--time"><?php $this->date('Y-m-d'); ?></time>
                <span class="middotDivider"></span>
                <?php $this->category(','); ?> 
                <span class="middotDivider"></span><?php get_post_view($this) ?> 浏览  
                <?php if($this->user->hasLogin() && $this->user->pass('editor', true)): ?>    
                <span class="middotDivider"></span>
                <a href="<?php $this->options->adminUrl('write-post.php?cid=' . $this->cid); ?>" target="_blank" title="编辑文章">Edit</a>
                <?php endif; ?>              
            </div>
                <h2 class="entry--title" itemprop="headline"><?php $this->title() ?></h2>            
        </header>
            <meta itemscope itemprop="mainEntityOfPage" itemType="https://schema.org/WebPage" itemid="<?php $this->permalink() ?>" />
            <meta itemprop="datePublished" content="<?php $this->date('Y-m-d'); ?>" />
            <meta itemprop="dateModified" content="<?php $this->date('Y-m-d'); ?>" />
            <div class="grap entry--content" itemprop="articleBody">
                <div class="showtoc"></div>
            <?php $this->content(); ?>
            </div>
<!-- 个人信息-->
<?php if ($this->options->showProfile): ?>
    <?php $this->need('profile.php'); ?>
<?php endif; ?>
<?php $prevPost = get_previous_post($this); $prevThumbnailUrl = get_post_main_thumbnail($prevPost);?>
<nav class="navigation post-navigation is-active" aria-label="Post">
        <div class="nav-previous">
        <?php if ($prevPost) { ?>
            <a href="<?php echo $prevPost->permalink; ?>" rel="prev">
                <span class="meta-nav">Previous</span>
                <span class="post-title">
                <?php echo $prevPost->title; ?>              
                </span>
            </a>
            <a href="<?php echo $prevPost->permalink; ?>"  class="cover--link">
                <img alt="<?php echo $prevPost->title; ?>" src="<?php echo $prevThumbnailUrl; ?>" class="cover" />                      
            </a>
        <?php } else { ?>
        <?php } ?> 
        </div>
        <?php
            $nextPost = get_next_post($this);
            $nextThumbnailUrl = get_post_main_thumbnail($nextPost);
        ?>
        <div class="nav-next">
            <?php if ($nextPost) { ?>
            <a href="<?php echo $nextPost->permalink; ?>" rel="next">
                <span class="meta-nav">Next</span>
                <span class="post-title">
                <?php echo $nextPost->title; ?>              
                </span>
            </a>
            <a href="<?php echo $nextPost->permalink; ?>" class="cover--link">
                <img src="<?php echo $nextThumbnailUrl; ?>" class="cover" alt="<?php echo $nextPost->title; ?>  " />
            </a>   
            <?php } else { ?>
            <?php } ?>
        </div>
    </nav>      
</article>

<!--评论 -->
<?php $this->need('comments.php'); ?>

<!-- 相关文章-->
<section class="related--posts">
    <h3 class="related--posts__title">Related Posts</h3>
    <div class="entry--related">
    <?php $this->related(6)->to($relatedPosts); ?>   
    <?php while ($relatedPosts->next()): ?>
        <?php //$thumb = get_post_main_thumbnail($relatedPosts); ?>
            <div class="entry--related__item">
                <a href="<?php $relatedPosts->permalink(); ?>" aria-label="<?php $relatedPosts->title(25); ?>">
                    <!--<div class="entry--related__img">
                            <img src="<?php //echo htmlspecialchars($thumb); ?>" class="cover" alt="<?php //$relatedPosts->title(25); ?>" />
                    </div>-->
                    <div class="entry--related__title">
                            <?php $relatedPosts->title(25); ?>                  
                    </div>
                    <div class="meta">
                        <time datetime="<?php $relatedPosts->date('c'); ?>" class="humane--time">
                        <?php $relatedPosts->date('Y-m-d'); ?>
                        </time>
                        <span class="middotDivider"></span>
                        <?php if ($relatedPosts->categories): ?>
                            <?php $relatedPosts->category(''); ?>
                        <?php endif; ?>         
                    </div>
                </a>
            </div>
            <?php endwhile; ?>
    </div>
</section>    
</main>
<script>
document.addEventListener('DOMContentLoaded', (event) => {
    const targetClassElement = document.querySelector('.showtoc');
    const postContent = document.querySelector('.entry--content');
    if (!postContent) return;
    let found = false;
    for (let i = 1; i <= 6 &&!found; i++) {
        if (postContent.querySelector(`h${i}`)) {
            found = true;
        }
    }
    if (!found) return;
    const heads = postContent.querySelectorAll('h1, h2, h3, h4, h5, h6');
    const toc = document.createElement('div');
    toc.id = 'toc';
    toc.innerHTML = '<details class="coffin--toc" open><summary>目录</summary><nav id="TableOfContents"><ul></ul></nav></details>';
    // 插入到指定 class 元素之后
    if (targetClassElement) {
        targetClassElement.parentNode.insertBefore(toc, targetClassElement.nextSibling);
    }
    let currentLevel = 0;
    let currentList = toc.querySelector('ul');
    let levelCounts = [0];
    heads.forEach((head, index) => {
        const level = parseInt(head.tagName.substring(1));
        if (levelCounts[level] === undefined) {
            levelCounts[level] = 1;
        } else {
            levelCounts[level]++;
        }
        // 重置下级标题的计数器
        levelCounts = levelCounts.slice(0, level + 1);
        if (currentLevel === 0) {
            currentLevel = level;
        }
        while (level > currentLevel) {
            let newList = document.createElement('ul');
            if (!currentList.lastElementChild) {
                currentList.appendChild(newList);
            } else {
                currentList.lastElementChild.appendChild(newList);
            }
            currentList = newList;
            currentLevel++;
            levelCounts[currentLevel] = 1;
        }
        while (level < currentLevel) {
            currentList = currentList.parentElement;
            if (currentList.tagName.toLowerCase() === 'li') {
                currentList = currentList.parentElement;
            }
            currentLevel--;
        }
        const anchor = head.textContent.trim().replace(/\s+/g, '-');
        head.id = anchor;
        const item = document.createElement('li');
        const link = document.createElement('a');
        link.href = `#${anchor}`;
        link.textContent = `${head.textContent}`;
        link.style.textDecoration = 'none';
        item.appendChild(link);
        currentList.appendChild(item);
    });
});
</script>
<?php $this->need('footer.php'); ?>