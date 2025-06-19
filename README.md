# HttpsWordPress统计代码管理器 (HttpsWordPress Statistics Code Manager)

一个简单的WordPress插件，允许您添加各种统计代码（如百度统计等），并确保这些代码在主题更新后仍然有效。

## 功能特点

- 简单易用的界面，方便添加和管理统计代码
- 支持多种统计服务，包括百度统计、Google Analytics、CNZZ统计和友盟统计
- 可以添加其他自定义统计代码到网站头部
- 主题更新后统计代码不会丢失
- 美观的管理界面，支持响应式设计

## 安装方法

1. 下载插件压缩包
2. 登录WordPress管理后台
3. 进入「插件」>「安装插件」页面
4. 点击「上传插件」按钮
5. 选择下载的插件压缩包并上传
6. 安装完成后，点击「启用插件」

## 使用方法

1. 在WordPress管理后台，进入「设置」>「统计代码管理器」
2. 在相应的文本框中粘贴您的统计代码
3. 点击「保存设置」按钮
4. 代码将自动添加到您的网站中，即使在主题更新后也会保持有效

## 支持的统计服务

- 百度统计
- Google Analytics
- CNZZ统计
- 友盟统计
- 其他自定义统计代码

## 常见问题

### 统计代码应该粘贴到哪里？

根据不同的统计服务，将完整的统计代码粘贴到相应的文本框中：

- 百度统计代码粘贴到「百度统计代码」文本框
- Google Analytics代码粘贴到「Google Analytics代码」文本框
- CNZZ统计代码粘贴到「CNZZ统计代码」文本框
- 友盟统计代码粘贴到「友盟统计代码」文本框
- 其他统计服务的代码可以粘贴到「其他自定义代码」文本框

### 我的统计代码没有生效怎么办？

1. 确保您已正确粘贴完整的统计代码
2. 检查代码中是否有语法错误
3. 清除网站缓存和浏览器缓存
4. 如果使用了缓存插件，请刷新缓存

### "其他自定义代码"功能有什么用途？

"其他自定义代码"功能允许您添加除了百度统计、Google Analytics、CNZZ统计和友盟统计之外的任何其他统计或跟踪代码。这个功能的主要用途包括：

#### 使用场景

1. **添加其他统计服务代码**：如果您使用了插件未专门支持的统计服务（如51.la、StatCounter等），可以将代码添加到这里。

2. **添加社交媒体像素跟踪代码**：例如Facebook Pixel、Twitter Pixel、LinkedIn Insight Tag等，用于跟踪广告转化和受众分析。

3. **添加热图分析工具代码**：如Hotjar、Crazy Egg等，用于分析用户在网站上的点击、滚动和浏览行为。

4. **添加A/B测试工具代码**：如Google Optimize、Optimizely等，用于进行网站A/B测试。

5. **添加聊天工具或客服系统代码**：如Intercom、Drift、Zendesk等在线客服系统的嵌入代码。

#### 示例代码

以下是一些可能添加到"其他自定义代码"的示例：

1. **51.la统计代码示例**：
```html
<script type="text/javascript" src="//js.users.51.la/XXXXXXXX.js"></script>
```

2. **Facebook Pixel代码示例**：
```html
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', 'XXXXXXXXXXXXXXXXX');
fbq('track', 'PageView');
</script>
<!-- End Facebook Pixel Code -->
```

3. **Hotjar热图分析代码示例**：
```html
<!-- Hotjar Tracking Code -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:XXXXXX,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>
```

所有添加到"其他自定义代码"文本框中的代码都会被插入到网站的`<head>`标签内，这样可以确保这些跟踪和分析代码能够正常工作，并在整个网站中保持一致。

### 插件会影响网站性能吗？

本插件非常轻量级，不会明显影响网站性能。统计代码本身可能会对页面加载速度有轻微影响，但这与使用本插件无关，而是统计服务本身的特性。

## 版本历史

### 1.1.0
- 初始版本发布

## 许可证

本插件基于GPL-2.0+许可证发布。

## 作者信息

- 作者：HttpsGuo
- 作者网站：[blog.httpsguo.cn](https://blog.httpsguo.cn)