<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 24.01.2019
 * Time: 21:14
 */

namespace app\controllers;


use app\base\BaseController;
use app\controllers\actions\ActivityIndexAction;


class ActivityController extends BaseController
{
    /**
     * @return array
     * переопределяем
     */
   public function actions()
   {
       return [
           'index' => ['class' => ActivityIndexAction::class,
               'settings' => 'param'
           ],
           'index1' => ActivityIndexAction::class,

       ];
   }
}