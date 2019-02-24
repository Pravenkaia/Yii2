<?php
/**
 * Created by PhpStorm.
 * User: pravl
 * Date: 12.02.2019
 * Time: 22:52
 */
namespace app\rbac;
use \yii\rbac\Item;

/**
 * Class AuthorActivityRule
 * @package app\rbac
 */
class AuthorActivityRule extends \yii\rbac\Rule
{

    public $name = 'authorActivityRule';
    /**
     * Executes the rule.
     *
     * @param string|int $user the user ID. This should be either an integer or a string representing
     * the unique identifier of a user. See [[\yii\web\User::id]].
     * @param \yii\rbac\Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to [[CheckAccessInterface::checkAccess()]].
     * @return bool a value indicating whether the rule permits the auth item it is associated with.
     */
    public function execute($user, $item, $params)
    {
        // TODO: Implement execute() method.
        return isset($params['activity']) ? $params['activity']->id_user ==  $user : false;
    }
}