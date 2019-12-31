<?php
/**
 * Site
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
use yii\helpers\Html;

/* @var yii\web\View $this */


$this->title = Yii::t('app', 'Website in maintenance');
$this->params[BREADCRUMBS][] = $this->title;

?>
<h1>Maintenance</h1>
<div class="level ">
    <div class="level-item columns">
        <div class="column is-half">

            <h1>
                <?php
                    echo Html::encode($this->title);
                ?>
            </h1>
            <br>
            <p>
<?php
    echo
    Yii::t(
        'app',
        'We are sorry, but the application is currently being maintained.'
    ),
    '<br>',
    Yii::t(
        'app',
        'Please try again later.'
    );
?>
            </p>
            <br>

        </div>
    </div>
</div>

