<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 29.01.2019
 * Time: 22:50
 */

namespace app\modules\activity\controllers;

use app\base\BaseController;

/**
 * Default controller for the `activity` module
 */
class DefaultController extends BaseController
{
    /**
     * Renders the index view for the module
     * @return object
     */
     public function actionIndex()
     {
         return $this->render('index');
     }


}