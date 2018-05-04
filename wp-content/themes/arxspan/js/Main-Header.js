import Barba from 'barba.js';
import { getScrollOffset } from './helpers';

// TODO: Clean this up!

class MainHeader {
    constructor() {
        this.header = document.getElementById('primary-header');
        this.scrollOffset = getScrollOffset();
        this.logo = document.querySelector('#primary-header .logo a');
        this.demoBtn = document.querySelector('#primary-header .demo-btn a');

        var barbaEvent = function(e) {
            e.preventDefault();
            console.log(this.href);
            Barba.Pjax.goTo(this.href);
        }

        this.logo.addEventListener('click', barbaEvent);
        this.demoBtn.addEventListener('click', barbaEvent);

        window.addEventListener('scroll', function(e) {
            this.scrollOffset = getScrollOffset();
            this.toggle();
        }.bind(this));

        window.addEventListener('load', function(e) {
            this.toggle();
        }.bind(this));
    }

    toggle() {
        if(this.scrollOffset > 100) {
            document.body.classList.add('header-active');
        } else {
            document.body.classList.remove('header-active');
        }
    }
}

export default MainHeader;