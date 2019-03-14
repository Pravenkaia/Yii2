<?php


namespace app\base;


use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\mail\MailerInterface;

class StartBootstrap implements BootstrapInterface
{

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        echo 'start bootstrap' . PHP_EOL;
        //как в лекции. У меня не работает. Т.к. я нигде этот класс не использую, объект не создаю...
        //не помню, где в лекциях что-то ссылается на этот класс
        \Yii::$container->setDefinitions([MailerInterface::class =>
            function(){
            return \Yii::$app->mailer;
        }]);
    }
}