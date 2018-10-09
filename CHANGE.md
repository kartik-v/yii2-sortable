Change Log: `yii2-sortable`
===========================

## Version 1.2.2

**Date:** 09-Oct-2018

- Bump up composer dependencies.

## Version 1.2.1

**Date:** 03-Sep-2018

- (enh #17): Update to use newer plugin methods.
- Updates to support bootstrap v4.x.
- (enh #15, #16): Create new jquery plugin `kvHtml5Sortable` based on `html5sortable`.
- Update to use latest release library of [html5sortable](https://github.com/lukasoppermann/html5sortable).
- Move all relevant code to new `src` directory.
- Add github contribution and issue/PR logging templates.

## Version 1.2.0

**Date:** 17-Jun-2015

- (enh #9): Set composer ## Version dependencies.
- (enh #7): Correct documentation link.
- (enh #5): Allow multiple connected sortables on single page. With this enhancement, the `connected` 
   property will follow these rules:
    - if set to `false` or null/empty this widget will not be connected to any other sortable widget.
    - if set to `true`, this widget will be connected to all other sortable widgets on the page with `connected` property set to `true`.
    - if set to a string - this widget will be connected with other sortable widgets matching the same connected string value.
- Upgrade sortable plugin to [use new fork]((https://github.com/voidberg/html5sortable).

## Version 1.1.0

**Date:** 10-Nov-2014

- Set dependency on Krajee base components
- Set release to stable

## Version 1.0.0

**Date:** 01-Jul-2014

- Initial release
- PSR4 alias change