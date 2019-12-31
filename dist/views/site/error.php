<?php
/**
 * /**
 * Error
 * PHP version 7.2.0
 *
 * @category  View
 * @package   Site
 * @author    Patricio Rojas Ortiz <patricio-rojaso@outlook.com>
 * @copyright 2019 (C) Copyright - Web Application development
 * @license   Private license
 * @version   GIT: <git_id>
 * @link      https://appwebd.github.io
 * @date      6/18/18 10:34 AM
 */

use app\components\UiComponent;
use app\models\queries\Bitacora;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = Yii::t('app', 'Error');
$this->params[BREADCRUMBS][] = $this->title;

$error = nl2br(Html::encode($message . ' url: ' . Yii::$app->request->url));

$bitacora = new Bitacora();
$bitacora->register($error, 'app\views\site\error.php', MSG_ERROR);

$uiComponent = new UiComponent();
$uiComponent->cardHeader(
    'fas fa-exclamation-triangle',
    ' card-header-background-error  ',
    'Error',
    ' ',
    '000',
    false
);

echo '<div class="row-fluid">
    <div class="col-sm-12">

<h2 class=" danger error-summary font-weight-bold text-left">',
nl2br(Html::encode($message)),
'</h2>';

echo '<br><p>',
Yii::t(
    'app',
    'The above error occurred while the Web server was processing your request.
            We are generating a record status of this error. Thank you.'
), '</p>
</div></div>
';


try {
    $strButtons = '';
    $uiComponent->cardFooter($strButtons);
} catch (Exception $exception) {
    $bitacora = new Bitacora();
    $bitacora->register(
        $exception,
        'app\views\site\error.php::cardFooter',
        MSG_ERROR
    );
}

