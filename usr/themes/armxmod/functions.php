<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
define('__LAZYIMG__', 'data:image/gif;base64,R0lGODlhKwAeAJEAAP///93d3Xq9VAAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQFFAAAACwDAA0AJQADAAACEpSPAhDtHxacqcr5Lm416f1hBQAh+QQJFAAAACwDAA0AJQADAAACFIyPAcLtDKKcMtn1Mt3RJpw53FYAACH5BAkUAAAALAMADQAlAAMAAAIUjI8BkL0CoxQtrYrenPjcrgDbVAAAOw==');

/**
 * 主题设置
 * @author NatLiu
 * @date   2018-01-24T14:10:44+0800
 * @param  [type]                   $form [description]
 * @return [type]                         [description]
 */
function themeConfig($form) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, 'https://blog.vircloud.net/usr/themes/armx/img/header-logo.png', _t('站点 LOGO 地址'), _t('在这里填入一个图片 URL 地址, 用于网站头部 LOGO, 尺寸112x55  （注：也可修改主题img/bg.png文件修改logo）'));
    $form->addInput($logoUrl);

    $switchEnable = new Typecho_Widget_Helper_Form_Element_Checkbox('switchEnable', 
    array(
        'ShowLoginRegister' => _t('显示登录注册模块'),
        'enablePjax' => _t('启用全站 Pjax')
    ),
    array('enablePjax'), _t('主题功能开关'));
    
    $form->addInput($switchEnable->multiMode());

    $srcAddress = new Typecho_Widget_Helper_Form_Element_Text('src_add', NULL, '/usr/uploads/', _t('CDN 替换前地址'), _t('即附件存放目录'));
    $form->addInput($srcAddress);
    $cdnAddress = new Typecho_Widget_Helper_Form_Element_Text('cdn_add', NULL, '//tc-gz-1252597704.cosgz.myqcloud.com/uploads/', _t('CDN 完整地址'), _t('即 CDN 存储地址<br />比如附件存放位置是 https://yourblog/uploads/2018/05/1.png，CDN 访问是 https://cdn.com/uploads/1.png，那么替换前地址就是 https://yourblog/uploads/2018/05/，替换后就是 https://cdn.com/uploads/'));
    $form->addInput($cdnAddress);
  
    $isDonate = new Typecho_Widget_Helper_Form_Element_Radio('isdonate',
        array(
            '0' => _t('禁用'),
            '1' => _t('启用')
        ),
        '1',_t('赞赏功能'),_t("是否启用赞赏功能，配合 Like 插件）")
    );    
    $form->addInput($isDonate);
  
    $donateImg =  new Typecho_Widget_Helper_Form_Element_Text('donate_img', NULL, 'https://blog.vircloud.net/usr/themes/handsome/img/weixinpay.png', _t('支付二维码'), _t('建议大小 250x250'));
     $form->addInput($donateImg);
  
    $isAbout = new Typecho_Widget_Helper_Form_Element_Radio('isabout',
        array(
            '0' => _t('禁用'),
            '1' => _t('启用')
        ),
        '1',_t('相关文章'),_t("是否启用侧栏相关文章，仅在文章页显示")
    );    
    $form->addInput($isAbout);
  
    $isRecommend = new Typecho_Widget_Helper_Form_Element_Radio('isrecommend',
        array(
            '0' => _t('禁用'),
            '1' => _t('启用')
        ),
        '1',_t('随机文章'),_t("是否启用侧栏随机文章")
    );    
    $form->addInput($isRecommend);
  
    $isStat = new Typecho_Widget_Helper_Form_Element_Radio('isstat',
        array(
            '0' => _t('禁用'),
            '1' => _t('启用')
        ),
        '1',_t('网站统计'),_t("是否启用侧栏网站统计")
    );    
    $form->addInput($isStat);
  
    $isTags = new Typecho_Widget_Helper_Form_Element_Radio('istags',
        array(
            '0' => _t('禁用'),
            '1' => _t('启用')
        ),
        '1',_t('热门标签'),_t("是否启用侧栏热门标签")
    );    
    $form->addInput($isTags);
  
    $isYiyan = new Typecho_Widget_Helper_Form_Element_Radio('isyiyan',
        array(
            '0' => _t('禁用'),
            '1' => _t('启用')
        ),
        '1',_t('一言'),_t("是否启用评论上方的一言")
    );    
    $form->addInput($isYiyan);
    
  
    $shortcode = new Typecho_Widget_Helper_Form_Element_Radio('shortcode',
        array(
            '0' => _t('禁用'),
            '1' => _t('启用')
        ),
        '1',_t('短代码支持'),_t("是否启用短代码支持")
    );    
    $form->addInput($shortcode);
  
    $text2speech = new Typecho_Widget_Helper_Form_Element_Radio(
        'text2speech',
        array(
            '1' => '开启',
            '0' => '关闭'
        ),
        '1',
        _t('文章语音朗读'),
        _t('是否启用文章语音朗读功能')
    );
    $form->addInput($text2speech);
  
    $baiduBDUSS = new Typecho_Widget_Helper_Form_Element_Text(
        'baiduBDUSS',
        NULL,
        'RXV3NnSUd6cndNfjBJeTQ5RjJwLXdvZlZUbDBlVW44Y2dwMktiTk90T2ZVVGhiQVFBQUFBJCQAAAAAAAAAAAEAAABniHgvuPzQwrj8v-y4~Me~AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAJ~EEFufxBBbTG',
        _t('百度 BDUSS'),
        _t('百度 Cookie 中的 BDUSS，开启语音朗读功能时必须配置，获取方法请看 <a href="https://blog.vircloud.net/default/change-theme.html#article-header-19" target="_blank">主题页说明</a>。')
    );
    $form->addInput($baiduBDUSS);
  
  
    $text2speechSex = new Typecho_Widget_Helper_Form_Element_Radio(
        'text2speechSex',
        array(
            '1' => '普通男声',
            '0' => '普通女声',
            '3' => '情感男声',
            '4' => '情感女声'
        ),
        '4',
        _t('语音朗读合成类型'),
        _t('喜欢男声还是女声？')
    );
    $form->addInput($text2speechSex);
  
    $text2speechSpeed = new Typecho_Widget_Helper_Form_Element_Radio(
        'text2speechSpeed',
        array(
            '1' => '超慢',
            '3' => '慢速',
            '5' => '正常',
            '7' => '快速',
            '12' => '超快'
        ),
        '5',
        _t('语音朗读语速'),
        _t('说的快还是慢？')
    );
    $form->addInput($text2speechSpeed);
  
    $text2speechLength = new Typecho_Widget_Helper_Form_Element_Text(
        'text2speechLength',
        NULL,
        '3000',
        _t('语音朗读分段字数'),
        _t('输入分段字数，最大为 5000 字，默认为 3000 字，为防失败建议不要超过最大值。')
    );
    $form->addInput($text2speechLength);
  
    $text2speechBegin = new Typecho_Widget_Helper_Form_Element_Text(
        'text2speechBegin',
        NULL,
        '语音小助手为您服务~接下来将朗读：',
        _t('语音朗读开头内容'),
        _t('为语音配上一个欢迎词？')
    );
    $form->addInput($text2speechBegin);
  
    $text2speechEnd = new Typecho_Widget_Helper_Form_Element_Text(
        'text2speechEnd',
        NULL,
        '。文章读完了，感觉写的怎么样呢？如果觉得对您有帮助，就在文章后面点个赞吧！',
        _t('语音朗读结尾内容'),
        _t('为语音配上一个结束语？')
    );
    $form->addInput($text2speechEnd);
  
    $lazyImg = new Typecho_Widget_Helper_Form_Element_Radio(
        'lazyimg',
        array(
            '1' => '开启',
            '0' => '关闭'
        ),
        '1',
        _t('图片懒加载'),
        _t('是否启用图片懒加载功能？一定程度上可降低服务器负载，以及客户端内存占用。')
    );
    $form->addInput($lazyImg);
  
    $allowComment = new Typecho_Widget_Helper_Form_Element_Radio(
        'allowcomment',
        array(
            '1' => '开启',
            '0' => '关闭'
        ),
        '0',
        _t('非中文语系评论'),
        _t('是否允许非中文语系评论？一般中文站中非中文评论都是垃圾评论。')
    );
    $form->addInput($allowComment);
}

/*
 *主题配置
*/
function themeInit($self) {
    $options = $self->widget('Widget_Options');
     if ($options->shortcode) {
        require_once __DIR__ . '/shortcode.php';
    }
}

/*
 *首页缩略图
*/

function the_index_thumbnail($post)
{
  if(isset($post->fields->thumb2)){
    $ctu = $post->fields->thumb2; 
  }
  else{
    $ctu = '/usr/themes/armx/img/thumb.jpg';
  }
  echo $ctu;
}

/**
 * 文章缩略
 * @author NatLiu
 * @date   2018-01-24T14:00:22+0800
 * @param  [type]                   $post    [description]
 * @param  string                   $default [description]
 * @return [type]                            [description]
 */
function the_post_thumbnail($post, $default = '')
{
  echo get_post_thumbnail($post, $default);
}

/**
 * 获取文章缩略图
 * @author NatLiu
 * @date   2018-01-24T14:00:30+0800
 * @param  [type]                   $post    [description]
 * @param  string                   $default [description]
 * @return [type]                            [description]
 */
function get_post_thumbnail($post, $default = '')
{
    $thumb = get_thumbnail_src($post->cid);
    $default = empty($default) ? '/usr/themes/armx/img/thumb.jpg' : $default;
    if(empty($thumb) && preg_match('/src=["\']([^"\']+)["\']/', $post->content, $matches)){
        $thumb = $matches[1];
    }
    return empty($thumb) ? $default : $thumb;
}

/**
 * 留空
 * @author NatLiu
 * @date   2018-01-24T14:00:43+0800
 * @param  string                   $message   [description]
 * @param  string                   $className [description]
 * @return [type]                              [description]
 */
function empty_message( $message = '', $className = '' )
{
    $class = 'empty-placeholder';
    if(!empty($className)){
        $class .= ' '.$className;
    }
    echo '<div class="'.$class.'"><div class="placeholder-bg"></div><div class="placeholder-content">'.$message.'</div></div>';
}


/**
 * 评论输出
 * @author NatLiu
 * @date   2018-01-24T14:00:59+0800
 * @param  [type]                   $that                 [description]
 * @param  [type]                   $singleCommentOptions [description]
 * @return [type]                                         [description]
 */
function threadedComments($that, $singleCommentOptions)
{
    $domain = trim($_SERVER['HTTP_HOST']);
    $commentClass = '';
        if ($that->authorId) {
            if ($that->authorId == $that->ownerId) {
                $commentClass .= ' comment-by-author';
            } else {
                $commentClass .= ' comment-by-user';
            }
        }
?>
<li itemscope itemtype="http://schema.org/UserComments" id="<?php $that->theId(); ?>" class="comment-item<?php
    if ($that->levels > 0) {
        echo ' comment-child';
        $that->levelsAlt(' comment-level-odd', ' comment-level-even');
    } else {
        echo ' comment-parent';
    }
    $that->alt(' comment-odd', ' comment-even');
    echo $commentClass;
?>">
    <div class="comment-author" itemprop="creator" itemscope itemtype="http://schema.org/Person">
       <?php $that->gravatar($singleCommentOptions->avatarSize, $singleCommentOptions->defaultAvatar); ?>
    </div>
<div class="comment-body">
    <div class="comment-meta">
        <strong class="author-name"><?php if(isset($that->url)){
echo "<a href=\"//$domain/ext/link/?url=$that->url\" target=\"_blank\" rel=\"external nofollow\">$that->author</a>";} else{ echo $that->author;} ?></strong>
        <p><a class="comment-date" href="<?php $that->permalink(); ?>"><time itemprop="commentTime" datetime="<?php $that->date('Y-m-d H:i:s'); ?>"><?php $singleCommentOptions->beforeDate();
        $that->dateWord();
        $singleCommentOptions->afterDate(); ?></time></a>
        <?php if ('waiting' == $that->status) { ?>
        <em class="comment-awaiting-moderation"><?php $singleCommentOptions->commentStatus(); ?></em>
        <?php } ?>
        </p>
    </div>
    <div class="comment-content" itemprop="commentText">
    <?php $that->content(); ?>
    </div>
    <div class="comment-reply" id="comment-reply-<?php echo $that->coid;?>">
        <a data-commentid="<?php echo $that->coid;?>" data-respondid="<?php echo $that->parameter->respondId;?>" onclick="return TypechoComment.reply('<?php echo
                    $that->theId; ?>', '<?php echo $that->coid;?>');">回复</a>
    </div>
</div>
<div class="clearfix" id="comment-clear-<?php echo $that->coid;?>"></div>
    <?php if ($that->children) { ?>
    <div class="comment-children" itemprop="discusses">
        <?php $that->threadedComments(); ?>
    </div>
    <?php } ?>
</li>
<?php
}

/**
 * 获取第三方登录态
 * @author NatLiu
 * @date   2018-01-24T14:01:06+0800
 * @return [type]                   [description]
 */
function getAuth()
{
    if (empty(Typecho_Cookie::get('__typecho_oauth_openid'))) {
        return false;
    }
    return array(
            'openid' => Typecho_Cookie::get('__typecho_oauth_openid'),
            'nickname' => Typecho_Cookie::get('__typecho_oauth_nickname'),
            'avatar' => Typecho_Cookie::get('__typecho_oauth_avatar')
        );
}

/**
 * 显示登录人员
 * @author NatLiu
 * @date   2018-01-24T14:01:19+0800
 * @param  [type]                   $user    [description]
 * @param  [type]                   $options [description]
 * @param  [type]                   $request [description]
 * @return [type]                            [description]
 */
function the_user($user, $options, $request)
{
    $avatar = Typecho_Common::gravatarUrl($user->mail, 36, 'X', 'mm', $request->isSecure());
    $auth = getAuth();
    $profile = $options->profileUrl;
    if ($auth) {
        $avatar = preg_replace('/^http(s)?:\/\//', 'https://', $auth['avatar']);
    }
?>
    <div class="user-tools" id="user-tools">
        <img src="<?php echo $avatar;?>" />
    <div class="user-menu" id="user-menu">
        <?php if($auth):?>
        <a class="user-item" data-action="dialog.register_bind" href="javascript:;">绑定账号</a>
        <a class="user-item" data-action="oauth.logout">退出登录</a>
        <?php elseif( $user->hasLogin() ):?>
        <a class="user-item" data-no-instant target="_blank" href="<?php echo $profile;?>">个人中心</a>
        <a class="user-item" data-action="logout">退出登录</a>
        <?php else:?>
        <a class="user-item" data-action="dialog.login">登录</a>
        <?php if($options->allowRegister):?>
        <a class="user-item" data-action="dialog.register">注册</a>
        <?php endif;?>
        <?php endif;?>
    </div>
    </div>
<?php
}

/**
 * 获取文章分类
 * @author NatLiu
 * @date   2018-01-24T14:01:28+0800
 * @param  [type]                   $post [description]
 * @return [type]                         [description]
 */
function the_post_cat($post){
  $type = $post->fields->type;
  $category = $post->categories[0];
   if(isset($type)){
     if($type == 'jiaocheng') { $type = '教程'; }
     else if ($type == 'youhui') { $type =  "优惠"; }
     else if ($type == 'fuli') { $type =  "福利"; }
     else if ($type == 'jingyan') { $type =  "经验"; }
     else { $type =  "生活"; } }
   else {
     $type =  $category['name']; 
   }
   echo "<a class=\"post-cat\" href=\"".$category['permalink']."\"><span>$type</span></a>";
}

/**
 * 搜索关键词高亮
 * @author NatLiu
 * @date   2018-01-24T14:01:58+0800
 * @param  string                   $keyword [description]
 * @param  string                   $text    [description]
 * @return [type]                            [description]
 */
function highlightSearch($keyword = '', $text = '')
{
    if ($keyword==='') {
        return $text;
    }
    $text = preg_replace_callback('/'.preg_quote($keyword).'/i', function ($matches)
    {
       return "<strong class=\"search-keyword\">$matches[0]</strong>";
    }, $text);
    return $text;
}


//文章阅读次数含cookie
function get_post_view($archive)
{
    $cid    = $archive->cid;
    $db     = Typecho_Db::get();
    $prefix = $db->getPrefix();
    if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
        $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
        echo 0;
        return;
    }
    $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
    if ($archive->is('single')) {
 $views = Typecho_Cookie::get('extend_contents_views');
        if(empty($views)){
            $views = array();
        }else{
            $views = explode(',', $views);
        }
if(!in_array($cid,$views)){
       $db->query($db->update('table.contents')->rows(array('views' => (int) $row['views'] + 1))->where('cid = ?', $cid));
array_push($views, $cid);
            $views = implode(',', $views);
            Typecho_Cookie::set('extend_contents_views', $views); //记录查看cookie
        }
    }
    echo $row['views'];
}

//最新文章或更新文章
function new_or_update($post)
{
     date_default_timezone_set('PRC');
     $t1 = date('Y-m-d H:i:s',$post->modified);
     $t2 = date('Y-m-d H:i:s');
     $t3 = date('Y-m-d H:i:s',$post->created);
     $diff = (strtotime($t2)-strtotime($t1))/3600;
     $diff2 = (strtotime($t2)-strtotime($t3))/3600;
     if($diff<36){
      echo "<span class=\"zd zdn\">最新</span>";
     }
     if($diff<36 && $diff2>=36){
      echo "<span class=\"zd zdu\">更新</span>";
     }
}

// 5月之前的关闭语音播报
function readable($post)
{
     date_default_timezone_set('PRC');
     $t1 = date('Y-m-d H:i:s',$post->created);
     $t2 = '1525104000';
     $diff = (strtotime($t1) - $t2)/86400;
     if($diff>0){
        return true;
     }else
     {
       return false;
     }
}


//运行秒数 
function uptime( $uptime = '')
{
   date_default_timezone_set('PRC');
   $t = date('Y-m-d H:i:s');
   $tn = strtotime($t);
   $ts = 1488805872; //2017-3-6 21:11:12
   $cle = $tn - $ts;
    echo $cle;
}

//运行秒数
function uptimed( $uptimed= '')
{
   date_default_timezone_set('PRC');
   $t = date('Y-m-d H:i:s');
   $tn = strtotime($t);
   $ts = 1488805872; //2017-3-6 21:11:12
   $cle = $tn - $ts;
   $cle = floor( $cle / 86400 ); //天
   echo $cle;
}

//随机文章
function theme_random_posts($random){
$defaults = array(
'number' => 6, //输出文章条数
'xformat' => '<li><a href="{permalink}">{title}</a></li>'
);
$db = Typecho_Db::get();
 
$sql = $db->select()->from('table.contents')
->where('status = ?','publish')
->where('type = ?', 'post')
->limit($defaults['number'])
->order('RAND()');
 
$result = $db->fetchAll($sql);
foreach($result as $val){
$val = Typecho_Widget::widget('Widget_Abstract_Contents')->filter($val);
echo '<li class="recent recent-0 redash">
 <a href="' . $val['permalink'] . '" title="' . $val['title'] . '"><span class="recent-title"><i class="fa fa-random likepost"></i> ' . $val['title'] . '</span></a>
            </li>';
}
}

//重新处理文章
function parseContent($obj){
  
    $options = Typecho_Widget::widget('Widget_Options');
   
    if(!empty($options->src_add) && !empty($options->cdn_add)) {   //CDN
       $obj->content = str_ireplace($options->src_add,$options->cdn_add,$obj->content);
    }
  
    if ($options->shortcode) {   //短代码
       $obj->content = do_shortcode($obj->content);
    }
  
 	preg_match_all('/<a(.*?)href="(.*?)"(.*?)>/',$obj->content,$matches);  //外链处理
	$domain = trim($_SERVER['HTTP_HOST']);
	if($matches){
	  foreach($matches[2] as $val)
             {
		if(strpos($val,'://')!==false && strpos($val,$domain)===false && !preg_match('/\.(jpg|jepg|png|ico|bmp|gif|tiff|swf)/i',$val))
                  {
			  $obj->content=str_replace("href=\"$val\"", "href=\"//".$domain."/ext/link/?url=$val\" target=\"_blank\" rel=\"external nofollow\" ",$obj->content);
		  }
        if(preg_match('/go/i',$val))
                  {
              $obj->content=str_replace("href=\"$val\"", "href=\"//".$domain."/ext/link/?url=https://$domain$val\" target=\"_blank\" rel=\"external nofollow\" ",$obj->content);
                  }
	     }
	}      
  
    if ($options->lazyimg) { 
      $obj->content= preg_replace(['/<p>(<div(.+?)<\/div>)<\/p>/', '/<img(.+?)src="/'],['$1', '<img$1src="' . __LAZYIMG__ . '" data-original="'],$obj->content);
    }
  
    echo trim($obj->content);
}

//移动端粗略判断，配合图片处理
function isMobile()
{ 
    if (isset ($_SERVER['HTTP_USER_AGENT']))
    {
        $clientkeywords = array ('android','mobile','iphone'); 
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(".implode('|', $clientkeywords).")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
        {
            return true;
        } 
    } 
    return false;
} 

//热门文章（访问最多）
function theme_hot_posts($hot){
$days = 99999999999999;
$num = 6;
$defaults = array(
'before' => '',
'after' => '',
'xformat' => '<li><a href="{permalink}">{title}</a></li>'
);
$time = time() - (24 * 60 * 60 * $days);
$db = Typecho_Db::get();
$sql = $db->select()->from('table.contents')
->where('created >= ?', $time)
->where('type = ?', 'post')
->limit($num)
->order('views',Typecho_Db::SORT_DESC);
$result = $db->fetchAll($sql);
echo $defaults['before'];
foreach($result as $val){
$val = Typecho_Widget::widget('Widget_Abstract_Contents')->filter($val);
echo '<li class="hotpage"> <a href="' . $val['permalink'] . '" title="' . $val['views'] . ' 人阅览了这篇文章"> ' . $val['title'] . ' </a><br />
</li>';
}
}

//热评文章（评论最多）
function theme_mocom_posts($mocom){
$days = 99999999999999;
$num = 6;
$defaults = array(
'before' => '',
'after' => '',
'xformat' => '<li><a href="{permalink}">{title}</a></li>'
);
$time = time() - (24 * 60 * 60 * $days);
$db = Typecho_Db::get();
$sql = $db->select()->from('table.contents')
->where('created >= ?', $time)
->where('type = ?', 'post')
->limit($num)
->order('commentsNum',Typecho_Db::SORT_DESC);
$result = $db->fetchAll($sql);
echo $defaults['before'];
foreach($result as $val){
$val = Typecho_Widget::widget('Widget_Abstract_Contents')->filter($val);
echo '<li class="hotpage"> <a href="' . $val['permalink'] . '" title="收到了评论 ' . $val['commentsNum'] . ' 条"> ' . $val['title'] . ' </a><br />
</li>';
}
}

//活跃用户
function getFriendWall(){
$options = Typecho_Widget::widget('Widget_Options');
$domain = trim($_SERVER['HTTP_HOST']);
$db = Typecho_Db::get();   
$sql = $db->select('COUNT(author) AS cnt', 'author', 'url', 'mail')   
          ->from('table.comments')   
          ->where('status = ?', 'approved')   
          ->where('type = ?', 'comment')   
          ->where('authorId = ?', '0')   
          ->where('mail != ?', $options->socialemail)   //排除自己上墙   
          ->group('author')   
          ->order('cnt', Typecho_Db::SORT_DESC)   
          ->limit('16');    //读取几位用户的信息   
$result = $db->fetchAll($sql);   
if (count($result) > 0) {   
  $maxNum = $result[0]['cnt'];   
  $mostactive = ' ';
  foreach ($result as $value) {   
    if($value['url']){
        $mostactive .= '
         <li class="tabs-active-item"><a href="//'.$domain.'/ext/link/?url=' . $value['url'] . '" target="_blank" rel="nofollow" class="leader-links" title="积极互动了 '.$value['cnt'].' 次">
           ' . $value['author'] . '
        </a></li>
        ';       
  }else{
      $mostactive .= '
        <li class="tabs-active-item"><a class="leader-links" title="累计互动 '.$value['cnt'].' 次">
           ' . $value['author'] . '
        </a></li>
        '; 
    }
  }  
//  $mostactive .='</li>';
  echo $mostactive;   
 }  
}

// Http 请求
function mcFetch ($args = array()) {
    $args = array_merge(array(
        'method' => 'GET',
        'url' => null,
        'header' => array(),
        'data' => array()
    ), $args);
    $args['header'] = array_merge(array(
        'Referer' => 'https://www.google.co.uk',
        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'
    ), $args['header']);
    if (!$args['url']) {
        return;
    }
    if ($client = Typecho_Http_Client::get()) {
        if (!empty($args['header'])) {
            foreach($args['header'] as $key => $val) {
                $client->setHeader($key, $val);
            }
        }
        if (!empty($args['data'])) {
            if ($args['method'] === 'GET') {
                $client->setQuery($args['data']);
            }
            if ($args['method'] === 'POST') {
                $client->setData($args['data']);
            }
        }
        $client->setTimeout(15);
        $client->send($args['url']);
        return $client->getResponseBody();
    }
}

// 获取音频地址
function getSpeech ($title, $content) {
    $options = Typecho_Widget::widget('Widget_Options');
    if($options->baiduBDUSS != null) {
    $result = mcFetch(array(
        'method' => 'POST',
        'url' => 'http://developer.baidu.com/vcast/getVcastInfo',
        'header' => array(
            'Referer' => 'http://developer.baidu.com/vcast',
            'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8',
            'X-Requested-With' => 'XMLHttpRequest',
            'Cookie' => 'BDUSS=' . $options->baiduBDUSS
        ),
        'data' => array(
            'title' => $title,
            'content' => $content,
            'sex' => $options->text2speechSex >= 0 ? $options->text2speechSex : 4,
            'speed' => $options->text2speechSpeed ? $options->text2speechSpeed : 5,
            'volumn' => 9,
            'pit' => 5,
            'method' => 'TRADIONAL'
        )
    ));
    if ($data = json_decode($result)) {
        if ($data) {
            return $data->bosUrl;
        }
    }
    }
}

// 分割字符串，转语音
function mb_str_split($str, $length = 1) {
    if ($length < 1) return false;
    $result = array();
    for ($i = 0; $i < mb_strlen($str); $i += $length) {
        $result[] = mb_substr($str, $i, $length);
    }
    return $result;
}

// 文字转语音
function text2speech ($cid) {
    Typecho_Widget::widget('Widget_Archive', 'type=post&cid=' . $cid)->to($post);
    $options = Typecho_Widget::widget('Widget_Options');
    $content = $post->content;
    if ($options->shortcode) {
        $content = do_shortcode($content);
    }
    $content = strip_tags($content);
    $content = str_replace("</p><p>", "。", $content);
    $content = str_replace(
        array('“', '”', '"', '\'', '@', '#', '%', '&', '——', '…', '*'),
        ' ',
        $content
    );
    $speech = [];
    $length = $options->text2speechLength ? (int) $options->text2speechLength : 3000;
    $contentList = mb_str_split($content, $length);
    $contentLength = count($contentList);
    foreach ($contentList as $key => $val) {
        $title = $post->title;
        if ($key === 0) {
            $title = $options->text2speechBegin . '。' . $title. '。。';
            $val = '。' . $val ;
        } else {
            if ($contentLength > 1) {
                $title = mb_substr($val, 0, 2);
                $val = mb_substr($val, 2);
            }
        }
        if ($key === $contentLength - 1) {
            $val = $val . '。' . $options->text2speechEnd;
        }
        $speech[] = getSpeech($title, $val);
    }
    return $speech;
}

//非中文评论
function allowcomment(){
    $options = Typecho_Widget::widget('Widget_Options');
    if ($options->allowcomment) {
        return true;
    } 
    else {
       if(!empty($_SERVER['HTTP_ACCEPT_LANGUAGE']) && stripos($_SERVER['HTTP_ACCEPT_LANGUAGE'], 'zh') > -1){ 
         return true;
       }
       else {
         return false;
       }
    }
}