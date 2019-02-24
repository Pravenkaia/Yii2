<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 29.01.2019
 * Time: 23:24
 */

namespace app\modules\activity\controllers;


use app\base\BaseController;


class IndexController extends BaseController
{
    /**
     * Renders the index view for the module
     * @return object
     */
    public function actionIndex()
    {

        return $this->render('@activity/views/default/index');
    }


}

