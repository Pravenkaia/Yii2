<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 04.02.2019
 * Time: 16:47
 */

namespace app\components;


use Exception;
use Yii;
use yii\base\Component;
use app\rbac\AuthorActivityRule;

class RbacComponent extends Component
{
    const ROLE_USER='user';

    /**
     *  это деалется в консоли, пока не проходили
     * @return \yii\rbac\ManagerInterface
     */
    public function getAuthManager() {
        return Yii::$app->authManager;
    }

    /**
     * это деалется в консоли, пока не проходили
     * @throws Exception
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

        $authorActivityRule = new AuthorActivityRule();
        $authManager->add($authorActivityRule);

        $authorActivityPermission = $authManager->createPermission('authorActivity');
        $authorActivityPermission->description = 'Автор-создатель события';
        $authorActivityPermission->ruleName = $authorActivityRule->name;

        $authManager->add($authorActivityPermission);

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
        $authManager->addChild($user,$authorActivityPermission);
        $authManager->addChild($admin,$user);
        $authManager->addChild($admin,$viewEditAllActivity);

// при регистрации  нового пользователя назначение user происходит по default
// т.к. создавли новое правило с новым рзрешением, то снова переназначаем.
// //Раз все удаляется нафиг
        $authManager->assign($admin,2);
        $authManager->assign($user, 1);
        $authManager->assign($user, 3);
        $authManager->assign($user, 4);
        $authManager->assign($user, 5);
        $authManager->assign($user, 6);


    }

    /**
     * Присвоение роли пользователю
     * @param $role_name
     * @param $user_id
     * @return bool
     * @throws Exception
     */
    public function assignRole($role_name,$user_id){
        $userRole = Yii::$app->authManager->getRole($role_name);
        // \Yii::$app->authManager->assign($userRole, Yii::$app->user->getId());
        if(!$userRole){
            throw new Exception('Role '.$role_name.' not exist');
        }
        if($this->getAuthManager()->assign($userRole, $user_id)){
            return true;
        }
        return false;
    }

    public function assignUserRole($user_id){
        return $this->assignRole(self::ROLE_USER,$user_id);
    }
}