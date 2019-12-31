<?php
/**
 * User
 * PHP version 7.2.0
 *
 * @category  View
 * @package   User
 * @author    Patricio Rojas Ortiz <patricio-rojaso@outlook.com>
 * @copyright 2019 (C) Copyright - Web Application development
 * @license   Private license
 * @version   GIT: <git_id>
 * @link      https://appwebd.github.io
 * @date      6/18/18 10:34 AM
 */

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Cookie Policy';
$this->params[BREADCRUMBS][] = $this->title;
?>
<div class="site-about">
    <h1><?php echo Html::encode($this->title); ?></h1>

    <p>
        This is the About page.
        You may modify the following file to customize its content:
    </p>

    <code><?php echo __FILE__ ?></code>
</div>
