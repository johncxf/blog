<?php

function themeConfig($form) {
    $face = new Typecho_Widget_Helper_Form_Element_Text('face', NULL, NULL, _t('作者头像'), _t('在这里填入一个图片URL'));
    $form->addInput($face);

    $bgimg = new Typecho_Widget_Helper_Form_Element_Text('bgimg', NULL, NULL, _t('背景图片URL'), _t('您甚至可以插入BING随机壁纸：https://api.dujin.org/bing/1920.php'));
    $form->addInput($bgimg);

    $topimg = new Typecho_Widget_Helper_Form_Element_Text('topimg', NULL, NULL, _t('顶部图片URL'), _t('在这里填入一个图片URL'));
    $form->addInput($topimg);

    $selfidt = new Typecho_Widget_Helper_Form_Element_Textarea('selfidt', NULL, NULL, _t('侧栏个人介绍'), _t('在这里填入HTML代码，每一行用一个&lt;li&gt;标签，支持font-awesome，<b onclick=\'$("#vblogshowcode0").slideToggle(500)\'>点我查看示例。</b><textarea id="vblogshowcode0" style="display:none;"><li><i class="fa fa-thumbs-up"></i> 咯咯哒咯咯哒~ (๑•̀ㅂ•́)و✧</li>
<li><i class="fa fa-home"></i> 老家：火星</li>
<li><i class="fa fa-info"></i> 爱好：睡觉、敲代码</li>
<li><i class="fa fa-birthday-cake"></i> 生日：8102年13月52日</li>
<li><i class="fa fa-edit"></i> 简介：欢迎！我白天是个邮递员，晚上就是个有抱负的演员。这是我的博客。我住在天朝的帝都，有条叫做杰克的狗。--滑稽的简介</li></textarea>'));
    $form->addInput($selfidt);

    $sidebarBlock = new Typecho_Widget_Helper_Form_Element_Checkbox('sidebarBlock', 
    array('my_reader' => _t('显示我的读者'),
    'random_img' => _t('显示随机图片'),
    'random_article' => _t('显示随机文章'),
    'all_comments' => _t('显示最新评论'),
    'df_views' => _t('使用主题自带的浏览数目统计'),
    'show_Thumb' => _t('首页显示文章图片')
    ),
    array('my_reader', 'random_img', 'random_article', 'all_comments', 'df_views'), _t('配置'));
    $form->addInput($sidebarBlock->multiMode());

    $link = new Typecho_Widget_Helper_Form_Element_Textarea('link', NULL, NULL, _t('友链HTML代码'), _t('如：&lt;a href="http://blog.lljh.bid" target="_blank"&gt;Luuljh的博客&lt;/a&gt;'));
    $form->addInput($link);

    $footcode = new Typecho_Widget_Helper_Form_Element_Textarea('footcode', NULL, NULL, _t('footer执行代码'), _t('HTML。一般都是插入统计代码之类的，若要引用额外的JS文件，建议写成如下格式：<b onclick=\'$("#vblogshowcode1").slideToggle(500)\'>点我查看示例。</b><textarea id="vblogshowcode1" style="display:none;"><script type="text/javascript">
(function(){
    var s = document.createElement(\'script\');
    s.type = \'text/javascript\';
    s.src = "https://example.com/xxx.js";  //左边写URL
    var tmp = document.getElementsByTagName(\'script\')[0];
    tmp.parentNode.insertBefore(s, tmp);
})();
</script></textarea>'));
    $form->addInput($footcode);

    $sidebarrandomimg = new Typecho_Widget_Helper_Form_Element_Text('sidebarrandomimg', NULL, NULL, _t('侧栏随机图片URL'), _t('图片URL，用于展示在侧栏'));
    $form->addInput($sidebarrandomimg);

    $ewmurl = new Typecho_Widget_Helper_Form_Element_Text('ewmurl', NULL, NULL, _t('打赏二维码URL'), _t('图片URL（不填写本项则表示不开启打赏功能）'));
    $form->addInput($ewmurl);

    $beian = new Typecho_Widget_Helper_Form_Element_Text('beian', NULL, NULL, _t('备案信息'), _t('如：京ICP证x号&lt;img src="xxx.jpg" /&gt;京公网备案x号'));
    $form->addInput($beian);
}
function getFriendWall(){
//来源于 https://itlu.org/articles/1954.html
$period = time() - 5184000; // 单位: 秒
$db = Typecho_Db::get();
$sql = $db->select('COUNT(author) AS cnt', 'author', 'url', 'mail')
->from('table.comments')
->where('created > ?', $period )
->where('status = ?', 'approved')
->where('type = ?', 'comment')  
->where('authorId = ?', '0')
->group('author')
->order('cnt', Typecho_Db::SORT_DESC)
->limit('12');
$result = $db->fetchAll($sql);
$mostactive = "";
$my_array=array('www','0','1','2','cn');
if (count($result) > 0) {
foreach ($result as $value) {
$mostactive .= '<span title="' . $value['author'] . ' : ' . $value['cnt'] . '次重要讲话" >';
$mostactive .= '<img class="avatar" data-original="//'.$my_array[rand(0,4)].'.gravatar.com/avatar/'.md5(strtolower($value['mail'])).'?s=24&d=&r=G" /></span>';
}
echo $mostactive;
}
}
function showThumb($obj){
//来源于绛木子的简书主题
	$size=null;$link=false;
    $imgplaceholder=Helper::options()->themeUrl."/s/none.gif";
	$pattern='<div class="post-thumb"><img src="'.$imgplaceholder.'" alt="{title}" data-original="{thumb}" /></div>';
    preg_match_all( "/<[img|IMG].*?src=[\'|\"](.*?)[\'|\"].*?[\/]?>/", $obj->content, $matches );
    $thumb = '';
    $options = Typecho_Widget::widget('Widget_Options');
    if(isset($matches[1][0])){
        $thumb = $matches[1][0];;
        if(!empty($options->src_add) && !empty($options->cdn_add)){
            $thumb = str_ireplace($options->src_add,$options->cdn_add,$thumb);
        }
        if($size!='full'){
            $thumb_width = $options->thumb_width;
            $thumb_height = $options->thumb_height;
    
            if($size!=null){
                $size = explode('x', $size);
                if(!empty($size[0]) && !empty($size[1])){
                    list($thumb_width,$thumb_height) = $size;
                }
            }
        }
    }
    if(empty($thumb)){
        return '';
    }
    if($link){
        return $thumb;
    }
    echo str_replace(
        array('{title}','{thumb}','{permalink}'),
        array($obj->title,$thumb,$obj->permalink),
        $pattern);
}
function getRandomPosts(){//原作者不明..
    $db = Typecho_Db::get();
    $result = $db->fetchAll($db->select()->from('table.contents')
        ->where('status = ?','publish')
        ->where('type = ?', 'post')
        ->where('created <= unix_timestamp(now())', 'post')
        ->limit(5)
        ->order('RAND()')
    );
    if($result){
        foreach($result as $val){
            $obj = Typecho_Widget::widget('Widget_Abstract_Contents');
            $val = $obj->push($val);
            $post_title = htmlspecialchars($val['title']);
            $permalink = $val['permalink'];
            echo '<li><i class="fa fa-book"></i>
                <a href="'.$permalink.'">'.$post_title.'</a></li>';
        }
    }
}
function img_lazy_load($ct){
    $imgplaceholder = Helper::options()->themeUrl."/s/none.gif";
    return preg_replace("/<img(.*?)src=[\"|'](.*?)[\"|'](.*?)>/i","<img src='".$imgplaceholder."'$1data-original='$2'$3>",$ct);
}
function getViewsStr($widget) {
    //来源不明
    $fields = unserialize($widget->fields);
    if (array_key_exists('views', $fields))
        $views = (!empty($fields['views'])) ? intval($fields['views']) : 0;
    else
        $views = 0;
    //增加浏览次数
    if ($widget->is('single')) {
        $vieweds = Typecho_Cookie::get('contents_viewed');
        if (empty($vieweds))
            $vieweds = array();
        else
            $vieweds = explode(',', $vieweds);
        if (!in_array($widget->cid, $vieweds)) {
            $views = $views + 1;
            $widget->setField('views', 'str', strval($views), $widget->cid);
            $vieweds[] = $widget->cid;
            $vieweds = implode(',', $vieweds);
            Typecho_Cookie::set("contents_viewed",$vieweds);
        }
    }
    return $views." 次浏览";
}