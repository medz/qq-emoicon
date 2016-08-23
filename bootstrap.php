<?php

use Medz\Component\QQEmoicon\QQEmoicon;

// 如果是非composer使用，尝试加载composer自动加载文件。
if (!class_exists('Medz\Component\QQEmoicon\QQEmoicon')) {
    $file = file_exists(__DIR__.'/vendor/autoload.php')
        ? __DIR__.'/vendor/autoload.php'
        : dirname(dirname(__DIR__)).'/vendor/autoload.php'
    ;

    if (file_exists($file)) {
        require_once $file;
    }
}

if (!function_exists('qq_emoicon_finder')) {
    /**
     * 表情查找器
     *
     * @param string $name 表情名称
     * @return Symfony\Component\Finder\SplFileInfo|Symfony\Component\Finder\Finder 文件info｜查找器
     * @author Seven Du <lovevipdsw@outlook.com>
     * @homepage http://medz.cn
     */
    function qq_emoicon_finder($name = '*')
    {
        return QQEmoicon::finder($name);
    }
}

if (!function_exists('qq_emoicon_source')) {
    /**
     * 获取图片资源内容
     *
     * @param string $name 表情名称
     * @return source 资源内容
     * @author Seven Du <lovevipdsw@outlook.com>
     * @homepage http://medz.cn
     */
    function qq_emoicon_source($name)
    {
        return QQEmoicon::getSource($name);
    }
}

if (!function_exists('qq_emoicon_data_url')) {
    /**
     * 获取文件内容的base64的data格式URL
     *
     * @param string $name 表情名称
     * @return string URL地址
     * @author Seven Du <lovevipdsw@outlook.com>
     * @homepage http://medz.cn
     */
    function qq_emoicon_data_url($name)
    {
        $contents = qq_emoicon_source($name);

        if ($contents === null) {
            return null;
        }

        return 'data:image/png;base64,'.base64_encode($contents);
    }
}

if (!function_exists('qq_emoicon_echo')) {
    /**
     * 输出表情图片
     *
     * @param string $name 表情名称
     * @author Seven Du <lovevipdsw@outlook.com>
     * @homepage http://medz.cn
     */
    function qq_emoicon_echo($name)
    {
        header("content-type:image/png");

        ob_end_clean();
        ob_start(function ($buffer, $mode) {
            if (extension_loaded('zlib') && function_exists('ob_gzhandler')) {
                return ob_gzhandler($buffer, $mode);
            }

            return $buffer;
        });

        echo qq_emoicon_source($name);
    }
}
