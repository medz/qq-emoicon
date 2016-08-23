<?php

namespace Medz\Component\QQEmoicon;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

/**
 * 表情资源获取
 *
 * @author Seven Du <lovevipdsw@outlook.com>
 **/
class QQEmoicon
{
    protected static $finder;

    public static function finder($name = '*')
    {
        if (!(self::$finder instanceof Finder)) {
            self::$finder = new Finder;
            self::$finder
                ->files()
                ->in(dirname(__DIR__).'/resource')
            ;
        }

        $finder = clone self::$finder;
        $files = $finder->name(sprintf('%s.png', $name));

        if ($name == '*') {
            return $files;
        }

        foreach ($files as $file) {
            if ($file->getBasename('.'.$file->getExtension()) == $name) {
                return $file;
            }
        }

        return null;
    }

    public static function getSource($name)
    {
        $file = self::finder($name);

        if ($file instanceof SplFileInfo) {
            return $file->getContents();
        }

        return null;
    }

} // END class QQEmoicon
