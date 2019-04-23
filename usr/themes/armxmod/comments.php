<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div id="comments">

<?php if($this->options->isyiyan == '1' && $this->is('post')): ?>
    <h3 class="box-label"><span class="label-left"></span><span class="box-name">发现共鸣</span></h3>
    <div class="post-yiyan card">
      <span class="text-muted letterspacing indexWords">加载中……</span>
    </div>
<?php endif;?>

    <?php $this->comments()->to($comments); ?>
    <?php if($this->allow('comment')): ?>
<?php if(allowcomment()):?>
    <div id="<?php $this->respondId(); ?>" class="respond">
        <div class="cancel-comment-reply">
            <a id="cancel-comment-reply-link" data-href="<?php echo $this->parameter->parentContent['permalink'] . '#' . $this->parameter->respondId;?>" rel="nofollow" style="display:none;" onclick="return TypechoComment.cancelReply();">取消回复</a>
        </div>
    
        <h3 id="response" class="box-label"><span class="label-left"></span><span class="box-name">发表评论</span></h3>
        <div class="card response-form emoji">
        <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
            <?php if($this->user->hasLogin()): ?>
            <div class="form-item form-loginfo">欢迎您，<a target="_blank" data-no-instant href="<?php $this->options->profileUrl(); ?>" rel="nofollow"><?php $this->user->screenName(); ?></a>，<a data-no-instant href="<?php $this->options->logoutUrl(); ?>" title="退出登录" rel="nofollow"><i class="fa fa-sign-out"></i></a></div>
            <?php else: ?>
            <div class="form-item">
                <label for="comment-author">昵称<span class="required">*</span>：</label><input type="text" name="author" placeholder="姓名或昵称" id="comment-author" class="text" value="<?php $this->remember('author'); ?>" required />
            </div>
            <div class="form-item">
                <label for="comment-mail">邮箱<span class="required">*</span>：</label><input type="email" placeholder="邮箱（接收回复，将保密）" name="mail" id="mail" class="text" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
            </div>
           <div class="form-item">
             <label for="comment-url">网址&nbsp;&nbsp;：</label><input id="url" class="text" name="url" type="url" value="<?php $this->remember('url'); ?>" placeholder="网站或博客"></div>
            <?php endif; ?>
           <div class="form-item form-textarea">
               <div><textarea rows="8" placeholder="不要做一个默默无闻的聆听者，期待你的回应 O(∩_∩)O~~" name="text" id="comment-text" class="textarea" required ><?php $this->remember('text'); ?></textarea>
</div>
           </div>     
           <div class="form-emoji" id="form-emoji">

<?php if(isset($this->options->plugins['activated']['Smilies'])): ?>
             <button id="smilies" class="smiles" type="button">
		<i class="fa fa-smile-o"></i>
	     </button>
<div class="smilies-list" id="smilies-list">
<div class="smiles-sidebar" style="display:none" id="smiles-sidebar">
	<div class="smiles-widget smiles-widget-tab" id="smiles-widget">
		<input type="radio" name="smiles-widget-tab" id="new" checked="checked"/>
		<input type="radio" name="smiles-widget-tab" id="hot"/>
		<input type="radio" name="smiles-widget-tab" id="random"/>
		<div class="smiles-widget-title smiles-inline-ul">
			<ul>
				<li class="smiles-new">
					<label for="new">QQ</label>
				</li>
				<li class="smiles-hot">
					<label for="hot">颜文字</label>
				</li>
				<li class="smiles-random">
					<label for="random">阿鲁</label>
				</li>
			</ul>
		</div>
		<div class="smiles-widget-box">
			<ul class="new-list">
				<li><?php  Smilies_Plugin::output(); ?>
				</li>
			</ul>
			<ul class="hot-list">
				<li>

                    <a href="javascript:grin('OωO')" title="DIYgod">OωO</a>
                    <a href="javascript:grin('|´・ω・)ノ')" title="Hi">|´・ω・)ノ</a>
                    <a href="javascript:grin('ヾ(≧∇≦*)ゝ')" title="开心">ヾ(≧∇≦*)ゝ</a>
                    <a href="javascript:grin('(☆ω☆)')" title="星星眼">(☆ω☆)</a>
                    <a href="javascript:grin('￣﹃￣')" title="流口水">￣﹃￣</a>
                    <a href="javascript:grin('(/ω＼)')" title="捂脸">(/ω＼)</a>
                    <a href="javascript:grin('∠( ᐛ 」∠＿')" title="给跪">∠( ᐛ 」∠)＿</a>
                    <a href="javascript:grin('(๑•̀ㅁ•́ฅ)')" title="Hi">(๑•̀ㅁ•́ฅ)</a>
                    <a href="javascript:grin('→_→')" title="斜眼">→_→</a>
                    <a href="javascript:grin('୧(๑•̀⌄•́๑)૭')" title="加油">୧(๑•̀⌄•́๑)૭</a>
                    <a href="javascript:grin('٩(ˊᗜˋ*)و')" title="有木有WiFi">٩(ˊᗜˋ*)و</a>
                    <a href="javascript:grin('(ノ°ο°)ノ')" title="前方高能预警">(ノ°ο°)ノ</a>
                    <a href="javascript:grin('(´இ皿இ｀)')" title="我从未见过如此厚颜无耻之人">(´இ皿இ｀)</a>
                    <a href="javascript:grin('⌇●﹏●⌇')" title="吓死宝宝惹">⌇●﹏●⌇</a>
                    <a href="javascript:grin('(ฅ´ω`ฅ)')" title="已阅留爪">(ฅ´ω`ฅ)</a>
                    <a href="javascript:grin('(╯°A°)╯︵○○○')" title="去吧大师球">(╯°A°)╯︵○○○</a>
                    <a href="javascript:grin('φ(￣∇￣o)')" title="太萌惹">φ(￣∇￣o)</a>
                    <a href="javascript:grin('ヾ(´･ ･｀｡)ノ')" title="咦咦咦">ヾ(´･ ･｀｡)ノ</a>
                    <a href="javascript:grin('(ó﹏ò｡)')" title="我受到了惊吓">(ó﹏ò｡)</a>
                    <a href="javascript:grin('Σ(っ °Д °;)っ')" title="什么鬼">Σ(っ °Д °;)っ</a>
                    <a href="javascript:grin('╮(╯▽╰)╭ ')" title="无奈">╮(╯▽╰)╭ </a>
                    <a href="javascript:grin('＞﹏＜')" title="">＞﹏＜</a>
                    <a href="javascript:grin('(｡•ˇ‸ˇ•｡')" title="">(｡•ˇ‸ˇ•｡)</a>

				</li>
			</ul>
			<ul class="random-list">
				<li>
<?php if(isset($this->options->plugins['activated']['Alu'])): ?>
<?php  Alu_Plugin::output(); ?>
<?php endif; ?>
				</li>
			</ul>
		</div>
	</div>
</div>
</div>  
<?php endif; ?>

           </div> 
            <a class="submit action-btn" data-action="form.submit@comment-form:comment" href="javascript:;">发表</a>
        </form>
        </div>
    </div>
    <?php else: ?>
   <!-- <h3><?php _e('暂停评论'); ?></h3>-->
<?php endif; ?>
<?php endif; ?>
    <?php if ($comments->have()): ?>
<div class="box">
	<h3 class="box-label"><span class="label-left"></span><span class="box-name"><?php $this->commentsNum(_t('精选评论'), _t('精选评论'), _t('精选评论')); ?></span></h3>
    <div class="card select-comment">
    <?php $comments->listComments(); ?>
    <?php $comments->pageNav('上一页', '下一页'); ?>
    </div>
</div>
    <?php endif; ?>
</div>
