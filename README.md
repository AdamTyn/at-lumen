## About

```text
@author AdamTyn
@description 一个更适合开箱即用的 Lumen 封装
@updated_at 2020-09-29
```

## Usage

#### @开发环境
1. 指定目录下，使用 `composer create-project --prefer-dist adamtyn/at-lumen demo` 初始化一个 `demo` 项目
2. 上述指令会 **完整安装** 最新版本的 `adamtyn/at-lumen`（**完整安装** 包含了 `require-dev` 所定义的组件）
3. **完整安装**  的 `adamtyn/at-lumen` 默认已经在 **Lumen** 的基础上集成了以下组件

|                           Library                            |                         Description                          | Required | Version                                                   |
| :----------------------------------------------------------: | :----------------------------------------------------------: | :------: | --------------------------------------------------------- |
| [adamtyn/lumen-artisan-storage-link](https://github.com/AdamTyn/lumen-artisan-storage-link) | 移植Laravel的 `php artisan storage:link` [生成符号连接]指令到Lumen |    ✔     | [v1.0.1](https://github.com/AdamTyn/at-lumen/tree/v1.0.1) |
| [adamtyn/lumen-artisan-key-generate](https://github.com/AdamTyn/lumen-artisan-key-generate) | 移植Laravel的 `php artisan key:generate` [重置AppKey]指令到Lumen |    ✔     | [v1.0.0](https://github.com/AdamTyn/at-lumen/tree/v1.0.0) |
| [adamtyn/lumen-artisan-config-cache](https://github.com/AdamTyn/lumen-artisan-config-cache) | 移植Laravel的 `php artisan config:cache` [创建配置缓存文件]指令到Lumen |    ✔     | [v1.1.0](https://github.com/AdamTyn/at-lumen/tree/v1.1.0) |
| [adamtyn/lumen-artisan-config-clear](https://github.com/AdamTyn/lumen-artisan-config-clear) | 移植Laravel的 `php artisan config:clear` [清除配置缓存文件]指令到Lumen |    ✔     | [v1.1.0](https://github.com/AdamTyn/at-lumen/tree/v1.1.0) |
| [adamtyn/lumen-artisan-make-job](https://github.com/AdamTyn/lumen-artisan-make-job) | 移植Laravel的 `php artisan make:job` [快速创建任务]指令到Lumen |    ✖     | [v1.0.0](https://github.com/AdamTyn/at-lumen/tree/v1.0.0) |
| [adamtyn/lumen-artisan-make-model](https://github.com/AdamTyn/lumen-artisan-make-model) | 移植Laravel的 `php artisan make:model` [快速创建模型] 指令到Lumen |    ✖     | [v1.0.0](https://github.com/AdamTyn/at-lumen/tree/v1.0.0) |
| [adamtyn/lumen-artisan-serve](https://github.com/AdamTyn/lumen-artisan-artisan-serve) | 移植Laravel的 `php artisan serve` [快速启动服务]指令到**Lumen** |    ✖     | [v1.0.0](https://github.com/AdamTyn/at-lumen/tree/v1.0.0) |

4. 刚创建的 **Lumen** 应用，应该执行 `php artisan key:generate` 为应用创建一个 `AppKey` 用以框架加密函数的密钥

#### @生产环境

1. 上线部署代码时，建议使用 `composer install --no-dev` 指令安装依赖，可以避免生产环境加载 **过多非必要** 组件
2. 耐心等待 `composer` 组件安装完成后，必须确认应用根目录是否存在 `.env` 文件，若不存在可以执行 `copy .env.example .env` 生成包含默认内容的文件
3. 生产环境首次部署一个 **Lumen** 应用时，除了需要执行 [@开发环境-4](#) 的步骤，还一定要注意执行 `php artisan storage:link` 为应用创建一个 `public/storage => storage/app/public` 的 **符号连接**，目的是方便分配目录权限
4. 当做完所有准备工作，最后就要调整 `.env` 文件中相关的 **环境变量**

```ini
APP_ENV=production
APP_KEY=H+HOlDl8yODdwUQEPX3xMbmj5MvUHFDeeuz9Yi95ZiA=
APP_DEBUG=false
APP_TIMEZONE=PRC
APP_LOCALE=zh_cn
# has more...
```

6. 特别的，如果开发时用到了上述表格中的部分 `require-dev` 依赖，那么在生产环境的代码中一定要 **判断代码环境**

```php
<?php

protected function getCommands()
{
  if (config('app.env') === 'local') {
    $this->commands[] = \AdamTyn\Lumen\Artisan\ServeCommand::class;
    $this->commands[] = \AdamTyn\Lumen\Artisan\JobMakeCommand::class;
    $this->commands[] = \AdamTyn\Lumen\Artisan\ModelMakeCommand::class;
  }

  return parent::getCommands();
}
```

7. 实际上，核心文件都应该 **针对不同代码环境有不同的逻辑**


## Log

**[2020-09-24]** *发布v1.0.0版本*

**[2020-09-27]** *发布v1.0.1版本：修复artisan指令在生产环境的隐患*

**[2020-09-28]** *发布v1.1.0版本：新增 `php artisan config:cache` & `php artisan config:clear` 两个artisan指令*

**[2020-09-29]** *发布v1.2.0版本：添加框架入口核心类 `bootstrap/core.php` 文件，支持加载配置缓存文件 `bootstrap/cache/config.php`了!*

```php
<?php

use Laravel\Lumen\Application as Lumen;

final class Core extends Lumen
{
    public function __construct($basePath = null)
    {
        // 加载配置缓存文件
        $this->loadCachedConfig();

        parent::__construct($basePath);
    }
}
```

**[2020-10-09]** *发布v1.2.1版本：新增框架入口核心类 `bootstrap/core.php` 文件，判断是否读取了配置缓存文件*

```php
<?php

use Laravel\Lumen\Application as Lumen;

final class Core extends Lumen
{
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
}
```

