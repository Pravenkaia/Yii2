<?php
/**
 *
 */
namespace app\modules\admin\assets;


use app\assets\AppAsset;
use yii\web\AssetBundle;

/**
 * Class AdminAssets
 * @package app\modules\admin\assets
 */
class AdminAssets extends AssetBundle
{
    public $sourcePath = __DIR__ . '/src';

    public $js = [
        'js/admin.js',
    ];

    public $depends = [
        AppAsset::class,
    ];



}