<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2018
 * @package yii2-sortable
 * @version 1.2.2
 */

namespace kartik\sortable;

use kartik\base\Widget;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * Create sortable lists and grids using HTML5 drag and drop API for Yii 2.0.
 * Based on html5sortable plugin.
 *
 * @see http://farhadi.ir/projects/html5sortable/
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class Sortable extends Widget
{
    /**
     * @var string list type sortable
     */
    const TYPE_LIST = 'list';

    /**
     * @var string grid type sortable
     */
    const TYPE_GRID = 'grid';

    /**
     * @var string the type of the sortable widget
     * Should be one of [[Sortable::TYPE]] constants.
     * Defaults to Sortable::TYPE_LIST
     */
    public $type = self::TYPE_LIST;

    /**
     * @var boolean|string, whether this widget is connected to another Sortable widget. Defaults to `false`.
     * - if set to `false` or null/empty this widget will not be connected to any other sortable widget.
     * - if set to `true`, this widget will be connected to all other sortable widgets on the page with
     *   `connected` property set to `true`.
     * - if set to a string - this widget will be connected with other sortable widgets matching
     *   the same connected string value.
     */
    public $connected = false;

    /**
     * @var boolean, whether this widget is disabled
     */
    public $disabled = false;

    /**
     * @var boolean, whether to show handle for each sortable item.
     */
    public $showHandle = false;

    /**
     * @var string, the handle label, this is not HTML encoded.  If not set this will default to:
     * - '<i class="fas fa-arrows-alt"></i> ' if [[bsVersion]] is `4.x`
     * - '<i class="glyphicon glyphicon-move"></i> ' if [[bsVersion]] is `3.x`
     */
    public $handleLabel;

    /**
     * @var array the HTML attributes to be applied to all items.
     * This will be overridden by the [[options]] property within [[$items]].
     */
    public $itemOptions = [];

    /**
     * @var array the sortable items configuration for rendering elements within the sortable
     * list / grid. You can set the following properties:
     * - content: string, the list item content (this is not HTML encoded)
     * - disabled: bool, whether the list item is disabled
     * - options: array, the HTML attributes for the list item.
     */
    public $items = [];

    /**
     * Initializes the widget
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();
        if (!isset($this->handleLabel)) {
            $icon = $this->isBs4() ? '<i class="fas fa-arrows-alt"></i>' : '<i class="glyphicon glyphicon-move"></i> ';
            $this->handleLabel = $icon . ' ';
        }
        Html::addCssClass($this->options, 'sortable ' . $this->type);
        if (($this->connected && is_string($this->connected)) || $this->connected === true) {
            $css = ($this->connected === true) ? 'kv-connected' : $this->connected;
            Html::addCssClass($this->options, $css);
            $this->pluginOptions['acceptFrom'] = ".{$css}";
        }
        if ($this->showHandle) {
            $this->pluginOptions['handle'] = '.handle';
        } else {
            Html::addCssClass($this->options, 'cursor-move');
        }
        if ($this->hasDisabledItem() && empty($this->pluginOptions['items'])) {
            $this->pluginOptions['items'] = ':not(.disabled)';
        }
        $this->registerAssets();
        echo Html::beginTag('ul', $this->options);
    }

    /**
     * Runs the widget
     *
     * @return string|void
     */
    public function run()
    {
        echo $this->renderItems();
        echo Html::endTag('ul');
    }

    /**
     * Check if there is any disabled item
     *
     * @return bool
     */
    protected function hasDisabledItem()
    {
        foreach ($this->items as $item) {
            if (ArrayHelper::getValue($item, 'disabled', false)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Render the list items for the sortable widget
     *
     * @return string
     */
    protected function renderItems()
    {
        $items = '';
        $handle = ($this->showHandle) ? Html::tag('span', $this->handleLabel, ['class' => 'handle']) : '';
        foreach ($this->items as $item) {
            $options = ArrayHelper::getValue($item, 'options', []);
            $options = ArrayHelper::merge($this->itemOptions, $options);
            if (ArrayHelper::getValue($item, 'disabled', false)) {
                Html::addCssClass($options, 'disabled');
            }
            $content = $handle . ArrayHelper::getValue($item, 'content', '');
            $items .= Html::tag('li', $content, $options) . PHP_EOL;
        }
        return $items;
    }

    /**
     * Register client assets
     */
    public function registerAssets()
    {
        $view = $this->getView();
        SortableAsset::register($view);
        $this->registerPlugin('kvHtml5Sortable');
        $id = 'jQuery("#' . $this->options['id'] . '")';
        if ($this->disabled) {
            $js = "{$id}.kvHtml5Sortable('disable');";
        } else {
            $js = "{$id}.kvHtml5Sortable('enable');";
        }
        $view->registerJs($js);
    }
}
