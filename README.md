yii2-sortable
=============

[![Latest Stable Version](https://poser.pugx.org/kartik-v/yii2-sortable/v/stable)](https://packagist.org/packages/kartik-v/yii2-sortable)
[![License](https://poser.pugx.org/kartik-v/yii2-sortable/license)](https://packagist.org/packages/kartik-v/yii2-sortable)
[![Total Downloads](https://poser.pugx.org/kartik-v/yii2-sortable/downloads)](https://packagist.org/packages/kartik-v/yii2-sortable)
[![Monthly Downloads](https://poser.pugx.org/kartik-v/yii2-sortable/d/monthly)](https://packagist.org/packages/kartik-v/yii2-sortable)
[![Daily Downloads](https://poser.pugx.org/kartik-v/yii2-sortable/d/daily)](https://packagist.org/packages/kartik-v/yii2-sortable)

A Yii 2.0 widget that allows you to create sortable lists and grids and manipulate them using simple drag and drop. 
It is based on the lightweight [html5sortable](https://github.com/voidberg/html5sortable) jQuery plugin, which uses native HTML5 API for drag and drop. 
It is a leaner alternative for the JUI Sortable plugin and offers very similar functionality. The **yii2-sortable widget** offers these features:

- Less than 1KB of javascript used (minified and gzipped).
- Built using native HTML5 drag and drop API.
- Supports both list and grid style layouts.
- Similar API and behaviour to jquery-ui sortable plugin.
- Works in IE 5.5+, Firefox 3.5+, Chrome 3+, Safari 3+ and, Opera 12+.

### Demo
You can see detailed [documentation](http://demos.krajee.com/sortable) on usage of the extension.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

> NOTE: Check the [composer.json](https://github.com/kartik-v/yii2-sortable/blob/master/composer.json) for this extension's requirements and dependencies. Read this [web tip /wiki](http://webtips.krajee.com/setting-composer-minimum-stability-application/) on setting the `minimum-stability` settings for your application's composer.json.

Either run

```
$ php composer.phar require kartik-v/yii2-sortable "@dev"
```

or add

```
"kartik-v/yii2-sortable": "@dev"
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