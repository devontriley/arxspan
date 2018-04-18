require.config({
    baseUrl: 'wp-content/themes/bloodmoon/scripts',
    paths: {
        jquery:     'plugins/node_modules/jquery/dist/jquery',
        domReady:   'plugins/node_modules/domready/ready',
        lazySizes:  'plugins/node_modules/lazysizes/lazysizes',
        Barba:      'plugins/node_modules/barba.js/dist/barba',
        Utilities:  'modules/Utilities'

    },
    shim: {
        //add plugins here if there are any
    }
});

define(function(require) {

    var $ = require('jquery');
    var domReady = require('domReady');
    var Barba = require('Barba');
    var Utils = require('Utilities');

    console.log(Utils.getElIndex);

    var test = Utils.getElIndex(document.querySelector('.tab-module'));

    domReady(function() {

        /*
         * Barba.js
         *
         */

        // basetransition.extend extends object
        var FadeTransition = Barba.BaseTransition.extend({
            start: function() {
                //automatically called as soon as transition starts - as soon as loading is finished and old page fades out, let's fade in the new page
                Promise
                    .all([this.newContainerLoading, this.fadeOut()])
                    .then(this.fadeIn.bind(this));
            },

            fadeOut: function() {
                // fade out old container
                return $(this.oldContainer).animate({ opacity: 0 }).promise();
            },

            fadeIn: function() {
                //fade in new container
                var _this = this;
                var $el = $(this.newContainer);

                $(this.oldContainer).hide();

                $el.css({
                    visibility: 'visible',
                    opacity: 0
                });

                $el.animate({ opacity: 1 }, 400, function() {
                    //call done to remove the old container from the DOM
                    _this.done();
                });
            }
        });

        //tell barba to use the new transition
        Barba.Pjax.getTransition = function() {
            return FadeTransition;
        };

        Barba.Pjax.init();
        Barba.Prefetch.init();

    });

});