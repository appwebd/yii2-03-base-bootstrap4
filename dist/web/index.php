<?php
/**
 * base-bootstrap4
 *
 * @package     base-bootstrap4
 * @author      Patricio Rojas Ortiz <patricio-rojaso@outlook.com>
 * @copyright   (C) Copyright - Web Application development
 * @license     Private comercial license
 * @link        https://appwebd.github.io
 * @date        2018-09-03 14:50:33
 * @version     1.0
 */

require __DIR__ . '/constant.php';

// END GLOBAL CONSTANTS of this web application --------------------------------------------------

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
