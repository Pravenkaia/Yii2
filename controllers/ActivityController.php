<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 24.01.2019
 * Time: 21:14
 */

namespace app\controllers;


use app\base\BaseController;
use app\controllers\actions\ActivityDeleteAction;
use app\controllers\actions\ActivityFormAction;
use app\controllers\actions\ActivityIndexAction;
use app\controllers\actions\ActivityView;
use app\controllers\actions\SubmitAction;

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
           'create' => ActivityFormAction::class,
           'submit' => SubmitAction::class,
           'view' => ActivityView::class,
           'update' => ActivityFormAction::class,
           'delete' => ActivityDeleteAction::class,
       ];
   }
}