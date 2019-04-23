<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div id="main" class="main">
    <article class="article">
    <div class="article-box card">
        <h1 class="article-title" ><?php $this->title() ?>
           <?php if($this->user->hasLogin()):?>
             <a class="superscript" href="<?php Helper::options()->adminUrl()?>write-page.php?cid=<?=$this->cid ?>" target="_blank"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
           <?php endif?>
        </h1>
        <div class="article-meta">
            <a class="meta-item meta-author" href="<?php $this->author->permalink(); ?>" rel="author" title="本文作者"><i class="fa fa-user-o text-muted"></i>作者: <?php $this->author(); ?></a>
            <span class="meta-item" title="发表日期"><i class="fa fa-clock-o text-muted"></i>发表: <?php $this->date('Y/m/d H:i'); ?></span>
            <span class="meta-item" title="评论次数"><i class="fa fa-comments-o text-muted"></i>评论:<a href="#comments"> <?php $this->commentsNum('0', '1', '%d'); ?> 条</a></span>
            <span class="meta-item" title="浏览次数"><i class="fa fa-eye text-muted"></i>浏览: <?php get_post_view($this) ?> 次</span>
<?php if(isset($this->options->plugins['activated']['Like'])): ?>
            <span class="meta-item" title="点赞次数"><i class="fa fa-thumbs-up text-muted"></i>喜欢: <a href="#shang-like"><?php Like_Plugin::theLike($link = false); ?>人</a></span>
<? endif; ?>
        </div>
        <div class="article-content">
                    <?php parseContent($this); ?>
<hr>
        </div>
<?php if($this->options->isdonate == '1'): ?>
<div class="shang-like" id="shang-like">
    <div id="social">
       <div class="social-main" id="social-main">
           <span class="like">
              <?php $all = Typecho_Plugin::export();?>
              <?php if(array_key_exists('Like', $all['activated'])): ?>
                 <?php Like_Plugin::theLike(); ?>
              <?php endif; ?>
           </span>
           <span class="social-notice">如果觉得我的文章对你有用，请随意赞赏</span>
        </div>
<?php if(!empty($this->options->donate_img)): ?>
        <div class="fancybox-slide--current social-main" id="social-shang" style="display: none;">
          <span class="like">
            <a data-fancybox data-animation-duration="700" data-src="#animatedModal" href="javascript:;" class="post-like" id="index-shang">赏</a>
          </span>
            <span class="social-notice">如果觉得我的文章对你有用，请随意赞赏</span>
        </div>
<?php endif; ?>
    </div>
</div>
<?php endif; ?>
    </div>
    </article>
    <?php $this->need('comments.php'); ?>
</div><!-- end #main-->

<?php $this->need('sidebar.php'); ?>
<div class="template-page"></div>
<?php $this->need('footer.php'); ?>
