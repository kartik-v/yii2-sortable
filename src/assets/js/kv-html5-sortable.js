/*!
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2018
 * @package yii2-sortable
 * @version 1.2.2
 *
 * jQuery Plugin Wrapper for HTML5 Sortable
 *
 * Author: Kartik Visweswaran
 * Licensed under the BSD 3-Clause
 */
(function (factory) {
    "use strict";
    //noinspection JSUnresolvedVariable
    if (typeof define === 'function' && define.amd) { // jshint ignore:line
        // AMD. Register as an anonymous module.
        define(['jquery'], factory); // jshint ignore:line
    } else { // noinspection JSUnresolvedVariable
        if (typeof module === 'object' && module.exports) { // jshint ignore:line
            // Node/CommonJS
            // noinspection JSUnresolvedVariable
            module.exports = factory(require('jquery')); // jshint ignore:line
        } else {
            // Browser globals
            factory(window.jQuery);
        }
    }
}(function ($) {
    "use strict";
    var KvHtml5Sortable;
    
    KvHtml5Sortable = function (element, options) {
        var self = this;
        self.$element = $(element);
        self._init(options);
    };

    KvHtml5Sortable.prototype = {
        constructor: KvHtml5Sortable,
        _init: function (options) {
            var self = this, f, $el = self.$element, sLib = window['sortable'],
                methods = ['destroy', 'disable', 'enable', 'serialize', 'reload'];
            self.options = options;
            $.each(options, function (opt, value) {
                self[opt] = value;
            });
            if (!sLib) {
                throw "Sortable Library not initialized!";
                return;
            }
            self.id = '#' + $el.attr('id');
            sLib(self.id, self.options);
            $.each(methods, function(key, method) {
                self[method] = function() {
                    sLib(self.id, method);
                };
            });
        }
    };

    $.fn.kvHtml5Sortable = function (option) {
        var args = Array.apply(null, arguments), retvals = [];
        args.shift();
        this.each(function () {
            var self = $(this), data = self.data('kvHtml5Sortable'), options = typeof option === 'object' && option, opt;
            if (!data) {
                opt = $.extend(true, {}, $.fn.kvHtml5Sortable.defaults, options, self.data());
                data = new KvHtml5Sortable(this, opt);
                self.data('kvHtml5Sortable', data);
            }
            if (typeof option === 'string') {
                retvals.push(data[option].apply(data, args));
            }
        });
        switch (retvals.length) {
            case 0:
                return this;
            case 1:
                return retvals[0];
            default:
                return retvals;
        }
    };
    $.fn.kvHtml5Sortable.defaults = {};
    $.fn.kvHtml5Sortable.Constructor = KvHtml5Sortable;
}));