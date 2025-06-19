/**
 * 统计代码管理器管理页面脚本
 */

(function($) {
    'use strict';
    
    // 当文档加载完成后执行
    $(document).ready(function() {
        // 代码编辑器增强
        enhanceCodeEditors();
        
        // 添加代码验证功能
        addCodeValidation();
        
        // 确保没有复制按钮功能
        // 移除所有可能的复制按钮
        $('.copy-button, button.wp-block-code__copy-button, .wp-block-code__copy-button, .copy-code-button, .copy-the-code-button, .copy-to-clipboard-button, [class*="copy"], [id*="copy"]').remove();
        
        // 每隔1秒检查一次并移除复制按钮
        setInterval(function() {
            $('.copy-button, button.wp-block-code__copy-button, .wp-block-code__copy-button, .copy-code-button, .copy-the-code-button, .copy-to-clipboard-button, [class*="copy"], [id*="copy"]').remove();
        }, 1000);
    });
    
    /**
     * 增强代码编辑器
     */
    function enhanceCodeEditors() {
        // 为所有代码文本框添加行号和语法高亮（如果浏览器支持）
        $('textarea.code').each(function() {
            // 添加标签指示器
            $(this).on('input', function() {
                var value = $(this).val();
                // 检查是否包含script标签
                if (value.indexOf('<script') !== -1) {
                    $(this).addClass('has-script-tag');
                } else {
                    $(this).removeClass('has-script-tag');
                }
            }).trigger('input');
            
            // 设置固定高度，不再自动调整
            $(this).css({
                'height': '150px',
                'min-height': '150px',
                'width': '100%'
            });
        });
    }
    
    
    /**
     * 添加代码验证功能
     */
    function addCodeValidation() {
        // 为表单添加提交验证
        $('form').on('submit', function() {
            var isValid = true;
            var errorMessages = [];
            
            // 检查每个代码文本框
            $('textarea.code').each(function() {
                var value = $(this).val();
                var fieldName = $(this).closest('tr').find('th label').text();
                
                // 检查是否有未闭合的标签
                if ((value.match(/<script/g) || []).length !== (value.match(/<\/script>/g) || []).length) {
                    isValid = false;
                    errorMessages.push(fieldName + ': 脚本标签未正确闭合');
                }
                
                // 检查是否有未闭合的样式标签
                if ((value.match(/<style/g) || []).length !== (value.match(/<\/style>/g) || []).length) {
                    isValid = false;
                    errorMessages.push(fieldName + ': 样式标签未正确闭合');
                }
            });
            
            // 如果有错误，显示错误消息并阻止表单提交
            if (!isValid) {
                alert('请修复以下错误:\n' + errorMessages.join('\n'));
                return false;
            }
            
            return true;
        });
    }
    
})(jQuery);