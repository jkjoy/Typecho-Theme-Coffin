<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div id="comments" class="comments-area">
    <?php $this->comments()->to($comments); ?>
    <?php if($this->allow('comment')): ?>
        <h3 class="comments-title">
            <?php $this->commentsNum('0', '1', '%d'); ?> 条评论
        </h3>
        <?php if ($comments->have()): ?>
            <ol class="comment-list commentlist">
                <?php $comments->listComments(array(
                    'before' => '',
                    'after' => '',
                    'callback' => 'threadedComments'
                )); ?>
            </ol>
            <nav class="navigation pagination" aria-label="文章分页">
                <?php
                $comments->pageNav(
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
            <center><h3>暂无评论</h3></center>
        <?php endif; ?>

        <div id="respond" class="comment-respond">
            <h3 id="reply-title" class="comment-reply-title">
                发表回复
                <small>
                    <a rel="nofollow" id="cancel-comment-reply-link" href="#respond" style="display:none;">取消回复</a>
                </small>
            </h3>
            <form action="<?php $this->commentUrl() ?>" method="post" id="comment-form" class="comment-form" novalidate>
                <p class="comment-notes">
                    <span id="email-notes">您的邮箱地址不会被公开。</span>
                    <span class="required-field-message">必填项已用 <span class="required">*</span> 标注</span>
                </p>
                <p class="comment-form-comment">
                    <label for="textarea">评论 <span class="required">*</span></label>
                    <textarea id="textarea" name="text" cols="45" rows="8" maxlength="65525" required><?php $this->remember('text'); ?></textarea>
                </p>
                <?php if($this->user->hasLogin()): ?>
                    <p>登录身份: 
                        <a href="<?php $this->options->profileUrl(); ?>">
                            <?php $this->user->screenName(); ?>
                        </a>. 
                        <a href="<?php $this->options->logoutUrl(); ?>" title="Logout">退出 &raquo;</a>
                    </p>
                <?php else: ?>
                    <p class="comment-form-author">
                        <label for="author">显示名称 <span class="required">*</span></label>
                        <input id="author" name="author" type="text" value="<?php $this->remember('author'); ?>" size="30" maxlength="245" autocomplete="name" required />
                    </p>
                    <p class="comment-form-email">
                        <label for="mail">邮箱 <span class="required">*</span></label>
                        <input id="mail" name="mail" type="email" value="<?php $this->remember('mail'); ?>" size="30" maxlength="100" aria-describedby="email-notes" autocomplete="email" required />
                    </p>
                    <p class="comment-form-url">
                        <label for="url">网站</label>
                        <input id="url" name="url" type="url" value="<?php $this->remember('url'); ?>" size="30" maxlength="200" autocomplete="url" />
                    </p>
                    <p class="comment-form-cookies-consent">
                        <input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes" checked />
                        <label for="wp-comment-cookies-consent">在此浏览器中保存我的显示名称、邮箱地址和网站地址，以便下次评论时使用。</label>
                    </p>
                <?php endif; ?>
                <p class="form-submit">
                    <input name="submit" type="submit" id="submit" class="submit" value="发表评论" />
                    <?php $security = $this->security->getToken($this->request->getReferer()); ?>
                    <input type="hidden" name="_" value="<?php echo $security; ?>" />
                </p>
            </form>
        </div>
    <?php endif; ?>
</div>

<?php
function threadedComments($comments, $options) {
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' bypostauthor';
        } else {
            $commentClass .= ' byuser';
        }
    }
    
    $depth = $comments->levels + 1;
    $commentClass .= ' depth-' . $depth;
    if ($depth % 2 == 0) {
        $commentClass .= ' even';
    } else {
        $commentClass .= ' odd alt';
    }
    
    if ($comments->levels == 0) {
        $commentClass .= ' thread-even';
    } else {
        $commentClass .= ' thread-odd thread-alt';
    }
    ?>
    <li class="comment <?php echo $commentClass; ?>" itemtype="http://schema.org/Comment" data-id="<?php $comments->theId(); ?>" itemscope="" itemprop="comment" id="comment-<?php $comments->theId(); ?>">
        <div class="comment--block">
            <div class="comment--info">
                <div class="comment--avatar">
                    <?php echo $comments->gravatar('42', ''); ?>
                </div>
                <div class="comment--meta">
                    <div class="comment--author" itemprop="author">
                        <?php if ($comments->url): ?>
                            <a href="<?php echo $comments->url ?>" class="url" rel="ugc external nofollow"><?php echo $comments->author; ?></a>
                        <?php else: ?>
                            <?php echo $comments->author; ?>
                        <?php endif; ?>
                        <span class="comment-reply-link" onclick="return TypechoComment.reply('comment-<?php $comments->theId(); ?>', <?php $comments->theId(); ?>);">回复</span>
                    </div>
                    <div class="comment--time humane--time" itemprop="datePublished" datetime="<?php $comments->date('c'); ?>">
                        <?php $comments->date('n 月 j,Y'); ?>
                    </div>
                </div>
            </div>
            <div class="comment--content comment-content" itemprop="description">
                <?php if ($comments->parent) { ?>
                    <p><a href="#comment-<?php echo $comments->parent; ?>" class="comment--parent__link">@<?php echo getAuthorFromCoid($comments->parent); ?></a><?php $comments->content(); ?></p>
                <?php } else { ?>
                    <?php $comments->content(); ?>
                <?php } ?>
            </div>
        </div>
        <?php if ($comments->children) { ?>
            <ol class="children">
                <?php $comments->threadedComments($options); ?>
            </ol>
        <?php } ?>
    </li>
    <?php
}

function getAuthorFromCoid($coid) {
    $db = Typecho_Db::get();
    $comment = $db->fetchRow($db->select()->from('table.comments')->where('coid = ?', $coid));
    return $comment ? $comment['author'] : '';
}
?>