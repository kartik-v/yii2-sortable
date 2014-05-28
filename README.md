yii2-sortable
=================

This widget allows you to create sortable lists and grids using native HTML5 drag and drop API for Yii 2.0. The widget is based on the 
lightweight [html5sortable](http://farhadi.ir/projects/html5sortable) jQuery plugin and offers these features:

- Less than 1KB (minified and gzipped).
- Built using native HTML5 drag and drop API.
- Supports both list and grid style layouts.
- Similar API and behaviour to jquery-ui sortable plugin.
- Works in IE 5.5+, Firefox 3.5+, Chrome 3+, Safari 3+ and, Opera 12+.

> NOTE: This extension depends on the [kartik-v/yii2-widgets](https://github.com/kartik-v/yii2-widgets) extension which in turn depends on the 
[yiisoft/yii2-bootstrap](https://github.com/yiisoft/yii2/tree/master/extensions/bootstrap) extension. Check the 
[composer.json](https://github.com/kartik-v/yii2-sortable/blob/master/composer.json) for this extension's requirements and dependencies. 
Note: Yii 2 framework is still in active development, and until a fully stable Yii2 release, your core yii2-bootstrap packages (and its dependencies) 
may be updated when you install or update this extension. You may need to lock your composer package versions for your specific app, and test 
for extension break if you do not wish to auto update dependencies.

### Demo
You can see detailed [documentation](http://demos.krajee.com/sortable) on usage of the extension.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ php composer.phar require kartik-v/yii2-sortable "dev-master"
```

or add

```
"kartik-v/yii2-sortable": "dev-master"
```

to the ```require``` section of your `composer.json` file.

## Usage

### Sortable

```php
use kartik\sortable\Sortable;
echo Sortable::widget([
    'type' => Sortable::TYPE_LIST,
    'items' => [
        ['content' => 'Item # 1'],
        ['content' => 'Item # 2'],
        ['content' => 'Item # 3'],
    ]   
]); 
```

## License

**yii2-sortable** is released under the BSD 3-Clause License. See the bundled `LICENSE.md` for details.