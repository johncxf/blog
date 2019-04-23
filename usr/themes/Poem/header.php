<!DOCTYPE HTML>
<!--[if IE 8 ]><html class="ie no-js" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<![endif]-->
<!--[if IE 9]> <html class="ie9 no-js" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html  class="no-js" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<!--<![endif]-->
<head>
    <link rel="shortcut icon" href="<?php $this->options->themeUrl('images/favicon.ico'); ?>">
    <link rel="shortcut icon" href="<?php $this->options->themeUrl('images/favicon.png'); ?>">
    <link rel="apple-touch-icon" href="<?php $this->options->themeUrl('images/apple-touch-icon.png'); ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php $this->options->themeUrl('images/apple-touch-icon-72x72.png'); ?>">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php $this->options->themeUrl('images/apple-touch-icon-114x114.png'); ?>">
    <meta charset=""utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>
    <link rel="stylesheet" href="http://cdn.staticfile.org/normalize/2.1.3/normalize.min.css">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/framework.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/style.css'); ?>">
<?php $this->header('generator=&template=&pingback=&xmlrpc=&wlw=&rss1=&rss2=&atom=&commentReply='); ?>
</head>
<body>
	<nav class="mobile">
    <div class="search-trigger"></div>
    <div class="search-form disabled">
       <form action="#">
	<input name="s" id="search" type="text" class="search" placeholder="Search.." value=""/>
    </form>
    </div>
    <ul class="nav-content clearfix">
        <li id="magic-line"></li>
        <li class="upper"><a href="<?php $this->options->siteUrl(); ?>" class="current-page upper">首页</a></li>
        <li class="drop upper">	<a class="drop-btn">分类</a>
            <ul class="drop-list">
                <?php $this->widget('Widget_Metas_Category_List')->to($category); ?> 
                    <?php while($category->next()): ?>
                    <li<?php if($this->is('category', $category->slug)): ?> class="upper" <?php endif; ?>><a href="<?php $category->permalink(); ?>" title="<?php $category->title(); ?>"><?php $category->name(); ?></a></li>
                    <?php endwhile; ?>
            </ul>
        </li>
                <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                        <?php while($pages->next()): ?>
                        <li<?php if($this->is('page', $pages->slug)): ?> class="current-page upper"<?php endif; ?>><a href="<?php $pages->permalink(); ?>"><?php $pages->title(); ?></a></li>
            <?php endwhile; ?>
    </ul>
</nav>
<header class="mobile">
    <a href="<?php $this->options->siteUrl(); ?>">
        <img class="logo" src="<?php $this->options->themeUrl('images/logo.png'); ?>" alt="<?php $this->options->title() ?>" width="96" height="35" />
    </a>
    <button type="button" class="nav-button">
        <div class="button-bars"></div>
    </button>
</header>
<div class="sticky-head"></div>