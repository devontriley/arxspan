import * as h from './helpers';
import $ from 'jquery';
import _ from 'lodash';
import domReady from 'domready';
import Barba from 'barba.js';
import MainHeader from './Main-Header.js';
import MainNav from './Main-Nav.js';
import tabModule from './Tab-Module.js';

var mainHeader = new MainHeader();
var mainNav = new MainNav();

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

    // We can create multiple views for loading page specific javascript
    var Views = {
        Homepage: Barba.BaseView.extend({
            namespace: 'homepage',
            onEnter: function() {
            },
            onEnterCompleted: function() {

                /*
                 * Tab Modules
                 */
                const getTabModules = document.querySelectorAll('.tab-module');
                if(getTabModules) {
                    const tabModules = [];
                    for(var i = 0; i < getTabModules.length; i++) {
                        tabModules.push(new tabModule(getTabModules[i]));
                    }
                    console.log(tabModules);
                }

            },
            onLeave: function() {
                console.log('leave homepage');
            },
            onLeaveCompleted: function() {
                console.log('leave homepage complete');
            }
        })
    }

    Views.Homepage.init();

    Barba.Pjax.init();
    Barba.Prefetch.init();

});