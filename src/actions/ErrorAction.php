<?php

namespace app\src\actions;

use yii\web\ErrorAction as WebErrorAction;

class ErrorAction extends WebErrorAction
{
    public $view = 'error.php';
    public $layout = 'error.php';
}
