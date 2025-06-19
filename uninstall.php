<?php
/**
 * 统计代码管理器卸载文件
 *
 * 当插件被删除时，此文件将被执行，用于清理插件在数据库中留下的数据。
 *
 * @package Statistics_Code_Manager
 */

// 如果未定义WP_UNINSTALL_PLUGIN常量，则退出
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// 删除插件选项
delete_option('scm_options');

// 清理可能存在的瞬态数据
delete_transient('scm_transient_data');