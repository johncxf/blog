<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php
    $options = Typecho_Widget::widget('Widget_Options');
    define("THEME_URL", rtrim(preg_replace('/^'.preg_quote($options->siteUrl, '/').'/', $options->rootUrl.'/', $options->themeUrl, 1),'/'));
?>

<!DOCTYPE HTML>
<html class="no-js" lang="zh-cmn-Hans">
<head>
<meta charset="<?php $this->options->charset(); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<meta name="renderer" content="webkit">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="applicable-device" content="pc,mobile">
<meta name="MobileOptimized" content="width">
<meta name="HandheldFriendly" content="true">
<meta content="always" name="referrer">
  
<title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?> - Learning&Sharing</title>

<meta http-equiv="x-dns-prefetch-control" content="on">
<link rel="dns-prefetch" href="//cdn.bootcss.com/">
<link rel="dns-prefetch" href="//pan.baidu.com" />
<link rel="dns-prefetch" href="//secure.gravatar.com" />
<link rel="dns-prefetch" href="//v1.hitokoto.cn" />

<?php $this->header('generator=&template=&xmlrpc=&wlw=&rss1=&commentReply=&antiSpam='); ?>
<link rel="shortcut icon" href="<?php $this->options->rootUrl(); ?>/favicon.ico">
<link rel="stylesheet" href="<?= THEME_URL ?>/css/style.css">
<link rel="stylesheet" href="<?= THEME_URL ?>/css/font/fonts.css">
<link href="//cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" media="none" onload="if(media!='all')media='all'" />

<link rel="stylesheet" href="<?= THEME_URL ?>/css/jquery.fancybox.min.css" />
<link rel="alternate"  href="<?php $this->options->rootUrl(); ?>" hreflang="zh-Hans" />
<link rel="canonical"  href="<?php if (!($this->is('index'))) : ?><?php $this->permalink() ?><?php else: ?><?php $this->options->rootUrl(); ?><?php endif; ?>" />

<!--[if lt IE 10]>
<script src="<?= THEME_URL ?>/js/compatible.min.js"></script>
<![endif]-->
<!--[if lt IE 9]>
<script src="https://apps.bdimg.com/libs/html5shiv/r29/html5.min.js"></script>
<script src="https://apps.bdimg.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<meta itemprop="name" content="<?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?><?php if ($this->is('index')) : ?> <?php $this->options->titleintro() ?><?php endif; ?>">
<meta itemprop="image" content="<?php $this->options->rootUrl(); ?>/apple-touch-icon.png" />
</head>
<body>
<div id="page">
<header id="header" class="header">
    <div class="container header-container clearfix">
        <a id="logo" class="header-logo" href="<?php $this->options->siteUrl(); ?>"<?php if(!empty($this->options->logoUrl)):?> style="background:url(<?php echo $this->options->logoUrl;?>) no-repeat 0 50%;"<?php endif;?>>
            <h1><?php $this->options->title(); ?></h1>
        </a>
        <a class="menu-switch" id="menu-switch"><i class="fa fa-ellipsis-v headermenu"></i></a>
       <ul class="nav" id="nav">
        <li><a<?php if($this->is('index')){ ?> class="current"<?php } ?> href="<?php $this->options->siteUrl(); ?>"><?php _e('首页'); ?></a></li>
        <li><a href="<?php $this->options->siteUrl(); ?>link.html">朋友圈</a></li>
        <li><a href="<?php $this->options->siteUrl(); ?>cross.html">时光鸡</a></li>
        <li><a href="<?php $this->options->siteUrl(); ?>guestbook.html">留言板</a></li>
        <li class="nav-search"><a href="<?php $this->options->siteUrl(); ?>search.html">搜索</a></li>
        <li><a href="<?php $this->options->siteUrl(); ?>about.html">关于</a></li>
       </ul>

        <div class="toolbar">

        <div class="dropdown">
          <li><a class="dropbtn">发现</a></li>
          <div class="dropdown-content">
               <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
               <?php while($pages->next()): ?>
                  <a href="<?php $pages->permalink(); ?>"><?php $pages->title(); ?></a>
               <?php endwhile; ?>
            <a href="https://blog.vircloud.net/go/vultr/" target="_blank" rel="nofollow">免费主机</a>
            <a href="https://blog.vircloud.net/default/change-theme.html">ArmxMod</a>
         </div>
       </div>
            <div class="search-bar">
              <div class="search-input" id="search-input"><form method="post" action="" id="search"><input autocomplete="off" name="s" type="text" required="required" placeholder="" id="s" value="<?php echo $this->request->filter('url', 'search')->keywords; ?>" /></form></div>
                <a href="<?php $this->options->siteUrl(); ?>search.html" class="search-btn"><i class="fa fa-search"></i></a>
            </div>
            <?php if(!empty($this->options->switchEnable) && in_array('ShowLoginRegister', $this->options->switchEnable)){the_user($this->user, $this->options, $this->request); } ?>
        </div>
    </div>
</header><!-- end #header -->
<div id="body" class="body">
    <div class="container">
        <div class="row">
