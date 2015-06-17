version 1.2.0
=============
**Date:** 17-Jun-2015

- Upgrade sortable plugin to [use new fork]((https://github.com/voidberg/html5sortable).
- (enh #5): Allow multiple connected sortables on single page. With this enhancement, the `connected` 
   property will follow these rules:
    - if set to `false` or null/empty this widget will not be connected to any other sortable widget.
    - if set to `true`, this widget will be connected to all other sortable widgets on the page with `connected` property set to `true`.
    - if set to a string - this widget will be connected with other sortable widgets matching the same connected string value.
- (enh #7): Correct documentation link.
- (enh #9): Set composer version dependencies.

version 1.1.0
=============
**Date:** 10-Nov-2014

- Set dependency on Krajee base components
- Set release to stable

version 1.0.0
=============
**Date:** 01-Jul-2014

- Initial release
- PSR4 alias change