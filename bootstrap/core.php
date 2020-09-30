<?php

use Laravel\Lumen\Application as Lumen;

/**
 * @author AdamTyn
 * @description 框架入口核心类
 */
final class Core extends Lumen
{
    public function __construct($basePath = null)
    {
        $this->loadCachedConfig();

        parent::__construct($basePath);
    }

    /**
     * @author AdamTyn
     * @description 加载配置缓存文件
     */
    private function loadCachedConfig()
    {
        $cache = $this->basePath('bootstrap/cache/config.php');

        if (file_exists($cache)) {
            $config = require $cache;

            foreach ($config as $name => $value) {
                $this->loadedConfigurations[$name] = true;

                empty($value) ?: $this->make('config')->set($name, $value);
            }
        }
    }

    /**
     * @author AdamTyn
     * @description 获取绝对路径
     *
     * @param $path
     * @return string
     */
    public function basePath($path = null)
    {
        if (isset($this->basePath)) {
            return $this->basePath . ($path ? DIRECTORY_SEPARATOR . $path : $path);
        }

        $this->basePath = dirname(__DIR__);

        return $this->basePath($path);
    }

    /**
     * @author AdamTyn
     * @description 获取指定配置文件的绝对路径
     *
     * @param $name
     * @return string
     */
    public function getConfigurationPath($name = null)
    {
        if (empty($name)) {
            $appConfigDir = $this->basePath('config') . DIRECTORY_SEPARATOR;

            if (file_exists($appConfigDir)) {
                return $appConfigDir;
            } elseif (file_exists($path = $this->frameworkConfigurationPath()) . DIRECTORY_SEPARATOR) {
                return $path;
            }
        } else {
            $appConfigPath = $this->basePath('config') . DIRECTORY_SEPARATOR . $name . '.php';

            if (file_exists($appConfigPath)) {
                return $appConfigPath;
            } elseif (file_exists($path = $this->frameworkConfigurationPath() . DIRECTORY_SEPARATOR . $name . '.php')) {
                return $path;
            }
        }

        return '';
    }

    /**
     * @author AdamTyn
     * @description 获取Lumen框架兜底config目录路径
     *
     * @return string
     */
    private function frameworkConfigurationPath()
    {
        return $this->basePath('vendor/laravel/lumen-framework/config');
    }
}
