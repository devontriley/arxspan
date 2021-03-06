import * as h from './helpers';
import $ from 'jquery';
import _ from 'lodash';
import domReady from 'domready';
import Barba from 'barba.js';
import MainHeader from './Main-Header.js';
import MainNav from './Main-Nav.js';
import tabModule from './Tab-Module.js';
import postSlider from './Post-Slider.js';
import imageSlider from './Image-Slider.js';
import scrollToTop from './Scroll-To-Top.js';
import newsEventQuery from './Post-Loader.js';
import animations from './animations.js';
import swapSVG from './Swap-SVG.js';
import { contactForm, styledSelect } from './Forms.js';

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
function setupAjaxPosts() {
    var loadMoreBtn = document.getElementById('load-more');
    if(loadMoreBtn != null) {
        var newsEventsAjax = new newsEventQuery();
    }
}

/*
 * Image Sliders
 */

function setupScrollToTop() {
    var scrollToTopBtn = document.getElementById('scroll-to-top');
    if(scrollToTopBtn != null) {
        var btn = new scrollToTop(scrollToTopBtn);
    }
}

/*
 * Image Sliders
 */
function setupImageSliders() {
    var imageSliders = document.querySelectorAll('.slider-wrapper');
    if(imageSliders != null) {
        var imageSlidersArr = [];
        for(var i = 0; i < imageSliders.length; i++) {
            imageSlidersArr.push(new imageSlider(imageSliders[i]));
        }
    }
}

/*
 * Post Sliders
 */
function setupPostSliders() {
    var postSliders = document.querySelectorAll('.posts-container.is-slider .grid-inner');
    if(postSliders != null) {
        var postSlidersArr = [];
        for(var i = 0; i < postSliders.length; i++) {
            postSlidersArr.push(new postSlider(postSliders[i]));
        }
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
            formsArr[i] = new contactForm(forms[i]);
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
 * Swap SVG backgrounds
 */
var swapSVGBG = new swapSVG();


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
        swapSVGBG.check();
    });

    Barba.Dispatcher.on('newPageReady', function() {
        // console.log(document.querySelectorAll('ul.slider'));
        setupTabModules();
        setupForms();
        setupStyledSelects();
        setupPostSliders();
        setupAjaxPosts();
    });

    Barba.Dispatcher.on('transitionCompleted', function() {
        setupImageSliders();
        setupScrollToTop();
    });

    Barba.Pjax.init();
    Barba.Prefetch.init();

});