<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 27.01.2019
 * Time: 21:39
 */

namespace app\modules\activity\controllers\actions;


//use app\modules\activity\models\Activity;
use yii\base\Action;


class PampamAction extends  Action
{
    public function run()
    {
        return $this->controller->render('index');
    }
}