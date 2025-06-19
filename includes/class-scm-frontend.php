<?php
/**
 * 前端显示类
 *
 * @package HttpsWordPress_Statistics_Code_Manager
 */

// 如果直接访问此文件，则中止
if (!defined('ABSPATH')) {
    exit;
}

/**
 * 前端显示类
 */
class SCM_Frontend {

    /**
     * 初始化前端显示
     */
    public function init() {
        // 添加代码到头部
        add_action('wp_head', array($this, 'add_header_code'), 999);
        
        // 添加代码到底部
        add_action('wp_footer', array($this, 'add_footer_code'), 999);
    }
    
    /**
     * 添加代码到头部
     */
    public function add_header_code() {
        $options = get_option('scm_options');
        
        // 输出HTML注释
        echo "\n<!-- 统计代码管理器开始 - 头部代码 -->\n";
        
        // 输出百度统计代码
        if (!empty($options['baidu_code'])) {
            echo "\n<!-- 百度统计代码 -->\n";
            echo $this->prepare_code($options['baidu_code']) . "\n";
        }
        
        // 输出Google Analytics代码
        if (!empty($options['google_code'])) {
            echo "\n<!-- Google Analytics代码 -->\n";
            echo $this->prepare_code($options['google_code']) . "\n";
        }
        
        // 输出CNZZ统计代码
        if (!empty($options['cnzz_code'])) {
            echo "\n<!-- CNZZ统计代码 -->\n";
            echo $this->prepare_code($options['cnzz_code']) . "\n";
        }
        
        // 输出友盟统计代码
        if (!empty($options['umeng_code'])) {
            echo "\n<!-- 友盟统计代码 -->\n";
            echo $this->prepare_code($options['umeng_code']) . "\n";
        }
        
        // 输出其他自定义代码
        if (!empty($options['custom_code'])) {
            echo "\n<!-- 其他自定义代码 -->\n";
            echo $this->prepare_code($options['custom_code']) . "\n";
        }
        
        // 输出HTML注释
        echo "<!-- 统计代码管理器结束 - 头部代码 -->\n";
    }
    
    /**
     * 添加代码到底部
     */
    public function add_footer_code() {
        // 底部不再输出任何代码，所有统计代码都在头部输出
    }
    
    /**
     * 准备代码以确保安全输出
     * 
     * @param string $code 要准备的代码
     * @return string 准备好的代码
     */
    private function prepare_code($code) {
        // 移除WordPress自动添加的p标签和br标签
        $code = str_replace(array('<p>', '</p>', '<br>', '<br />'), '', $code);
        
        // 移除多余的空白行
        $code = preg_replace('/^\s*\n/m', '', $code);
        
        return $code;
    }
}