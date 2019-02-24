<?php
use yii\widgets\Menu;
?>


    <?=\yii\widgets\Menu::widget([
    'items' => [
        ['label' => Yii::t('app', 'Activities'), 'url' => ['activity/index']],
        ['label' => Yii::t('app', 'Users'), 'url' => ['users/index']],
    ],
]);?>




<div class="admin-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>
        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.
    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    </p>
</div>
