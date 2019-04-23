<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php 

// 获取音频地址
if ($this->request->isAjax() && $this->request->is('do=getSpeech')) {
    $this->response->throwJson([
        'data' => text2speech($this->cid)
    ]);
}

$this->need('header.php'); 

?>

<div id="main" class="main">
    <article class="article">
    <div class="article-box card">
        <h1 class="article-title" ><?php $this->title() ?> 
           <?php if($this->user->hasLogin()):?>
             <a class="superscript" href="<?php Helper::options()->adminUrl()?>write-post.php?cid=<?=$this->cid ?>" target="_blank"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
           <?php endif?>
        </h1>
        <div class="article-meta">
            <a class="meta-item meta-author" href="<?php $this->author->permalink(); ?>" rel="author" title="本文作者"><i class="fa fa-user-o text-muted"></i>作者: <?php $this->author(); ?></a>
            <span class="meta-item" title="发表日期"><i class="fa fa-clock-o text-muted"></i>发表: <?php $this->date('Y/m/d H:i'); ?></span>
            <span class="meta-item m-none" title="文章分类"><i class="fa fa-folder-open-o text-muted"></i>分类：<?php $this->category('，'); ?></span>
            <span class="meta-item m-none" title="评论次数"><i class="fa fa-comments-o text-muted"></i>评论:<a href="#comments"> <?php $this->commentsNum('0', '1', '%d'); ?> 条</a></span>
            <span class="meta-item m-none" title="浏览次数"><i class="fa fa-eye text-muted"></i>浏览: <?php get_post_view($this) ?> 次</span>
<?php if(isset($this->options->plugins['activated']['Like'])): ?>
            <span class="meta-item m-none" title="点赞次数"><i class="fa fa-thumbs-up text-muted"></i>喜欢: <a href="#shang-like"><?php Like_Plugin::theLike($link = false); ?>人</a></span>
<? endif; ?>
        </div>
        <?php if ($this->options->text2speech): ?>
           <?php if($this->fields->read !=('N'||'n'||'no'||'NO'||'nO'||'No') && readable($this)): ?>
            <div id="post-text2speech" class="post__text2speech" title="用声音感受世界">
                <i class="icon"></i>
                <span id="post-text2speech-text" class="text">小助手读文章</span>
                <span id="post-text2speech-time" class="time">00:00 / 00:00</span>
                <span id="post-text2speech-progress" class="progress"></span>
            </div>
           <?php endif; ?>
        <?php endif; ?>
        <div class="article-content" id="article-content">
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

        <div class="article-extend card">
         <?php if($this->tags):?>
           <p class="tag-title share"><i class="fa fa-share-square-o"></i>&nbsp;分享给好友：<span class="extend-share">
           <a title="分享到空间" rel="nofollow" class="be be be-qzone" href="//connect.qq.com/widget/shareqq/index.html?url= <?php $this->permalink() ?>&title=<?php $this->title() ?>&pics=<?php $this->options->rootUrl(); ?>/favicon.png&desc=这篇文章写的不错，推荐看看&summary=<?php $this->excerpt(65, '......'); ?>&site=<?php $this->options->siteUrl(); ?>" target="_blank" onclick="window.open(this.href, 'qzone-share', 'width=745,height=660');return false;"></a>
           <a title="分享到微博" rel="nofollow" class="be be-stsina" href="//service.weibo.com/share/share.php?url=<?php $this->permalink() ?>&pic=<?php $this->options->rootUrl(); ?>/favicon.png&title=<?php $this->title() ?>_<?php $this->options->title(); ?>" target="_blank" onclick="window.open(this.href, 'weibo-share', 'width=650,height=475');return false;"></a>
           <a title="分享到 QQ" rel="nofollow" class="be be-qq" href="//connect.qq.com/widget/shareqq/index.html?url=<?php $this->permalink() ?>&pics=<?php $this->options->rootUrl(); ?>/favicon.png&title=<?php $this->title() ?>_<?php $this->options->title(); ?>&summary=<?php $this->excerpt(65, '......'); ?>=" target="_blank" onclick="window.open(this.href, 'qq-share', 'width=745,height=660');return false;"></a>
           <a data-fancybox="" rel="nofollow" data-animation-duration="700" data-src="#animatedModal2" href="javascript:;" class="weixin"><i class="be be-weixin"></i></a>
    </span></p>
           <p class="tag-title continue"><i class="fa fa-forward"></i>&nbsp;继续浏览关于 <span class="tag-list"><?php $this->tags('', true, ''); ?> </span>的文章</p>
           <p class="tag-title update"><i class="fa fa-clock-o"></i>&nbsp;本文最后更新于：<span class="extend-date"><?php echo date('Y/m/d H:i:s', $this->modified); ?><span class="mianbaoxie">，可能因经年累月而与现状有所差异</span>。</span></p>
           <p class="tag-title warning"><i class="fa fa-copyright"></i>&nbsp;引用转载请注明：<span class="mianbaoxie"><a href="<?php $this->options->rootUrl(); ?>" class="yinyong"><?php $this->options->title(); ?></a> » <?php $this->category(','); ?> » </span><a href="<?php $this->permalink() ?>" class="yinyong"><?php $this->title() ?></a> </p>
          <div style="display: none;" id="animatedModal2" class="animated-modal">
          <h3 class="wxscan">跨屏阅读</h3>
            <div class="wxscanimg"><p class="wxloading"><img src="" data-original="//pan.baidu.com/share/qrcode?w=250&h=250&url=<?php $this->permalink(); ?>"></p></div>
          <h3 class="thanks">微信扫一扫</h3>
</div>
         <?php endif;?>
        </div>

    </article>


    <ul class="post-near">
    <?php $this->thePrev('<li class="post-prev">%s</li>','',['title'=>'上一篇','tagClass'=>'post-near-label']); ?>
    <?php $this->theNext('<li class="post-next">%s</li>','',['title'=>'下一篇','tagClass'=>'post-near-label']); ?>
    </ul>


    <?php $this->need('comments.php'); ?>


</div><!-- end #main-->

<?php $this->need('sidebar.php'); ?>
<div class="template-post"></div>
<?php $this->need('footer.php'); ?>
