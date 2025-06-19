<?php
/**
 * 管理页面类
 *
 * @package HttpsWordPress_Statistics_Code_Manager
 */

// 如果直接访问此文件，则中止
if (!defined('ABSPATH')) {
    exit;
}

/**
 * 管理页面类
 */
class SCM_Admin {

    /**
     * 初始化管理页面
     */
    public function init() {
        // 添加管理菜单
        add_action('admin_menu', array($this, 'add_admin_menu'));
        
        // 注册设置
        add_action('admin_init', array($this, 'register_settings'));
        
        // 添加设置链接
        add_filter('plugin_action_links_' . plugin_basename(SCM_PLUGIN_DIR . 'https-wordpress-statistics-code-manager.php'), 
            array($this, 'add_settings_link')
        );
        
        // 加载管理页面的CSS和JS
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
    }
    
    /**
     * 添加管理菜单
     */
    public function add_admin_menu() {
        add_options_page(
            __('HttpsWordPress统计代码管理器', 'https-wordpress-statistics-code-manager'),
            __('HttpsWordPress统计代码管理器', 'https-wordpress-statistics-code-manager'),
            'manage_options',
            'https-wordpress-statistics-code-manager',
            array($this, 'display_admin_page')
        );
    }
    
    /**
     * 注册设置
     */
    public function register_settings() {
        register_setting(
            'scm_options_group',
            'scm_options',
            array($this, 'sanitize_options')
        );
        
        // 添加设置区域
        add_settings_section(
            'scm_general_section',
            __('统计代码设置', 'https-wordpress-statistics-code-manager'),
            array($this, 'general_section_callback'),
            'https-wordpress-statistics-code-manager'
        );
        
        // 百度统计代码字段
        add_settings_field(
            'baidu_code',
            __('百度统计代码', 'https-wordpress-statistics-code-manager'),
            array($this, 'baidu_code_callback'),
            'https-wordpress-statistics-code-manager',
            'scm_general_section'
        );
        
        // Google Analytics代码字段
        add_settings_field(
            'google_code',
            __('Google Analytics代码', 'https-wordpress-statistics-code-manager'),
            array($this, 'google_code_callback'),
            'https-wordpress-statistics-code-manager',
            'scm_general_section'
        );
        
        // CNZZ统计代码字段
        add_settings_field(
            'cnzz_code',
            __('CNZZ统计代码', 'https-wordpress-statistics-code-manager'),
            array($this, 'cnzz_code_callback'),
            'https-wordpress-statistics-code-manager',
            'scm_general_section'
        );
        
        // 友盟统计代码字段
        add_settings_field(
            'umeng_code',
            __('友盟统计代码', 'https-wordpress-statistics-code-manager'),
            array($this, 'umeng_code_callback'),
            'https-wordpress-statistics-code-manager',
            'scm_general_section'
        );
        
        // 其他自定义代码字段
        add_settings_field(
            'custom_code',
            __('其他自定义代码', 'https-wordpress-statistics-code-manager'),
            array($this, 'custom_code_callback'),
            'https-wordpress-statistics-code-manager',
            'scm_general_section'
        );
    }
    
    /**
     * 设置区域回调
     */
    public function general_section_callback() {
        echo '<p>' . __('在下面添加您的统计代码。这些代码将在主题更新后仍然有效。', 'https-wordpress-statistics-code-manager') . '</p>';
    }
    
    /**
     * 百度统计代码字段回调
     */
    public function baidu_code_callback() {
        $options = get_option('scm_options');
        $value = isset($options['baidu_code']) ? $options['baidu_code'] : '';
        echo '<textarea name="scm_options[baidu_code]" class="large-text code" rows="8" placeholder="' . __('粘贴百度统计代码到这里', 'https-wordpress-statistics-code-manager') . '">' . esc_textarea($value) . '</textarea>';
        echo '<p class="description">' . __('百度统计代码将被添加到网站的<head>标签中。', 'https-wordpress-statistics-code-manager') . '</p>';
    }
    
    /**
     * Google Analytics代码字段回调
     */
    public function google_code_callback() {
        $options = get_option('scm_options');
        $value = isset($options['google_code']) ? $options['google_code'] : '';
        echo '<textarea name="scm_options[google_code]" class="large-text code" rows="8" placeholder="' . __('粘贴Google Analytics代码到这里', 'https-wordpress-statistics-code-manager') . '">' . esc_textarea($value) . '</textarea>';
        echo '<p class="description">' . __('Google Analytics代码将被添加到网站的<head>标签中。', 'https-wordpress-statistics-code-manager') . '</p>';
    }
    
    /**
     * CNZZ统计代码回调
     */
    public function cnzz_code_callback() {
        $options = get_option('scm_options');
        $cnzz_code = isset($options['cnzz_code']) ? $options['cnzz_code'] : '';
        
        echo '<textarea name="scm_options[cnzz_code]" class="large-text code" rows="8">' . esc_textarea($cnzz_code) . '</textarea>';
        echo '<p class="description">' . __('请输入CNZZ统计代码，此代码将被添加到网站的<head>标签内。', 'https-wordpress-statistics-code-manager') . '</p>';
    }
    
    /**
     * 友盟统计代码回调
     */
    public function umeng_code_callback() {
        $options = get_option('scm_options');
        $umeng_code = isset($options['umeng_code']) ? $options['umeng_code'] : '';
        
        echo '<textarea name="scm_options[umeng_code]" class="large-text code" rows="8">' . esc_textarea($umeng_code) . '</textarea>';
        echo '<p class="description">' . __('请输入友盟统计代码，此代码将被添加到网站的<head>标签内。', 'https-wordpress-statistics-code-manager') . '</p>';
    }
    
    /**
     * 其他自定义代码字段回调
     */
    public function custom_code_callback() {
        $options = get_option('scm_options');
        $value = isset($options['custom_code']) ? $options['custom_code'] : '';
        echo '<textarea name="scm_options[custom_code]" class="large-text code" rows="8" placeholder="' . __('粘贴其他自定义代码到这里', 'https-wordpress-statistics-code-manager') . '">' . esc_textarea($value) . '</textarea>';
        echo '<p class="description">' . __('此代码将被添加到网站的<head>标签中。您可以添加任何其他统计或跟踪代码。', 'https-wordpress-statistics-code-manager') . '</p>';
    }
    
    /**
     * 验证和清理选项
     */
    public function sanitize_options($input) {
        $new_input = array();
        
        // 清理百度统计代码
        if (isset($input['baidu_code'])) {
            $new_input['baidu_code'] = trim($input['baidu_code']);
        }
        
        // 清理Google Analytics代码
        if (isset($input['google_code'])) {
            $new_input['google_code'] = trim($input['google_code']);
        }
        
        // 清理CNZZ统计代码
        if (isset($input['cnzz_code'])) {
            $new_input['cnzz_code'] = trim($input['cnzz_code']);
        }
        
        // 清理友盟统计代码
        if (isset($input['umeng_code'])) {
            $new_input['umeng_code'] = trim($input['umeng_code']);
        }
        
        // 清理其他自定义代码
        if (isset($input['custom_code'])) {
            $new_input['custom_code'] = trim($input['custom_code']);
        }
        
        return $new_input;
    }
    
    /**
     * 显示管理页面
     */
    public function display_admin_page() {
        // 检查用户权限
        if (!current_user_can('manage_options')) {
            return;
        }
        
        // 显示设置表单
        ?>
        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            <div class="scm-admin-container">
                <div class="scm-admin-main">
                    <form method="post" action="options.php">
                        <?php
                        settings_fields('scm_options_group');
                        do_settings_sections('https-wordpress-statistics-code-manager');
                        submit_button(__('保存设置', 'https-wordpress-statistics-code-manager'));
                        ?>
                    </form>
                </div>
                <div class="scm-admin-sidebar">
                    <div class="scm-admin-box">
                        <h3><?php _e('使用说明', 'https-wordpress-statistics-code-manager'); ?></h3>
                        <p><?php _e('1. 在相应的文本框中粘贴您的统计代码。', 'https-wordpress-statistics-code-manager'); ?></p>
                        <p><?php _e('2. 点击"保存设置"按钮。', 'https-wordpress-statistics-code-manager'); ?></p>
                        <p><?php _e('3. 代码将自动添加到您的网站中，即使在主题更新后也会保持有效。', 'https-wordpress-statistics-code-manager'); ?></p>
                    </div>
                    <div class="scm-admin-box">
                        <h3><?php _e('支持的统计服务', 'https-wordpress-statistics-code-manager'); ?></h3>
                        <ul>
                            <li><?php _e('百度统计', 'https-wordpress-statistics-code-manager'); ?></li>
                            <li><?php _e('Google Analytics', 'https-wordpress-statistics-code-manager'); ?></li>
                            <li><?php _e('CNZZ统计', 'https-wordpress-statistics-code-manager'); ?></li>
                            <li><?php _e('友盟统计', 'https-wordpress-statistics-code-manager'); ?></li>
                            <li><?php _e('其他自定义统计代码', 'https-wordpress-statistics-code-manager'); ?></li>
                        </ul>
                    </div>
                    <div class="scm-admin-box">
                        <h3><?php _e('作者信息', 'https-wordpress-statistics-code-manager'); ?></h3>
                        <p><strong><?php _e('作者：', 'https-wordpress-statistics-code-manager'); ?></strong> <a href="https://blog.httpsguo.cn" target="_blank">HttpsGuo</a></p>
                        <?php
                        // 获取作者博客的最近文章
                        $rss_url = 'https://blog.httpsguo.cn/feed/';
                        $rss_items = $this->get_author_recent_posts($rss_url, 5);
                        
                        if (!empty($rss_items)) {
                            echo '<p><strong>' . __('最近文章：', 'https-wordpress-statistics-code-manager') . '</strong></p>';
                            echo '<ul class="author-recent-posts">';
                            foreach ($rss_items as $item) {
                                echo '<li><a href="' . esc_url($item['link']) . '" target="_blank">' . esc_html($item['title']) . '</a></li>';
                            }
                            echo '</ul>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    
    /**
     * 添加设置链接到插件页面
     */
    public function add_settings_link($links) {
        $settings_link = '<a href="' . admin_url('options-general.php?page=https-wordpress-statistics-code-manager') . '">' . __('设置', 'https-wordpress-statistics-code-manager') . '</a>';
        array_unshift($links, $settings_link);
        return $links;
    }
    
    /**
     * 加载管理页面的CSS和JS
     */
    public function enqueue_admin_scripts($hook) {
        // 只在插件设置页面加载
        if ('settings_page_https-wordpress-statistics-code-manager' !== $hook) {
            return;
        }
        
        // 加载CSS
        wp_enqueue_style(
            'scm-admin-style',
            SCM_PLUGIN_URL . 'assets/css/admin.css',
            array(),
            SCM_VERSION
        );
        
        // 加载JS
        wp_enqueue_script(
            'scm-admin-script',
            SCM_PLUGIN_URL . 'assets/js/admin.js',
            array('jquery'),
            SCM_VERSION,
            true
        );
    }
    
    /**
     * 获取作者博客的最近文章
     * 
     * @param string $rss_url RSS feed URL
     * @param int $count 要获取的文章数量
     * @return array 文章数组，每篇文章包含标题和链接
     */
    private function get_author_recent_posts($rss_url, $count = 5) {
        $items = array();
        
        // 使用WordPress内置函数获取RSS feed
        $response = wp_remote_get($rss_url, array('timeout' => 15));
        
        // 检查是否有错误
        if (is_wp_error($response) || wp_remote_retrieve_response_code($response) !== 200) {
            return $items;
        }
        
        $xml_content = wp_remote_retrieve_body($response);
        
        // 尝试加载XML内容
        try {
            $xml = simplexml_load_string($xml_content);
            
            if ($xml && isset($xml->channel) && isset($xml->channel->item)) {
                $i = 0;
                foreach ($xml->channel->item as $item) {
                    if ($i >= $count) {
                        break;
                    }
                    
                    $items[] = array(
                        'title' => (string) $item->title,
                        'link' => (string) $item->link
                    );
                    
                    $i++;
                }
            }
        } catch (Exception $e) {
            // 解析错误，返回空数组
            return array();
        }
        
        return $items;
    }
}