<?php if (!defined( '__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="col-sm-4">
    <div class="sidebar">
        <div class="widget clearfix">
            <form action="#">
                <input name="s" id="s" type="text" class="search" placeholder="Search.." value="" />
                <input type="submit" value="Go" class="search-submit" />
            </form>
        </div>
        <div class="widget">
            <h5><?php $this->options->title(); ?></h5>
            <div class="textwidget">
                <p><?php $this->options->description() ?></p>
            </div>
        </div>
        <div class="widget">
            <h5>分类</h5>
            <ul>
                <?php $this->widget('Widget_Metas_Category_List') ->parse('
                <li><a href="{permalink}">{name}</a> ({count})</li>'); ?></ul>
        </div>
        <div class="widget widget-archive">
            <h5>最新文章</h5>
            <ul>
                <?php $this->widget('Widget_Contents_Post_Recent')->parse('
                <li><a href="{permalink}">{title}</a>
                </li>'); ?></ul>
        </div>
        <div class="widget widget-archive">
            <h5>最新回复</h5>
            <ul>
               <?php $this->widget('Widget_Comments_Recent')->to($comments); ?>
    <?php while($comments->next()): ?>
        <li><?php $comments->author(false); ?>: <a href="<?php $comments->permalink(); ?>"><?php $comments->excerpt(10, '[...]'); ?></a></li>
    <?php endwhile; ?> 
        </ul>
        </div>
        <div class="widget widget-recent-entries">
            <h5>系统选项</h5>	
            <ul>
                <?php if($this->user->hasLogin()): ?>
                <li class="last"><a href="<?php $this->options->adminUrl(); ?>"><?php _e('进入后台'); ?> (<?php $this->user->screenName(); ?>)</a></li>
                <li class="last"><a href="<?php $this->options->logoutUrl(); ?>">登出(<?php $this->user->screenName(); ?>)</a>
                </li>
                <?php else: ?>
                <li class="last"><a href="<?php $this->options->adminUrl('login.php'); ?>">登录</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>