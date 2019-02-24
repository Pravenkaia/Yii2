<?php


namespace app\modules\admin\commands;


use yii\console\Controller;
use yii\helpers\Console;

/**
 * Class AdminController
 * @package app\modules\admin\commands
 */
class AdminController extends Controller
{
    public function actionIndex() {
        echo $this->ansiFormat('This is admin module', Console::BG_GREEN) . PHP_EOL;
    }

}