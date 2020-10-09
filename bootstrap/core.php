<?php

use Laravel\Lumen\Application as Lumen;

/**
 * @author AdamTyn
 * @description 框架入口核心类
 */
final class Core extends Lumen
{
    /**
     * 是否读取了配置缓存文件
     * @var bool
     */
    private $cachedConfig = false;

    /**
     * Core constructor.
     * @param $basePath
     */
    public function __construct($basePath = null)
    {
        // 加载配置缓存文件
        $this->loadCachedConfig();

        parent::__construct($basePath);
    }

    /**
     * @author AdamTyn
     * @description 加载配置缓存文件
     */
    private function loadCachedConfig()
    {
        if ($this->cachedConfig) {
            return;
        }

        $cache = $this->basePath('bootstrap/cache/config.php');

        if (file_exists($cache)) {
            $config = require $cache;

            $this->cachedConfig = true;

            $repository = $this->make('config');

            foreach ($config as $name => $value) {
                $this->loadedConfigurations[$name] = true;

                empty($value) ?: $repository->set($name, $value);
            }
        }
    }

    /**
     * @author AdamTyn
     * @description 加载指定配置
     *
     * @param string $name
     */
    public function configure($name)
    {
        if (isset($this->loadedConfigurations[$name])) {
            return;
        }

        $this->loadedConfigurations[$name] = $this->cachedConfig;

        if (!$this->cachedConfig) {
            $this->loadedConfigurations[$name] = true;

            $path = $this->getConfigurationPath($name);

            if ($path) {
                $this->make('config')->set($name, require $path);
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
     * @return string
     */
    protected function getLanguagePath()
    {
        if (is_dir($langPath = $this->basePath('resources/lang'))) {
            return $langPath;
        } else {
            return $this->frameworkPath('resources/lang');
        }
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
            } elseif (file_exists($path = $this->frameworkPath('config')) . DIRECTORY_SEPARATOR) {
                return $path;
            }
        } else {
            $appConfigPath = $this->basePath('config') . DIRECTORY_SEPARATOR . $name . '.php';

            if (file_exists($appConfigPath)) {
                return $appConfigPath;
            } elseif (file_exists($path = $this->frameworkPath('config') . DIRECTORY_SEPARATOR . $name . '.php')) {
                return $path;
            }
        }

        return '';
    }

    /**
     * @author AdamTyn
     * @description 获取Lumen框架兜底目录路径
     *
     * @param string
     * @return string
     */
    private function frameworkPath(string $name = '')
    {
        $frameworkPath = $this->basePath('vendor/laravel/lumen-framework');

        return empty($name) ?
            $frameworkPath :
            $frameworkPath . DIRECTORY_SEPARATOR . $name;
    }
}
