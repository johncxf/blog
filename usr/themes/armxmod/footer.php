<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

        </div><!-- end .row -->
    </div>
</div><!-- end #body -->

<footer id="footer" class="footer">
    <div class="container">&copy; 2017-<?php echo date('Y'); ?> <a href="//www.vircloud.net/" rel="nofollow">VirCloud,LLC.</a> ALL RIGHTS RESERVED.</div>
    <div class="copyright">POWERED BY <a href="<?php $this->options->rootUrl(); ?>/go/typecho/" target="_blank">TYPECHO</a>. THEME BY <a href="<?php $this->options->rootUrl(); ?>/go/armx/" target="_blank">ARMX</a>. MODIFY BY <a href="https://blog.vircloud.net/default/change-theme.html" target="_blank">VIRCLOUD</a>.</div>
    <div class="footer-line"></div>
    <div class="footer-site"><a href="<?php $this->options->rootUrl(); ?>/sitemap.xml" class="f-site" target="_blank">网站地图</a><a href="<?php $this->options->rootUrl(); ?>/go/home/" class="f-site" target="_blank">主页导航</a><a href="<?php $this->options->rootUrl(); ?>/go/download/" class="f-site" target="_blank">资源下载</a><a href="<?php $this->options->rootUrl(); ?>/ampindex/" class="f-site" target="_blank">移动简版</a><a href="<?php $this->options->rootUrl(); ?>/go/github/" class="f-site" target="_blank">开源项目</a><a href="<?php $this->options->rootUrl(); ?>/feed/" class="f-site" target="_blank" rel="nofollow" id="footer-rss">RSS 订阅</a></div>
    <div class="footer-time">博客低碳服务器已续<span id="htmer_time"><?php uptime(); ?></span>秒

<?php if($this->options->isdonate == '1' && isset($this->options->plugins['activated']['Like'])): ?>
    ，<a data-fancybox data-animation-duration="700" data-src="#animatedModal" href="javascript:;" class="post-like" id="index-shang">给博客 +1s <i class="fa fa-arrow-circle-right"></i></a>
    <div style="display: none;" id="animatedModal" class="animated-modal">
          <h3 class="wxscan"><i class="be be-favorite heart"></i>感谢打赏<i class="be be-favorite heart" aria-hidden="true"></i></h3>
            <p><img src="<?php $this->options->donate_img(); ?>"/></p>
          <h3 class="thanks">微信扫一扫</h3>
    </div>
<?php endif; ?>
    </div>
</footer><!-- end #footer -->

<ul id="scroll">
	<li><a class="scroll-h" title="返回顶部"><i class="fa fa-angle-up"></i></a></li>
<?php if ($this->is('page', 'guestbook') || $this->is('post')): ?>
	<li><a class="scroll-c" title="评论"><i class="fa fa-comment-o"></i></a></li>
<?php endif; ?>
	<li><a class="scroll-b" title="转到底部"><i class="fa fa-angle-down"></i></a></li>
	<li class="gb2-site"><a id="gb2big5" href="javascript:StranBody()" title="繁體"><span>繁</span></a></li>
</ul>

<script type="text/javascript">
window.__onece = <?php echo Typecho_Common::shuffleScriptVar(
          $this->security->getToken($this->request->getRequestUrl())) ?>;
<?php if($this->options->commentsThreaded && $this->is('single')): ?>
var __respondId = '<?php echo $this->respondId;?>';
  (function () {
      window.TypechoComment = {
          currentParent: null,
          dom : function (id) {
              return document.getElementById(id);
          },
      
          create : function (tag, attr) {
              var el = document.createElement(tag);
          
              for (var key in attr) {
                  el.setAttribute(key, attr[key]);
              }
          
              return el;
          },

          reply : function (cid, coid) {
              var comment = this.dom(cid), parent = comment.parentNode,
                  response = this.dom(__respondId), input = this.dom('comment-parent'),
                  form = 'form' == response.tagName ? response : response.getElementsByTagName('form')[0],
                  textarea = response.getElementsByTagName('textarea')[0];

              if (null == input) {
                  input = this.create('input', {
                      'type' : 'hidden',
                      'name' : 'parent',
                      'id'   : 'comment-parent'
                  });

                  form.appendChild(input);
              }

              input.setAttribute('value', coid);

              if (null == this.dom('comment-form-place-holder')) {
                  var holder = this.create('div', {
                      'id' : 'comment-form-place-holder'
                  });

                  response.parentNode.insertBefore(holder, response);
              }
              comment.insertBefore(response, this.dom('comment-clear-'+coid));
              this.dom('cancel-comment-reply-link').style.display = '';
              this.dom('comment-reply-'+coid).style.display = 'none';
              if(null!=this.currentParent){
                this.dom('comment-reply-'+this.currentParent).style.display = '';
              }
              this.currentParent = coid;
              if (null != textarea && 'text' == textarea.name) {
                  textarea.focus();
              }

              return false;
          },

          cancelReply : function () {
              var response = this.dom(__respondId),
              holder = this.dom('comment-form-place-holder'), input = this.dom('comment-parent');

              if (null != input) {
                  input.parentNode.removeChild(input);
              }

              if (null == holder) {
                  return true;
              }

              this.dom('cancel-comment-reply-link').style.display = 'none';
              if(null!=this.currentParent){
                this.dom('comment-reply-'+this.currentParent).style.display = '';
              }
              this.currentParent = null;
              holder.parentNode.insertBefore(response, holder);
              return false;
          }
      };
  })();
  <?php if ($this->options->commentsAntiSpam && $this->is('single')): ?>
  (function () {
      var event = document.addEventListener ? {
          add: 'addEventListener',
          triggers: ['scroll', 'mousemove', 'keyup', 'touchstart'],
          load: 'DOMContentLoaded'
      } : {
          add: 'attachEvent',
          triggers: ['onfocus', 'onmousemove', 'onkeyup', 'ontouchstart'],
          load: 'onload'
      }, added = false;

      var r = document.getElementById(__respondId),
          input = document.createElement('input');
      input.type = 'hidden';
      input.name = '_';
      input.value = window.__onece;

      if (null != r) {
          var forms = r.getElementsByTagName('form');
          if (forms.length > 0) {
              function append() {
                  if (!added) {
                      forms[0].appendChild(input);
                      added = true;
                  }
              }
          
              for (var i = 0; i < event.triggers.length; i ++) {
                  var trigger = event.triggers[i];
                  document[event.add](trigger, append);
                  window[event.add](trigger, append);
              }
          }
      }
  })();
  <?php endif;?>

  <?php if($replyId = $this->request->filter('int')->replyTo): ?>
    TypechoComment.reply('comment-<?php echo $replyId;?>', <?php echo $replyId;?>);
  <?php endif;?>
<?php endif;?>
</script>

</div> <!-- end #page-->
<script type="text/javascript" data-no-instant="true" src="//cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
<?php
  $this->footer();
  $switchEnablePjax = !empty($this->options->switchEnable) && in_array('enablePjax', $this->options->switchEnable);
  $switchEnablePlayer = !empty($this->options->switchEnable) && in_array('ShowMusicPlayer', $this->options->switchEnable);
?>
<script type="text/javascript" data-no-instant="true" src="https://apps.bdimg.com/libs/highlight.js/9.1.0/highlight.min.js"></script>
<?php if($switchEnablePjax):?><script type="text/javascript" data-no-instant="true" src="<?= THEME_URL ?>/js/instantclick.js"></script><?php endif; ?>
<script type="text/javascript" data-no-instant="true" src="<?= THEME_URL ?>/js/main.js"></script>  
<script type="text/javascript" src="<?= THEME_URL ?>/js/gb2big5.js"></script>
<script type="text/javascript" src="<?= THEME_URL ?>/js/jquery.fancybox.min.js"></script>
<?php if($this->options->lazyimg == '1'): ?>
<script type="text/javascript" data-no-instant="true" src="<?= THEME_URL ?>/js/lazyload.js"></script>
<?php endif;?>
<script type="text/javascript" src="<?= THEME_URL ?>/js/script.js"></script>
<?php if($this->options->lazyimg == '1'): ?>
<script>imgLazyLoad('.article-content img');</script>
<?php endif;?>
<script type="text/javascript" data-no-instant="true" src="<?= THEME_URL ?>/js/commentTyping.js"></script>
<script type="text/javascript">
</script>
<script type="text/javascript" data-no-instant="true">
<?php if( $switchEnablePjax ):?>
/**
 * InstantClick
 */
if(InstantClick && InstantClick.supported){
  InstantClick.expire(43200*1000); // 设置缓存时间12h
  InstantClick.content('page');
  InstantClick.on('change', function(init){
    !init && pageInit();
  });
  InstantClick.init('mousedown');
}
<?php endif;?>
pageInit();


</script>
</body>
</html>
