<?php

namespace app\commands;

use app\rbac\AuthorRule;
use Yii;
use yii\console\Controller;
use yii\rbac\DbManager;

class RbacController extends Controller
{
  public function actionInit()
  {
    $auth = new DbManager();  
    $auth->removeAll();  
    
    $admin = $auth->createRole('admin');
    $auth->add($admin);

    $user = $auth->createRole('user');
    $auth->add($user);
    
    $createOffer = $auth->createPermission('createOffer');
    $createOffer->description = 'Добавить обьявление';
    $auth->add($createOffer);
    $auth->addChild($user, $createOffer);

    $controlOffer = $auth->createPermission('controlOffer');
    $controlOffer->description = 'Контроль обьявления';
    $auth->add($controlOffer);
    $auth->addChild($admin, $controlOffer);

    $rule = new AuthorRule();
    $auth->add($rule);

    $controlOwnOffer = $auth->createPermission('controlOwnOffer');
    $controlOwnOffer->description = 'Контроль собственного обьявления';
    $controlOwnOffer->ruleName = $rule->name;
    $auth->add($controlOwnOffer);

    $auth->addChild($controlOwnOffer, $controlOffer);
    $auth->addChild($user, $controlOwnOffer);
    $auth->addChild($admin, $user);

    $auth->assign($user, 9);
    $auth->assign($admin, 8);

   
  }

}