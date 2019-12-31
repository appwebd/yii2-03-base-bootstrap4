<?php
/**
 * Confirmed email view
 * PHP version 7.2.0
 *
 * @category  View
 * @package   Login
 * @author    Patricio Rojas Ortiz <patricio-rojaso@outlook.com>
 * @copyright 2019 (C) Copyright - Web Application development
 * @license   Private license
 * @version   GIT: <git_id>
 * @link      https://appwebd.github.io
 * @date      6/18/18 10:34 AM
 */
use app\components\UiComponent;

$this->title = Yii::t('app', 'Email confirmation');
$this->params[BREADCRUMBS][] = $this->title;

echo '
<div class="level">
    <div class="level-item columns ">
        <div class="column is-half">';
$uiComponent = new UiComponent();
$uiComponent->cardHeader(
    'fas fa-envelope fa-2x',
    'card-header-background-gray',
    $this->title,
    '',
    '000'
);

echo '<div class="has-text-success has-text-centered"><h4>',
Yii::t('app', 'Email confirmation success'),
'<br/><br/><br/></h4></div>';

$footer = Yii::$app->view->render('@app/views/partials/_links_return_to');
$uiComponent->cardFooter($footer);

echo '
        </div>
    </div>
</div>';
