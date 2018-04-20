import { getParameterByName, getElIndex } from './helpers';

class tabModule {
    constructor(ele) {
        this.tabContent = ele.getElementsByClassName('tabcontent');
        this.tabLinks = ele.getElementsByClassName('tablinks');
        this.currentTab = getParameterByName('activeTab') ? getParameterByName('activeTab') : 1;

        for(var i = 0; i < this.tabLinks.length; i++) {

            this.tabLinks[i].addEventListener('click', function(e) {
                var index = getElIndex(e.target);
                this.changeTab(index, this.currentTab);
            }.bind(this));
        }
    }

    changeTab(index, currentTab) {
        this.replaceState(index);
        this.tabOut(currentTab);
        this.tabIn(index);
    }

    replaceState(index) {
        var newUrl;
        this.currentTab = index + 1;

        if(this.currentTab == 1){
            newUrl = window.location.protocol + '//' + window.location.host + window.location.pathname;
        } else {
            newUrl = window.location.protocol + '//' + window.location.host + window.location.pathname + '?activeTab=' + this.currentTab;
        }

        window.history.replaceState({}, '', newUrl);

    }

    tabOut(currentTab) {
        this.tabLinks[currentTab - 1].classList.remove('active');
        this.tabContent[currentTab - 1].classList.remove('active');
    }

    tabIn(index) {
        this.tabLinks[index].classList.add('active');
        this.tabContent[index].classList.add('active');
    }
}

export default tabModule;