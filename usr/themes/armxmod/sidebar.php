<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="sidebar" id="sidebar" role="sidebar">


<?php if($this->options->isabout == '1'): ?>
    <?php if ($this->is('single')): $this->related(6)->to($relatedPosts);?>
        <?php if($relatedPosts->have()): ?>
            <section class="widget" id="tabs-related">
                <h3 class="box-label"><span class="label-left"></span><span class="box-name">相关文章</span></h3>
                <div class="card widget-box">
                <ul class="widget-list">
                <?php $i = 0; while($relatedPosts->next()): ?>
                    <li class="recent recent-<?php echo $i;?> redash"><a href="<?php $relatedPosts->permalink();?>" title="<?php $relatedPosts->title();?>"><span class="recent-title"><i class="fa fa-fire likepost"></i><?php $relatedPosts->title();?></span></a></li>
                <?php $i++; endwhile; ?>
                </ul>
                </div>
            </section>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>


    <section class="widget" id="tabs-recom">
        <h3 class="box-label"><span class="label-left"></span><span class="box-name">主机推荐</span></h3>
        <div class="card widget-box">
        <div class="widget-list clearfix">
       <ul class="list-group">
        <li class="list-group-item"> <a href="https://blog.vircloud.net/go/vultr/" target="_blank" title="通过此邀请注册 Vultr 可享受充值 $10 立赠 $25 (可开一年 VPS)"> <img src="<?= THEME_URL ?>/img/vultr2.jpg" class="recommend" alt="Vultr Offer"></a></li><hr>
        <li class="list-group-item"> <a href="https://blog.vircloud.net/go/cloudcone/" target="_blank"  title="通过此邀请注册可购买 CloudCone 专属特价 ￥70/年的高性价比 VPS"> <img src="<?= THEME_URL ?>/img/cloudcone2.jpg" class="recommend" alt="CloudCone Offer"></a></li>
       </ul>
        </div>
        </div>
    </section>


<?php if($this->options->isstat == '1'): ?>
  <?php if ($this->is('index')) : ?>
    <?php $stat = Typecho_Widget::widget('Widget_Stat'); ?>
    <section id="tabs-sum" class="widget">   
     <h3 class="box-label"><span class="label-left"></span><span class="box-name">网站概况</span></h3>
     <div class="card widget-box">
      <div class="widget-list clearfix">
       <ul class="list-group">
       <?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
       <?php _e('<li class="list-group-item"><span class="badge"><i class="fa fa-clipboard likepost"></i>发表文章：<span class="badge-num">%s 篇</span></span></li><li class="list-group-item"><span class="badge"><i class="fa fa-folder-open likepost"></i>分类目录：<span class="badge-num">%s 个</span></span></li><li class="list-group-item"><span class="badge"><i class="fa fa-tags likepost"></i>文章标签：<span class="badge-num">%s 个</span></span></li><li class="list-group-item"><span class="badge"><i class="fa fa-comments likepost"></i>评论留言：<span class="badge-num">%s 条</span></span></li><li class="list-group-item"><span class="badge"><i class="fa fa-eye likepost"></i>浏览总量：<span class="badge-num">%s 次</span></span></li><li class="list-group-item"><span class="badge"><i class="fa fa-link likepost"></i>友情链接：<span class="badge-num">%s 个</span></span></li>', $stat->publishedPostsNum, $stat->categoriesNum, $stat->tagsNum, $stat->publishedCommentsNum, $stat->viewsNum, $stat->linksNum); ?>

        <li class="list-group-item"><span class="badge"><i class="fa fa-clock-o likepost"></i>网站运行：<span class="badge-num"><?php uptimed(); ?> 天</span></span></li> 

<?php if ($this->is('page')): ?>
<?php else: ?>
<?php 
	$recent = $this->widget('Widget_Contents_Post_Recent','pageSize=1');
	if($recent->have()):
          while($recent->next()):
?> 
        <li class="list-group-item"><span class="badge"><i class="fa fa-pencil-square likepost"></i>最后更新：<span class="badge-num"><?php echo date('Y 年 m 月 d 日', $recent->modified);?></span></span></li> 
<?php endwhile; endif;?>
<?php endif;?>
      </ul>
     </div>
    </div>
   </section>
<?php endif; ?>

<?php if($this->options->istags == '1'): ?>
<?php $this->widget('Widget_Metas_Tag_Cloud', 'sort=mid&ignoreZeroCount=1&desc=0&limit=18')->to($tags); ?>
<?php if($tags->have()): ?>
    <section class="widget" id="tabs-label">
        <h3 class="box-label"><span class="label-left"></span><span class="box-name">热门标签</span></h3>
        <div class="card widget-box">
        <div class="widget-list widget-tags-list clearfix">
        <?php while($tags->next()): ?>
            <a href="<?php $tags->permalink(); ?>" rel="tag" class="size-<?php $tags->split(5, 10, 20, 30); ?>" title="<?php $tags->count(); ?> 篇文章"><?php $tags->name(); ?></a>
        <?php endwhile; ?>
        <div style="clear:both; height:0; overflow:hidden; width:100%;"></div>
        </div>
        </div>
    </section>
<?php endif; ?>
<?php endif; ?>
<?php endif;?>

<?php if($this->options->isrecommend == '1'): ?>
  <?php if (!$this->is('post') && !$this->is('page','cross')):$this->widget('Widget_Contents_Post_Recent')->to($recent); ?>
    <section id="tabs-recomp" class="widget">
	<h3 class="box-label"><span class="label-left"></span><span class="box-name">随机看看</span></h3>
        <div class="card widget-box">
        <ul class="widget-list">
          <?php theme_random_posts($this);?>
        </ul>
        </div>
    </section>
 <?php endif; ?>
<?php endif; ?>


    <section class="widget">
    </section>

    <?php if ($this->is('single')): ?>
        <section class="widget">   
            <div id="article-index"></div>
        </section>
    <?php endif; ?>

</div><!-- end #sidebar -->
