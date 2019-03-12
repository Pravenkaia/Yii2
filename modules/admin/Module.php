<?php

namespace app\modules\admin;

use yii\base\Application;
use yii\base\BootstrapInterface;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module implements BootstrapInterface
{
    public $layout = 'main';
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        if($app instanceof \yii\console\Application) {
            $this->controllerNamespace = 'app\modules\admin\commands';
        }
    }
}
