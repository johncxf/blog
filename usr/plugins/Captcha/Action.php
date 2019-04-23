<?php

class Captcha_Action extends Typecho_Widget implements Widget_Interface_Do
{
    public function action()
    {
        /** 防止跨站 */
        $referer = $this->request->getReferer();
        if (empty($referer)) {
            exit;
        }
        
        $refererPart = parse_url($referer);
        $currentPart = parse_url(Helper::options()->siteUrl);
        
        if ($refererPart['host'] != $currentPart['host'] ||
        0 !== strpos($refererPart['path'], $currentPart['path'])) {
            exit;
        }
    
        require_once 'Captcha/securimage2/securimage.php';
        $img = new securimage();
        
        $dir = dirname(__FILE__) . '/securimage2/';
        
        $img->wordlist_file = $dir . 'words/words.txt';
        $img->ttf_file = $dir . 'AHGBold.ttf';
        $img->signature_font = $dir . 'AHGBold.ttf';
        
        $img->show('');
    }
}
