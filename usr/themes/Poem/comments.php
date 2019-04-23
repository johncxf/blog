<?php function threadedComments($comments, $options) {
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }
 
    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
?>
 
<li id="li-<?php $comments->theId(); ?>" class="comment-body<?php 
if ($comments->levels > 0) {
    echo ' comment-child';
    $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
} else {
    echo ' comment-parent';
}
$comments->alt(' comment-odd', ' comment-even');
echo $commentClass;
?>">
    <div id="<?php $comments->theId(); ?>" class="clearfix">
        <div class="comment-author">
            <?php $comments->gravatar('50', ''); ?>  
        </div>
        <div class="comment-meta">
             <div class="fn"><?php $comments->author(); ?></div>
            <?php $comments->content(); ?>
            <span class="comment-time"><?php _e('时间: '); ?><?php $comments->date('Y-m-d \a\t H:i'); ?></span> <span class="comment-reply"><?php $comments->reply(); ?></span>
           
        </div>

    </div>
    <?php if ($comments->children) { ?>
        <div class="comment-children">
            <?php $comments->threadedComments($options); ?>
        </div>
    <?php } ?>
</li>
<?php } ?>
<div id="comments" class="comments">
    <?php $this->comments()->to($comments); ?>
    <?php if ($comments->have()): ?>
	<h2><?php $this->commentsNum(_t('暂无评论'), _t('仅有 1 条评论'), _t('已有 %d 条评论')); ?></h2>
    
    <?php $comments->listComments(); ?>

    <?php $comments->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
    
    <?php endif; ?>

    <?php if($this->allow('comment')): ?>
    <div id="<?php $this->respondId(); ?>" class="comments">
        <div class="cancel-comment-reply">
        <?php $comments->cancelReply(); ?>
        </div>
     <div id="respond">
    	<h2 id="response"><?php _e('添加新评论'); ?></h2>
    	<form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
            <?php if($this->user->hasLogin()): ?>
    		<p><?php _e('登录身份：'); ?><a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>. <a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a></p>
            <?php else: ?>
    		<div class="form-field col-sm-6">
                <label for="author" class="required"><?php _e('称呼'); ?></label>
    			<span><input type="text" name="author" id="author" class="text" value="<?php $this->remember('author'); ?>" required /></span>
    		</div>
    		<div class="form-field col-sm-6">
                <label for="mail"<?php if ($this->options->commentsRequireMail): ?> class="required"<?php endif; ?>><?php _e('Email'); ?></label>
    			<span><input type="email" name="mail" id="mail" class="text" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> /></span>
    		</div>
    		<div class="form-field col-sm-6">
                <label for="url"<?php if ($this->options->commentsRequireURL): ?> class="required"<?php endif; ?>><?php _e('网站'); ?></label>
    			<span><input type="url" name="url" id="url" class="text" placeholder="<?php _e('http://'); ?>" value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> /></span>
    		</div>
            <?php endif; ?>
    		<div class="form-field col-sm-12">
                <label for="textarea" class="required"><?php _e('内容'); ?></label>
                <span><textarea rows="8" cols="50" name="text" id="textarea" class="textarea" required ><?php $this->remember('text'); ?></textarea></span>
            </div>
    		<div class="form-field col-sm-12">
               <span><input type="submit" name="submit" value="Send it" id="submit"></span>
            </div>
    	</form>
        </div>
    </div>
    <?php else: ?>
    <h3><?php _e('评论已关闭'); ?></h3>
    <?php endif; ?>
</div>
