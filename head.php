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