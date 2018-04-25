import { getScrollOffset } from './helpers';

// TODO: Clean this up!

class MainHeader {
    constructor() {
        this.header = document.getElementById('primary-header');
        this.scrollOffset = getScrollOffset();
        // this.active = (this.scrollOffset > 0) ? true : false;

        window.addEventListener('scroll', function(e) {
            this.scrollOffset = getScrollOffset();
            this.toggle();
        }.bind(this));

        window.addEventListener('load', function(e) {
            this.toggle();
        }.bind(this));
    }

    toggle() {
        console.log('toggle');
        if(this.scrollOffset > 0) {
            document.body.classList.add('header-active');
        } else {
            document.body.classList.remove('header-active');
        }
    }
}

export default MainHeader;