<?php
/**
 * 验证插件提供一个机器难以识别的图片，以防止机器人的评论攻击，同时也可以防止跨站的评论提交.
 * 验证码插件是基于<a href="http://www.phpcaptcha.org">securimage</a>开发的.
 * 
 * @package Typecho Captcha
 * @author qining
 * @version 1.0.0
 * @link http://typecho.org
 */
class Captcha_Plugin implements Typecho_Plugin_Interface
{
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     * 
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate()
    {
        if (!function_exists('gd_info')) {
            throw new Typecho_Plugin_Exception(_t('对不起, 您的主机不支持 gd 扩展, 无法正常使用此功能'));
        }
    
        Typecho_Plugin::factory('Widget_Feedback')->comment = array('Captcha_Plugin', 'filter');
        Typecho_Plugin::factory('Widget_Feedback')->trackback = array('Captcha_Plugin', 'filter');
        Typecho_Plugin::factory('Widget_XmlRpc')->pingback = array('Captcha_Plugin', 'filter');
        
        Helper::addAction('captcha', 'Captcha_Action');
    }
    
    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     * 
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate(){}
    
    /**
     * 获取插件配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form)
    {}
    
    /**
     * 个人用户的配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form){}
    
    public static function output()
    {
        echo '<img src="' . Typecho_Common::url('/action/captcha', Helper::options()->index) 
        . '" alt="captcha" onclick="this.src = this.src + \'?\' + Math.random()" style="cursor: pointer" title="' . _t('点击图片刷新验证码') . '" /><br />'
        . '<input type="text" class="captcha" name="captcha" /> <strong>' . _t('请输入验证码') . '</strong>';
    }
    
    /**
     * 评论过滤器
     * 
     * @access public
     * @param array $comment 评论结构
     * @param Typecho_Widget $post 被评论的文章
     * @param array $result 返回的结果上下文
     * @param string $api api地址
     * @return void
     */
    public static function filter($comment, $post, $result)
    {
        $captchaCode = Typecho_Request::getInstance()->captcha;
        if (empty($captchaCode)) {
            throw new Typecho_Widget_Exception(_t('请输入验证码'));
        }
        
        require_once 'Captcha/securimage2/securimage.php';
        $img = new securimage();
        
        if (!$img->check($captchaCode)) {
            throw new Typecho_Widget_Exception(_t('验证码错误, 请重新输入'));
        }
    
        return $comment;
    }
}
