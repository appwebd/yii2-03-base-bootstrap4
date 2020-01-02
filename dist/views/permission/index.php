<?php
/**
 * Permission
 *
 * @package     Index of Permission
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
use app\models\queries\Common;
use app\models\search\ActionSearch;
use app\models\search\ControllersSearch;
use app\models\search\ProfileSearch;
use yii\grid\GridView;
use yii\helpers\Html;
use app\models\queries\Bitacora;
use \app\components\UiButtons;

/* @var object $searchModelPermission app\models\search\PermissionSearch */
/* @var object $dataProviderPermission yii\data\ActiveDataProvider */
/* @var int $pageSize  */
/* @var int $controller_id */


$this->title = Yii::t('app', Permission::TITLE);
$this->params[BREADCRUMBS][] = $this->title;

echo Html::beginForm(['permission/index'] );

$common = new Common();
$uiButtons = new UiButtons();
$uicomponent = new UiComponent();
$uicomponent->cardHeader(
    Permission::ICON,
    ' white ',
    $this->title,
    Yii::t('app', 'This view permit Create, update or delete information related of permission')
);
//$controller_id = 1;
try {
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => GRIDVIEW_LAYOUT,
        'filterSelector' => 'select[name="per-page"]',
        'tableOptions' => [STR_CLASS => GRIDVIEW_CSS],
        'columns' => [
            [STR_CLASS => GRID_CHECKBOXCOLUMN, 'options' => [STR_CLASS => 'width10px']],
            [
                STR_CLASS => GRID_DATACOLUMN,
                ATTRIBUTE => Permission::PROFILE_ID,
                FILTER => ProfileSearch::getProfileListSearch(Permission::TABLE),
                VALUE => 'profile.profile_name',
                FORMAT => 'raw',
            ],
            [
                STR_CLASS => GRID_DATACOLUMN,
                ATTRIBUTE => Permission::CONTROLLER_ID,
                FILTER => ControllersSearch::getControllersListSearch(Permission::TABLE),
                VALUE => 'controllers.controller_name',
                FORMAT => 'raw',
            ],
            [
                STR_CLASS => GRID_DATACOLUMN,
                ATTRIBUTE => Permission::ACTION_ID,
                FILTER => ActionSearch::getActionListSearch($controller_id, Permission::TABLE),

                VALUE => 'action.action_name',
                FORMAT => 'raw',
            ],

            [
                STR_CLASS => GRID_DATACOLUMN,
                FILTER => UiComponent::yesOrNoArray(),
                ATTRIBUTE => Permission::ACTION_PERMISSION,
                OPTIONS => [STR_CLASS => COLSM1],
                VALUE => function ($model) {
                    $uiComponent = new UiComponent();
                    $url = 'permission/toggle';
                    return Html::a(
                        '<span class="' . $uiComponent->yesOrNoGlyphicon($model->action_permission) . '"></span>',
                        $url,
                        [
                            'title' => Yii::t('yii', 'Toggle value active'),
                            'data-value' => $model->action_permission,
                            'data' => [
                                METHOD => 'post',
                            ],
                            'data-pjax' => 'w0',
                        ]
                    );
                },
                FORMAT => 'raw'
            ],

            [
                STR_CLASS => GRID_ACTIONCOLUMN,
                BUTTONS => $uiButtons->buttonsActionColumn(),
                'contentOptions' => [STR_CLASS => 'GridView'],
                HEADER => UiComponent::pageSizeDropDownList($pageSize),
                'headerOptions' => ['style' => 'color:#337ab7'],
                TEMPLATE => $common->getProfilePermissionString('111'),
            ]
        ]
    ]);
} catch (Exception $exception) {
    $bitacora = new Bitacora();
    $bitacora->registerAndFlash(
        $exception,
        'app/views/permission::GridView::widget',
        MSG_ERROR
    );
}

try {

    $strButtons = $uiButtons->buttonsAdmin('111', false);
    $uicomponent->cardFooter($strButtons);
} catch (Exception $exception) {
    $bitacora = new Bitacora();
    $bitacora->register(
        $exception,
        'app/views/permission',
        MSG_ERROR
    );
}
echo Html::endForm();

