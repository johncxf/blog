<?php 
/**
* 友情链接
*
* @package custom
*/
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>

<div id="main" class="main">
  <h3 class="box-label"><span class="label-left"></span><span class="box-name"><?php $this->title() ?></span></h3>
    <article class="article">
    <div class="article-box card">
        <div class="article-content">
         <p class="">
         <strong>欢迎交换友链！</strong><br>
         要求：<br />
         1、文章以原创内容为主，且内容健康；<br />
         2、请先在贵站做好本站的友情链接：<br />
       &emsp;&emsp;链接文字：<code>VirCloud's Blog</code><br />
       &emsp;&emsp;链接地址：<code>https://blog.vircloud.net/</code><br />
       &emsp;&emsp;链接描述：<code>Learning & Sharing</code><br />
         </p>
<div class="line"></div>
<div class="links">
  <ul>
   <?php 
    $mypattern = '
    <li>
     <a href="{url}" target="_blank" data-no-instant rel="nofollow"><span class="sitename">{name}</span><div class="linkdes">{title}</div></a>
    </li>'."\n"; 
    Links_Plugin::output($mypattern, 0, "one"); ?>
  </ul>
</div>
        </div>
    </div>
    </article>
<?php $this->need('comments.php'); ?>
</div>

<?php $this->need('sidebar.php'); ?>
<div class="template-links"></div>
<?php $this->need('footer.php'); ?>

	