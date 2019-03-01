<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php

    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => Yii::t('app', 'Home'), 'url' => ['/site/index']],
            ['label' => Yii::t('app', 'Activities'), 'url' => ['/activity/']],
            ['label' => Yii::t('app', 'Create Activity'), 'url' => ['/activity/create']],

            Yii::$app->user->isGuest ? (
            ['label' => Yii::t('app', 'Personal account'), 'url' => ['/users/']]
            ) : (
            ['label' => Yii::t('app', 'Personal account'),
                'url' => ['/users/'],
                'items' => [
                    ['label' => Yii::t('app', 'My activities'), 'url' => ['/activity/']],
                    ['label' => Yii::t('app', 'Create Activity'), 'url' => ['/activity/create']],
                    ['label' => Yii::t('app', 'My account'), 'url' => ['/users/']],
                ]]),

            ['label' => Yii::t('app', 'Registration'), 'url' => ['/auth/sign-up']],
            ['label' => Yii::t('app', 'Authorization'), 'url' => ['/auth/sign-in']],
            //  ['label' => Yii::t('app', 'About'), 'url' => ['/site/about']],
            //  ['label' => Yii::t('app', 'Contact'), 'url' => ['/site/contact']],
            //  ['label' => Yii::t('app', 'Hello'), 'url' => ['/site/hello']],

            Yii::$app->user->can('admin') ? (
            ['label' => Yii::t('app', 'Admin'),
                'url' => ['admin'],
                'items' => [
                    ['label' => Yii::t('app', 'Activities'), 'url' => ['/admin/activity']],
                    ['label' => Yii::t('app', 'Users'), 'url' => ['/admin/users']]
                ]]) : (''),

            Yii::$app->user->isGuest ? (
            ['label' => 'Login', 'url' => ['/auth/sign-in']]
                // было ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>


    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>

        <div class="panel panel-info">
            <div class="panel-body">
                <?= Yii::$app->request->hostName . Yii::$app->session->getFlash('userPage'); ?>
            </div>
            <br>
        </div>

        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
