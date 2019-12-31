<?php
/**
 * Class UiButtons
 * PHP version 7.2.0
 *
 * @category  Ui
 * @package   Components
 * @author    Patricio Rojas Ortiz <patricio-rojaso@outlook.com>
 * @copyright 2019 (C) Patricio Rojas Ortiz
 * @license   Private license
 * @version   GIT: <git_id>
 * @link      https://appwebd.github.io
 * @date      06/28/18 02:33 PM
 */

namespace app\components;

use app\controllers\BaseController;
use app\models\queries\Bitacora;
use app\models\queries\Common;
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
 * @link      https://appwebd.github.io
 * @date      11/1/18 11:01 AM
 */
class UiButtons extends Component
{
    const BUTTON_ICON_WITH_TEXT = true;
    const BUTTON_ICON_BACK_INDEX = '<i class="fas fa-list"></i>&nbsp;';
    const BUTTON_ICON_DELETE = '<i class="fas fa-trash"></i>&nbsp;';
    const BUTTON_ICON_NEW = '<i class="fas fa-plus"></i>&nbsp;';
    const BUTTON_ICON_REFRESH = '<i class="fas fa-sync-alt"></i>&nbsp;';
    const BUTTON_ICON_UPDATE = '<i class="fas fa-pencil-alt"></i>&nbsp;';
    const BUTTON_ICON_SAVE = '<i class="fas fa-save"></i>&nbsp;';
    const BUTTON_TEXT_BACK_INDEX = 'Back to admin list';
    const BUTTON_TEXT_NEW = 'New';
    const BUTTON_TEXT_DELETE = 'Delete';
    const BUTTON_TEXT_REFRESH = 'Refresh';
    const BUTTON_TEXT_UPDATE = 'Update';
    const BUTTON_TEXT_SAVE = 'Save';
    const BUTTON_TEXT_TOOLTIP = 'Create a new record';
    const CSS_BTN_DEFAULT = 'btn btn-outline-default ';
    const CSS_BTN_PRIMARY = 'btn btn-primary ';
    const CSS_BTN_DANGER = 'btn btn-outline-danger';

    const HTML_SPACE = '&nbsp;';
    const HTML_DATA_PJAX = 'data-pjax';
    const HTML_TITLE = 'title';
    const HTML_DATA_TOGGLE = 'data-toggle';

    const HTML_DATA_PLACEMENT = 'data-placement';
    const HTML_DATA_PLACEMENT_VALUE = 'top';
    const HTML_TOOLTIP = ' tooltip ';
    const STR_CONFIRM = 'confirm';

    /**
     * Show icon action column in grid view Widget
     *
     * @return array
     */
    public static function buttonsActionColumn()
    {
        return [
            ACTION_VIEW => function ($url, $model, $key) {
                return self::getUrlButtonAction(
                    ACTION_VIEW_ICON,
                    '/view',
                    $key,
                    'Show more details'
                );
            },

            ACTION_UPDATE => function ($url, $model, $key) {
                return self::getUrlButtonAction(
                    ACTION_UPDATE_ICON,
                    '/update',
                    $key,
                    'Update'
                );
            },
            ACTION_DELETE => function ($url, $model, $key) {
                $url_value = Yii::$app->controller->id . '/delete';
                return Html::a(
                    '<i class="' . ACTION_DELETE_ICON . '" aria-hidden="true"></i>',
                    [
                        $url_value,
                        'id' => BaseController::stringEncode($key)
                    ],
                    [
                        'data-tooltip' => Yii::t(
                            'app',
                            'Delete record'
                        ),
                        self::HTML_DATA_PJAX => '0',
                        'data-confirm' => Yii::t(
                            'yii',
                            'Are you sure you want to delete?'
                        ),
                        'data-method' => 'post',
                    ]
                );
            }
        ];
    }

    /**
     * Get Buttons action for action in gridview
     *
     * @param string $icon Icon style for example glyphicon glyphicon-eye-open
     * @param string $url Url
     * @param string $key key encoded
     * @param string $title title of links
     *
     * @return string
     */
    public static function getUrlButtonAction($icon, $url, $key, $title)
    {
        $url_value = Yii::$app->controller->id . $url;
        return Html::a(
            '<i class="' . $icon . '" aria-hidden="true"></i>',
            [
                $url_value,
                'id' => BaseController::stringEncode($key)
            ],
            [
//               STR_CLASS => self::HTML_TOOLTIP,
                'data-tooltip' => Yii::t('app', $title),
                self::HTML_DATA_PJAX => '0',
            ]
        );
    }

    /**
     * Show (echo) buttons in view admin
     *
     * @param string $showbuttons   to show Create, refresh, delete buttons.
     * @param bool   $button_header true if these buttons are showing in
     *                              the header view
     *
     * @return string
     */
    public function buttonsAdmin($showbuttons = '111', $button_header = true)
    {
        try {
            $show_buttons = str_split(
                $showbuttons,
                1
            );

            $button_create = '';
            if ($show_buttons[0] && Common::getProfilePermission(ACTION_CREATE)) {
                $caption = self::buttonCaption(
                    self::BUTTON_ICON_NEW,
                    Yii::t('app', self::BUTTON_TEXT_NEW)
                );
                $button_create = self::button(
                    $caption,
                    self::CSS_BTN_PRIMARY,
                    Yii::t('app', self::BUTTON_TEXT_TOOLTIP),
                    [ACTION_CREATE]
                );
            }

            $button_delete = '';
            if ($show_buttons[2] && Common::getProfilePermission(ACTION_DELETE)) {
                $button_delete = self::buttonDelete(
                    [ACTION_REMOVE],
                    self::CSS_BTN_DEFAULT
                );
            }

            $button_refresh = '';
            if ($show_buttons[1]) {
                $button_refresh = self::buttonRefresh();
            }

            if ($button_header) {
                $str_buttons = $button_create . self::HTML_SPACE
                    . $button_refresh . self::HTML_SPACE
                    . $button_delete;
            } else {
                $str_buttons = $button_delete . self::HTML_SPACE
                    . $button_refresh . self::HTML_SPACE
                    . $button_create . self::HTML_SPACE;
            }
        } catch (Exception $exception) {
            $bitacora = new Bitacora();
            $bitacora->register(
                $exception,
                'app\components\UiButtons::buttonsAdmin',
                MSG_ERROR
            );
        }
        return $str_buttons;
    }

    /**
     * Set the caption for a button link (icon+text | icon| text only)
     *
     * @param string $icon icon from awesome font
     * @param string $text Message text
     *
     * @return string
     */
    public static function buttonCaption($icon, $text)
    {
        if (self::BUTTON_ICON_WITH_TEXT) {
            $caption = $icon . $text;
        } else {
            $caption = $icon;
        }
        return $caption;
    }

    /**
     * Show a button link in the view
     *
     * @param string $caption caption of button
     * @param string $css style of button class
     * @param string $buttonToolTip string help tooltip
     * @param array $aAction array of string with action to do
     *
     * @return string
     */
    public static function button($caption, $css, $buttonToolTip, $aAction = [])
    {
        return Html::a(
            $caption,
            $aAction,
            [
                STR_CLASS => $css,
                self::HTML_TITLE => $buttonToolTip,
                self::HTML_DATA_TOGGLE => self::HTML_TOOLTIP,
                self::HTML_DATA_PLACEMENT => self::HTML_DATA_PLACEMENT_VALUE,
            ]
        );
    }

    /**
     * Show a delete button link. Generally this button is invoked from the index.php or view.php
     *
     * @param array $action array action
     * @param string $css string class style
     *
     * @return string
     */
    public function buttonDelete($action, $css)
    {
        $caption = self::buttonCaption(
            self::BUTTON_ICON_DELETE,
            Yii::t('app', self::BUTTON_TEXT_DELETE)
        );
        return Html::a(
            $caption,
            $action,
            [
                STR_CLASS => $css,
                self::HTML_TITLE => Yii::t('app', 'Delete the selected records'),
                self::HTML_DATA_TOGGLE => self::HTML_TOOLTIP,
                self::HTML_DATA_PLACEMENT => self::HTML_DATA_PLACEMENT_VALUE,
                'data' => [
                    self::STR_CONFIRM => Yii::t(
                        'app',
                        'Are you sure you want to delete this item?'
                    ),
                    METHOD => 'post',
                ]
            ]
        );
    }

    /**
     * Create object button refresh. Generally
     * this button is invoked from the _form.php view
     *
     * @param string $caption caption of a link refresh button
     *
     * @return string
     */
    public function buttonRefresh($caption = self::BUTTON_TEXT_REFRESH)
    {
        $caption = self::buttonCaption(
            self::BUTTON_ICON_REFRESH,
            Yii::t('app', $caption)
        );

        return Html::a(
            $caption,
            [Yii::$app->controller->action->id],
            [
                STR_CLASS => self::CSS_BTN_DEFAULT,
                self::HTML_TITLE => Yii::t('app', 'Refresh view'),
                self::HTML_DATA_TOGGLE => self::HTML_TOOLTIP,
                self::HTML_DATA_PLACEMENT => self::HTML_DATA_PLACEMENT_VALUE,
            ]
        );
    }

    /**
     * Show actions with buttons
     *
     * @param object $model mixed
     *
     * @return string
     */
    public function buttonsViewBottom(&$model)
    {
        $primary_key = $model->getId();
        $primary_key = BaseController::stringEncode($primary_key);
        $button_create = '';
        if (Common::getProfilePermission(ACTION_CREATE)) {
            $caption = $this->buttonCaption(
                self::BUTTON_ICON_NEW,
                Yii::t('app', self::BUTTON_TEXT_NEW)
            );
            $button_create = $this->button(
                $caption,
                self::CSS_BTN_DEFAULT,
                Yii::t('app', self::BUTTON_TEXT_TOOLTIP),
                [ACTION_CREATE]
            );
        }

        $button_delete = '';
        if (Common::getProfilePermission(ACTION_DELETE)) {
            $button_delete = $this->buttonDelete(
                [ACTION_DELETE, 'id' => $primary_key],
                self::CSS_BTN_DANGER
            );
        }

        $button_update = '';
        if (Common::getProfilePermission(ACTION_UPDATE)) {
            $caption = $this->buttonCaption(
                self::BUTTON_ICON_UPDATE,
                Yii::t('app', self::BUTTON_TEXT_UPDATE)
            );
            $button_update = $this->button(
                $caption,
                self::CSS_BTN_DEFAULT,
                Yii::t('app', 'Update the current record'),
                [ACTION_UPDATE, 'id' => $primary_key]
            );
        }

        $caption = $this->buttonCaption(
            self::BUTTON_ICON_BACK_INDEX,
            Yii::t('app', self::BUTTON_TEXT_BACK_INDEX)
        );

        return $button_create . self::HTML_SPACE .
            $button_update . self::HTML_SPACE .
            $button_delete . self::HTML_SPACE .
            $this->button(
                $caption,
                self::CSS_BTN_PRIMARY,
                Yii::t('app', 'Back to administration view'),
                [ACTION_INDEX]
            );
    }

    /**
     * Display standard buttons in create view
     *
     * @param int  $tabIndex        number of index sequence in the view
     * @param bool $showBackToIndex Show button Back to index link
     *
     * @return string
     */
    public function buttonsCreate($tabIndex, $showBackToIndex = true)
    {
        $button_save = '';
        if (Common::getProfilePermission(ACTION_CREATE)) {
            $button_save = $this->buttonSave($tabIndex);
        }

        $caption = $this->buttonCaption(
            self::BUTTON_ICON_REFRESH,
            Yii::t('app', self::BUTTON_TEXT_REFRESH)
        );

        $str_footer = $button_save . self::HTML_SPACE .
            '<button type=\'reset\' class=\'' . self::CSS_BTN_DEFAULT . '\' ' .
            self::HTML_TITLE
            . '=\''
            . Yii::t('app', self::BUTTON_TEXT_REFRESH)
            . '\' ' .
            self::HTML_DATA_TOGGLE . '=\'' . self::HTML_TOOLTIP . '\' ' .
            self::HTML_DATA_PLACEMENT . '=\'' . self::HTML_DATA_PLACEMENT_VALUE .
            '\'>' . $caption . '</button>' .
            self::HTML_SPACE;

        if ($showBackToIndex) {
            $caption = $this->buttonCaption(
                self::BUTTON_ICON_BACK_INDEX,
                Yii::t('app', self::BUTTON_TEXT_BACK_INDEX)
            );
            $str_footer .= $this->button(
                $caption,
                self::CSS_BTN_DEFAULT,
                Yii::t('app', 'Back to administration view'),
                [ACTION_INDEX]
            );
        }

        return $str_footer;
    }

    /**
     * Create a link with a new button. Generally
     * this button is invoked from the _form.php view
     *
     * @param int $tabIndex tab of object
     *
     * @return string
     */
    public function buttonSave($tabIndex = 99)
    {
        $caption = $this->buttonCaption(
            self::BUTTON_ICON_SAVE,
            Yii::t('app', self::BUTTON_TEXT_SAVE)
        );
        return Html::submitButton(
            $caption,
            [
                STR_CLASS => self::CSS_BTN_PRIMARY,
                self::HTML_TITLE => Yii::t(
                    'app',
                    'Save the information of this form'
                ),
                self::HTML_DATA_TOGGLE => self::HTML_TOOLTIP,
                self::HTML_DATA_PLACEMENT => self::HTML_DATA_PLACEMENT_VALUE,
                'name' => 'save-button',
                'id' => self::BUTTON_TEXT_SAVE,
                VALUE => 'save-button',
                AUTOFOCUS => AUTOFOCUS,
                TABINDEX => $tabIndex,
            ]
        );
    }

    /**
     * Show a toggle link button
     *
     * @param string $table_name   Name of table
     * @param string $column_name  name of column
     * @param bool   $column_value Value of columna
     * @param string $pk_name      Primary key of tableName
     * @param int    $pk_value     integer primary Key of table $tableName
     * @param string $action       Action of this link
     *
     * @return string
     */
    public function toggleButton(
        $table_name,
        $column_name,
        $column_value,
        $pk_name,
        $pk_value,
        $action = 'base/toggle'
    ) {
        $redirect = Yii::$app->controller->id
            . '/'
            . Yii::$app->controller->action->id;

        $string = $table_name . '|'
            . $column_name . '|'
            . $column_value . '|'
            . $pk_name . '|'
            . $pk_value . '|'
            . $redirect;
        $string = BaseController::stringEncode($string);

        $url_value = [$action, 'id' => $string];
        $uiComponent = new UiComponent();
        return Html::a(
            '<span class="'
            . $uiComponent->yesOrNoGlyphicon($column_value)
            . '"></span>',
            $url_value,
            [
                'title' => Yii::t('app', 'Toggle value'),
                'data-value' => $column_value,

                'data' => [
                   METHOD => 'post',
                ],
                self::HTML_DATA_PJAX => 'w0',
            ]
        );
    }
}
