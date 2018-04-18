define(function(require) {

    var $ = require('jquery');

    // Load plugins that do not require initialization
    // require('plugins/jquery.pluginA');

    function tabModule(ele) {
        this.tabContent = ele.getElementsByClassName('tabcontent'); // local scoping, this instead of var
        this.tabLinks = ele.getElementsByClassName('tablinks');
        //this.currentTab = getParameterByName('activeTab');

        for(i = 0; i < this.tabLinks.length; i++){
            this.tabLinks[i].addEventListener('click', function(e){
                e.preventDefault();
                var index = getElIndex(e.target);
                this.changeTab(index, this.currentTab);
            }.bind(this));
        }

        this.changeTab = function(index, currentTab) {
            this.replaceState(index);
            this.tabOut(currentTab);
            this.tabIn(index);
        }

        this.replaceState = function(index) {
            var newUrl;
            this.currentTab = index;

            if(index == 0 ){
                newUrl = window.location.protocol + '//' + window.location.host + window.location.pathname;
            } else {
                newUrl = window.location.protocol + '//' + window.location.host + window.location.pathname + '?activeTab=' + index;
            }

            window.history.replaceState({}, '', newUrl);

        }

        this.tabOut = function(currentTab) {
            this.tabContent[currentTab].classList.remove('active');
        }

        this.tabIn = function(index) {
            this.tabContent[index].classList.add('active');
        }
    }

    return tabModule;

});
