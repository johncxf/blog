<?php $this->need('header.php'); ?>
<section class="hero small accent parallax" style="background-image: url(<?php $this->options->themeUrl('images/parallax.png'); ?>);">
    <div class="hero-content container" style="margin-top: 279.5px;">
        <h1><?php $this->archiveTitle(array(
            'category'  =>  _t('%s'),
            'search'    =>  _t('包含"%s"'),
            'tag'       =>  _t('标签"%s"'),
            'author'    =>  _t('%s')
        ), '', ''); ?></h1>
    </div>
    <div class="sub-hero container">	<span class="line"></span>
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