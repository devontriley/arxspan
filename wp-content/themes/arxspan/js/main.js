import * as h from './helpers';
import $ from 'jquery';
import _ from 'lodash';
import domReady from 'domready';
import Barba from 'barba.js';
import MainHeader from './Main-Header.js';
import MainNav from './Main-Nav.js';
import tabModule from './Tab-Module.js';
import imageSlider from './Image-Slider.js';
import newsEventQuery from './Post-Loader.js';
import animations from './animations.js';
// import mceButtons from './Mce-Buttons.js'; // how input? include in functions file w hook
import { styledSelect, defaultForm } from './Forms.js';

var mainHeader = new MainHeader();
var mainNav = new MainNav();

/*
 * body .is-mobile on resize
 */
window.addEventListener('resize', function(e) {
    window.mobileDetected = window.mobilecheck();
    (window.mobileDetected) ? document.body.classList.add('is-mobile') : document.body.classList.remove('is-mobile');
});

/*
 * AJAX (news and events)
 */
var loadMoreBtn = document.getElementById('load-more');
if(loadMoreBtn != null){
    var newsEventsAjax = new newsEventQuery();
}

/*
 * Image Sliders
 */

var imageSliders = document.querySelectorAll('.slider-wrapper');
if(imageSliders != null) {
    var imageSlidersArr = [];
    for(var i = 0; i < imageSliders.length; i++) {
        imageSlidersArr.push(new imageSlider(imageSliders[i]));
    }
}

/*
 * Styled selects
 */
function setupStyledSelects() {
    var styledSelects = document.querySelectorAll('form select');
    if(styledSelects.length){
        var styledSelectsArr = [];
        for(var i = 0; i < styledSelects.length; i++) {
            styledSelectsArr[i] = new styledSelect(styledSelects[i]);
        }
    }
}

/*
 * Forms
 */
function setupForms() {
    var forms = document.querySelectorAll('.default-form');
    if(forms.length) {
        var formsArr = [];
        for(var i = 0; i < forms.length; i++) {
            formsArr[i] = new defaultForm(forms[i]);
        }
    }
}

/*
 * Tab Modules
 */
function setupTabModules() {
    const getTabModules = document.querySelectorAll('.tab-module');
    if(getTabModules) {
        const tabModules = [];
        for(var i = 0; i < getTabModules.length; i++) {
            tabModules.push(new tabModule(getTabModules[i]));
        }
    }
}

/*
 * Loading SVG backgrounds
 */


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

            window.scrollTo(0,0);

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
    // var Views = {
    //     Homepage: Barba.BaseView.extend({
    //         namespace: 'homepage',
    //         onEnter: function() {},
    //         onEnterCompleted: function() {
    //
    //             /*
    //              * Tab Modules
    //              */
    //             const getTabModules = document.querySelectorAll('.tab-module');
    //             if(getTabModules) {
    //                 const tabModules = [];
    //                 for(var i = 0; i < getTabModules.length; i++) {
    //                     tabModules.push(new tabModule(getTabModules[i]));
    //                 }
    //             }
    //
    //         },
    //         onLeave: function() {},
    //         onLeaveCompleted: function() {}
    //     })
    // }
    //
    // Views.Homepage.init();

    Barba.Dispatcher.on('initStateChange', function(currentStatus) {
        // We can remove anything from the old page here
    });

    Barba.Dispatcher.on('newPageReady', function() {
        // We can add anything for the new page here
        setupTabModules();
        setupForms();
        setupStyledSelects();
        swapSVG();
    });

    Barba.Pjax.init();
    Barba.Prefetch.init();

});