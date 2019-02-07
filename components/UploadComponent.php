<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 06.02.2019
 * Time: 13:56
 */

namespace app\components;


use yii\base\Action;
use yii\helpers\FileHelper;
use yii\web\HttpException;


class UploadComponent extends Action
{
    public function run( $file, $fold = '@app/uploads/')
    {
        if (!$file)
            return false;
        $path = \Yii::getAlias($fold);
        if (!FileHelper::createDirectory($path)) {
            throw new HttpException('Не удалось создать папку по адресу ' . $path);
        }


        $file->saveAs($path . 'doc_' . date('d-m-Y', time()) . '.' . $file->extension);

        return true;
    }
}