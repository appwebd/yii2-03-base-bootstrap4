<?php
/**
 * Permission
 *
 * @package     View of Permission
 * @author      Patricio Rojas Ortiz <patricio-rojaso@outlook.com>
 * @copyright   (C) Copyright - Web Application development
 * @license     Private license
 * @link        https://appwebd.github.io
 * @date        2018-07-30 19:28:34
 * @version     1.0
 */

use app\components\UiComponent;
use app\controllers\BaseController;
use app\models\Permission;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Permission */

$this->title = Yii::t('app', Permission::TITLE);
$this->params[BREADCRUMBS][] = ['label' => $this->title, 'url' => ['index']];


UiComponent::cardHeader(
    Permission::ICON,
    ' white ',
    $this->title,
    Yii::t('app', 'This view permit view detailed information of Permission'),
    '000',
    false
);

try {
    echo DetailView::widget([
        'model' => $model,
        OPTIONS => [STR_CLASS => DETAILVIEW_CLASS],
        'attributes' => [
            [
                ATTRIBUTE => Permission::PROFILE_NAME,
                VALUE => function ($model) {
                    return $model->profile->profile_name;
                },
            ],
            [
                ATTRIBUTE => Permission::CONTROLLER_ID,
                VALUE => function ($model) {
                    return $model->controllers->controller_name;
                },
            ],
            [
                ATTRIBUTE => Permission::ACTION_ID,
                VALUE => function ($model) {
                    return $model->action->action_name;
                },
            ],
            [
                ATTRIBUTE => Permission::ACTION_PERMISSION,
                OPTIONS => [STR_CLASS => COLSM1],
                VALUE => function ($model) {
                    return UiComponent::yesOrNo($model->action_permission);
                },
                FORMAT => 'raw'
            ],
        ],
    ]);
} catch (Exception $exception) {
    BaseController::bitacora(
        Yii::t(
            'app',
            'Failed to show information, error: {error}',
            ['error' => $exception]
        ),
        MSG_ERROR
    );
}
try {
    $strButtons = UiComponent::buttonsViewBottom($model);
    UiComponent::cardFooter($strButtons);
} catch (Exception $exception) {
    BaseController::bitacoraAndFlash(
        Yii::t(
            'app',
            ERROR_MODULE,
            [
                MODULE => 'app\views\permission\view::buttonsAdmin::widget',
                ERROR => $exception
            ]
        ),
        MSG_ERROR
    );
}
