<?php

namespace app\modules\activity\controllers;
use app\base\BaseController;

class ActivityFormController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('activity_form/index');
    }

    public function actionSubmit()
    {
        return $this->render('activity_form/submit');
    }

}
