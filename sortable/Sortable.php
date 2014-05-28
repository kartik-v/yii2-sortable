<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014
 * @package yii2-sortable
 * @version 1.0.0
 */

namespace kartik\sortable;

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
class Sortable extends \kartik\widgets\Widget
{
    const TYPE_LIST = 'list';
    const TYPE_GRID = 'grid';

    /**
     * @var string the type of the sortable widget
     * Should be one of [[Sortable::TYPE]] constants.
     * Defaults to Sortable::TYPE_LIST
     */
    public $type;

    /**
     * @var boolean, whether this widget is connected to another Sortable widget
     */
    public $connected = false;

    /**
     * @var boolean, whether this widget is disabled by default
     */
    public $disabled = false;

    /**
     * @var boolean, whether to show handle for each sortable item
     */
    public $showHandle = false;

    /**
     * @var string, the handle label, this is not HTML encoded
     */
    public $handleLabel = '<i class="glyphicon glyphicon-move"></i> ';

    /**
     * @var array the HTML attributes to be applied to all items.
     * This will be overridden by the [[options]] property within [[$items]].
     */
    public $itemOptions = [];

    /**
     * @var array the items that should be included within the sortable
     * list/grid. You can set the following properties:
     * - content: string, the list item content to be included (this is not HTML encoded)
     * - options: array, the HTML attributes for the list item.
     * - disabled: bool, whether the list item is disabled
     */
    public $items = [];

    public function init()
    {
        parent::init();
        Html::addCssClass($this->options, $this->type);
        if ($this->connected) {
            Html::addCssClass($this->options, 'connected');
            $this->pluginOptions['connectWith'] = '.connected';
        }
        if ($this->showHandle) {
            $this->pluginOptions['handle'] = '.handle';
        }
        $this->registerAssets();
        echo Html::beginTag('ul', $this->options);
    }

    protected function run()
    {
        echo $this->renderItems();
        echo Html::endTag('ul');
    }

    protected function renderItems()
    {
        $items = '';
        $disabled = false;
        $handle = ($this->showHandle) ? Html::tag('span', $this->handleLabel, ['class' => 'handle']) : '';
        foreach ($this->items as $item) {
            $options = ArrayHelper::getValue($item, 'options', []);
            $options = ArrayHelper::merge($this->itemOptions, $options);
            if (ArrayHelper::getValue($item, 'disabled', false)) {
                $disabled = true;
                Html::addCssClass($options, 'disabled');
            }
            $content = ArrayHelper::getValue($item, 'content', '');
            $items .= $handle . Html::tag('li', $content, $options) . PHP_EOL;
        }
        if ($disabled && empty($this->pluginOptions['items'])) {
            $this->pluginOptions['items'] = ':not(.disabled)';
        }
        return $items;
    }

    public function registerAssets()
    {
        $view = $this->getView();
        SortableAsset::register($view);
        $id = '$("#' + $this->options['id'] + '")';
        $this->registerPlugin('sortable');
        if ($this->disabled) {
            $js = "{$id}.sortable('disable')";
        } else {
            $js = "{$id}.sortable('enable')";
        }
        $view->registerJs($js);
    }
}