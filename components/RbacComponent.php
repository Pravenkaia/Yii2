<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 04.02.2019
 * Time: 16:47
 */

namespace app\components;

use Yii;
use yii\console\Controller;
use yii\base\Component;


class RbacComponent extends Component
{
    /**
     *  это деалется в консоли, пока не проходили
     * @return \yii\rbac\ManagerInterface
     */
    public function getAuthManager() {
        return \Yii::$app->authManager;
    }

    /**
     * это деалется в консоли, пока не проходили
     * @throws \Exception
     */
    public function generateRules() {
        $authManager = $this->getAuthManager();
        $authManager->removeAll();

        $admin = $authManager->createRole('admin');
        $user  = $authManager->createRole('user');
        $guest = $authManager->createRole('guest');

        $authManager->add($admin);
        $authManager->add($user);
        $authManager->add($guest);

        $createActivity = $authManager->createPermission('createActivity');
        $createActivity->description = 'Создание события';

        $viewActivity = $authManager->createPermission('viewActivity');
        $viewActivity->description = 'Просмотр события';

        $viewEditAllActivity = $authManager->createPermission('viewEditAllActivity');
        $viewEditAllActivity->description = 'Просмотр и редактирование всех событий';

        $authManager->add($viewEditAllActivity);
        $authManager->add($createActivity);
        $authManager->add($viewActivity);

        $authManager->addChild($guest,$viewActivity);
        $authManager->addChild($user,$guest);
        $authManager->addChild($user,$createActivity);
        $authManager->addChild($admin,$user);
        $authManager->addChild($admin,$viewEditAllActivity);


        $authManager->assign($admin,25);
        $authManager->assign($user, 1);
        $authManager->assign($user, 26);
        $authManager->assign($user, 27);


    }
}