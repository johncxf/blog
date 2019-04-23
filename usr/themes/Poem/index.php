<?php
/**
 * 大气响应式typecho主题Poem
 * @package Poem 
 * @author wuyanlong.com
 * @version 1.0
 * @link http://wuyanlong.com
 */
 $this->need('header.php');?>
 <section class="hero accent parallax" style="background-image: url(<?php $this->options->themeUrl('images/parallax.png'); ?>);">
		<div class="hero-content container">
			<p>你是我丰收时的盗贼——我是你翅膀上的枷锁</p>
			<h2>追随文学的脚步从未停止</h2>
		</div>
		<div class="sub-hero container">
			<span class="line"></span>
			<a href="http://www.wuyanlong.com/index.php/category/sg/" class="button white">开始阅读</a>
		</div>
        </section>
<div class="content container">
    <div class="row">
        <div class="col-sm-8">
            <?php if ($this->have()): ?>
            <?php while($this->next()): ?>
            <div class="post image">	<span class="date"><?php $this->date('d'); ?><br><small><?php $this->date('M'); ?></small></span>
                <div class="post-title">
                    <h2><a itemtype="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
                </div>
                <div class="post-body">
                    <p>
                        <?php $this->content('阅读全文&raquo;'); ?></p>
                </div>
            </div>
            <?php endwhile; ?>
            <?php else: ?>
            <div class="post image">
                <h3 class="post-title"><?php _e('没有找到内容'); ?></h3>
            </div>
            <?php endif; ?>
            <div class="type-post" id="pagination">
                <?php $this->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?></div>
        </div>
        <?php $this->need('sidebar.php'); ?></div>
</div>
</div>
 <?php $this->need('footer.php'); ?>