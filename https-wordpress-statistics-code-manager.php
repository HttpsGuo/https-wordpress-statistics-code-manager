<?php
/**
 * Plugin Name: HttpsWordPress统计代码管理器
 * Plugin URI: https://blog.httpsguo.cn/plugins/https-wordpress-statistics-code-manager
 * Description: 一个简单的插件，允许您添加各种统计代码（如百度统计等），并确保这些代码在主题更新后仍然有效。
 * Version: 1.1.0
 * Author: HttpsGuo
 * Author URI: https://blog.httpsguo.cn
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: https-wordpress-statistics-code-manager
 * Domain Path: /languages
 */

// 如果直接访问此文件，则中止
if (!defined('ABSPATH')) {
    exit;
}

// 定义插件版本
define('SCM_VERSION', '1.1.0');

// 定义插件目录路径
define('SCM_PLUGIN_DIR', plugin_dir_path(__FILE__));

// 定义插件URL
define('SCM_PLUGIN_URL', plugin_dir_url(__FILE__));

// 包含管理页面类
require_once SCM_PLUGIN_DIR . 'includes/class-scm-admin.php';

// 包含前端显示类
require_once SCM_PLUGIN_DIR . 'includes/class-scm-frontend.php';

/**
 * 插件激活时的钩子
 */
function scm_activate() {
    // 初始化设置选项
    $default_options = array(
        'header_code' => '',
        'footer_code' => '',
        'baidu_code' => '',
        'google_code' => '',
        'custom_code' => ''
    );
    
    // 只有当选项不存在时才添加
    if (!get_option('scm_options')) {
        add_option('scm_options', $default_options);
    }
}
register_activation_hook(__FILE__, 'scm_activate');

/**
 * 插件停用时的钩子
 */
function scm_deactivate() {
    // 停用时的操作（如有需要）
}
register_deactivation_hook(__FILE__, 'scm_deactivate');

/**
 * 插件卸载时的钩子
 */
function scm_uninstall() {
    // 删除插件选项
    delete_option('scm_options');
}
register_uninstall_hook(__FILE__, 'scm_uninstall');

/**
 * 初始化插件
 */
function scm_init() {
    // 加载文本域用于翻译
    load_plugin_textdomain('https-wordpress-statistics-code-manager', false, dirname(plugin_basename(__FILE__)) . '/languages');
    
    // 初始化管理页面
    $scm_admin = new SCM_Admin();
    $scm_admin->init();
    
    // 初始化前端显示
    $scm_frontend = new SCM_Frontend();
    $scm_frontend->init();
}
add_action('plugins_loaded', 'scm_init');