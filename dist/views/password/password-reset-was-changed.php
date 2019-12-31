<?php
/**
 * Password reset was changed (confirmation)
 * PHP version 7.2.0
 *
 * @category  View
 * @package   Password
 * @author    Patricio Rojas Ortiz <patricio-rojaso@outlook.com>
 * @copyright 2019 (C) Copyright - Web Application development
 * @license   Private license
 * @version   GIT: <git_id>
 * @link      https://appwebd.github.io
 * @date      6/18/18 10:34 AM
 */

use app\components\UiComponent;
use app\models\User;

/* @var yii\web\View $this */
/* @var User $model */

$this->title = Yii::t('app', 'Password was updated');
$this->params[BREADCRUMBS][] = $this->title;

echo '
<div class="container ">
    <div class="row">
        <div class="col-sm-3 "> &nbsp; </div>
        <div class="col-sm-6 box">';

$uiComponent = new UiComponent();
$uiComponent->cardHeader(
    'lock',
    'color-red',
    $this->title,
    Yii::t('app', 'The password used at this platform was updated successfully'),
    '000'
);

echo '<div class="is-success"><h4>',
Yii::t('app', 'Password was updated'),
'<br/><br/><br/></h4></div>';

$footer = Yii::$app->view->render('@app/views/partials/_links_return_to');
$uiComponent->cardFooter($footer);

echo '
        </div>
        <div class="col-sm-3 "> &nbsp; </div>
    </div>
</div>';
