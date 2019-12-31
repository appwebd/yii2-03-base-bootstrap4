<?php
/**
 * Class UiComponent
 * PHP version 7.2.0
 *
 * @category  Components
 * @package   Ui
 * @author    Patricio Rojas Ortiz <patricio-rojaso@outlook.com>
 * @copyright 2019 (C) Patricio Rojas Ortiz
 * @license   Private license
 * @version   SVN: $Id$
 * @release   1.0.0
 * @link      https://appwebd.github.io
 * @date      06/28/18 02:33 PM
 */

namespace app\components;

use app\controllers\BaseController;
use app\models\queries\Bitacora;
use app\models\Status;
use Exception;
use Yii;
use yii\base\Component;
use yii\helpers\Html;

/**
 * Class UiComponent
 * PHP version 7.2.0
 *
 * @category  Components
 * @package   Ui
 * @author    Patricio Rojas Ortiz <patricio-rojaso@outlook.com>
 * @copyright 2019 (C) Copyright - Patricio Rojas Ortiz
 * @license   Private license
 * @version   Release: <package_version>
 * @release   1.0.0
 * @link      https://appwebd.github.io
 * @date      11/1/18 11:01 AM
 */
class UiComponent extends Component
{
    const HTML_TOOLTIP = ' tooltip ';
    const HTML_DATA_TOGGLE = 'data-toggle';
    const HTML_DATA_PLACEMENT = 'data-placement';
    const HTML_DATA_PLACEMENT_VALUE = 'top';

    const HTML_SPACE = '&nbsp;';
    const STR_PER_PAGE = 'per-page';



    /**
     * Return the html badget status
     *
     * @param int    $statusId number equivalent of badget status
     * @param string $status   Description or comment of status
     *
     * @return string
     */
    public static function badgetStatus($statusId, $status)
    {
        $badge = Status::getStatusBadge($statusId);
        return '<span class="badge badge-' . $badge . '">' . $status . '</span>';
    }

    /**
     * Close a card style function
     *
     * @param string $footer buttons links or message in footer of card.
     *
     * @return void
     */
    public function cardFooter($footer)
    {
        echo HTML_DIV_CLOSE;

        if (strlen($footer) !=='') {
            echo '<div class="card-footer ">',
            $footer,
            HTML_DIV_CLOSE;
        }

        echo HTML_DIV_CLOSE;
    }

    /**
     * Return an array with the yes/not values
     *
     * @return array
     */
    public static function yesOrNoArray()
    {
        return [1 => Yii::t('app', 'Yes'), 0 => 'No'];
    }

    /**
     * Show Yes or No given a boolean value
     *
     * @param bool $boolean boolean 1 or 0 values.
     *
     * @return string yes or no
     */
    public static function yesOrNo($boolean)
    {
        return $boolean === 1 ? Yii::t('app', 'Yes') : 'No';
    }

    /**
     * Show grlyphicon of yes/not in the view
     *
     * @param bool $boolean boolean 1 or 0 values.
     *
     * @return string
     */
    public function yesOrNoGlyphicon($boolean)
    {
        return $boolean ?
            'glyphicon glyphicon-ok-circle'
            :
            'glyphicon glyphicon-remove-circle';
    }

    /**
     * Show page header and navigation buttons of the index page.
     *
     * @param string $icon         Icon header
     * @param string $color        color header
     * @param string $pageTitle    Title of view
     * @param string $subHeader    Subtitle of view
     * @param string $showButtons  111 means (in correlative order)
     *                             1:Show button New
     *                             1: Show button Refresh
     *                             1: Show button Delete
     * @param bool   $showPageSize Show pageSize in header of view
     *
     * @return void
     */
    public function cardHeader(
        $icon = 'user',
        $color = ' card-header-background-gray ',
        $pageTitle = 'User',
        $subHeader = 'Users',
        $showButtons = '111',
        $showPageSize = false
    ) {
        echo '<div class="card ">
                 <div class="card-header ', $color, '">
                    <div class="float-left  ', $color, ' ">',
        '<h4 class=" card-title d-inline font-weight-bold ">',
        '<i class="', $icon, '  "></i>', self::HTML_SPACE, $pageTitle,
        '</h4>
                    </div>';

        if ($showButtons > 0) {
            try {
                $uiButtons = new UiButtons();
                echo '<div class="   float-right">';
                $uiButtons->buttonsAdmin($showButtons);
                echo HTML_DIV_CLOSE;
            } catch (Exception $exception) {
                $bitacora = new Bitacora();
                $bitacora->register(
                    $exception,
                    'app\components\UiComponent::buttonsAdmin',
                    MSG_ERROR
                );
            }
        }

        if ($showPageSize) {
            $page_size = BaseController::pageSize();
            echo '<div class="  float-right">',
            self::pageSizeDropDownList($page_size), HTML_DIV_CLOSE;
        }


        echo '</div>
              <div class="card-body card-text">
                <span class=" card-subtitle font-weight-lighter text-muted">',
        $subHeader,
        '</span><br><br>';
    }

    /**
     * Show pageSize Dropdown in view
     *
     * @param int $pageSize numbers of rows to show per page in gridView.
     *
     * @return string
     */
    public static function pageSizeDropDownList($pageSize)
    {
        return '<div class="select " >' .
            Html::dropDownList(
                self::STR_PER_PAGE,
                $pageSize,
                array(5 => 5,
                    10 => 10,
                    15 => 15,
                    25 => 25,
                    40 => 40,
                    65 => 65,
                    105 => 105,
                    170 => 170,
                    275 => 275,
                    445 => 445),
                array(
                    'id' => self::STR_PER_PAGE,
                    //'onChange' => 'js:window.location.reload(true)',
                    'onChange' => 'js:window.location.submit()',
                    STR_CLASS => ' ',
                    self::HTML_DATA_TOGGLE => self::HTML_TOOLTIP,
                    self::HTML_DATA_PLACEMENT => self::HTML_DATA_PLACEMENT_VALUE,
                )
            ) . HTML_DIV_CLOSE;
    }
}
