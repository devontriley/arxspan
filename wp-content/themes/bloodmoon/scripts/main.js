require.config({
    baseUrl: 'wp-content/themes/bloodmoon/scripts/',
    paths: {
        jquery:     'modules/jquery/dist/jquery',
        domReady:   'modules/domReady/domReady',
        lazySizes: 'modules/lazysizes/lazysizes', //will this work?
        Barba: 'modules/barba.js/dist/barba'

    },
    shim: {
        //add plugins here if there are any
    }
});

define(function(require) {
    var $        = require('jquery');
    var domReady = require('domReady');
    var Barba  = require('Barba');

    domReady(function() {
        // Init common module code here

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

        console.log('barba working!');

        // utility functions
        function getElIndex(el) {
            for (var i = 0; el = el.previousElementSibling; i++);
            return i;
        }

        // get param by name
        function getParameterByName(name, url) {
            if (!url) url = window.location.href;
            name = name.replace(/[\[\]]/g, "\\$&");
            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, " "));
        }

        // TAB MODULE
        class tabModule {
            constructor(ele) { // ele good for two or more iterations of same module as opposed to document
                this.tabContent = ele.getElementsByClassName('tabcontent'); // local scoping, this instead of var
                this.tabLinks = ele.getElementsByClassName('tablinks');
                this.currentTab = getParameterByName('activeTab');

                for(i = 0; i < this.tabLinks.length; i++){
                    this.tabLinks[i].addEventListener('click', function(e){
                        e.preventDefault();
                        var index = getElIndex(e.target);
                        this.changeTab(index, this.currentTab);
                    }.bind(this));
                }
            }

            // M E T H O D S

            // add logic if the current tab is 0 remove current strong from url

            changeTab(index, currentTab){
                this.replaceState(index);
                this.tabOut(currentTab);
                this.tabIn(index);
            }

            replaceState(index){
                var newUrl;
                this.currentTab = index;

                if(index == 0 ){
                    newUrl = window.location.protocol + '//' + window.location.host + window.location.pathname;
                } else {
                    newUrl = window.location.protocol + '//' + window.location.host + window.location.pathname + '?activeTab=' + index;
                }

                window.history.replaceState({}, '', newUrl);

            }

            tabOut(currentTab){
                this.tabContent[currentTab].classList.remove('active');
            }

            tabIn(index){
                this.tabContent[index].classList.add('active');
            }
        }

        if(document.getElementsByClassName('tab-module')){
            var tabModules = document.getElementsByClassName('tab-module'); // will return an array
            var tabModulesArr = []; // to add custom data

            for(i = 0; i < tabModules.length; i++){

                tabModulesArr.push( //for each instance of tab module we will add object to array
                    new tabModule(tabModules[i]) // will ref element we are passing to class
                ) // after this will have array of all classes
            }
        }
    });
});