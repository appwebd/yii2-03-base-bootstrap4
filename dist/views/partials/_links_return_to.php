<?php
/**
 * Links view "return to" view
 * PHP version 7.2.0
 *
 * @category  View
 * @package   Partials
 * @author    Patricio Rojas Ortiz <patricio-rojaso@outlook.com>
 * @copyright 2019 (C) Copyright - Web Application development
 * @license   Private license
 * @version   GIT: <git_id>
 * @link      https://appwebd.github.io
 * @date      6/18/18 10:34 AM
 */
use yii\helpers\Html;

echo '
<div class="text-center help-block">';
echo Yii::t('app', 'Return to:'), '
        &nbsp;',
Html::a(Yii::t('app', 'Login'), ['login/']), '.&nbsp; | &nbsp;',
Html::a(Yii::t('app', 'Home'), ['/']), '.',
'</div>';
