// A N I M A T I O N

import { getScrollOffset, getViewportHeight } from './helpers';

// list of general animations

class animations {
    constructor() {
        this.eleArr = [];
        this.elements = document.querySelectorAll('.trigger_fade, .trigger_tile, .trigger_rotate_tile');
        this.interval;
        this.currentScroll;

        this.setValues(true);

        this.toBeLoaded = this.eleArr.length;

        if(this.eleArr.length) {
            this.init();
        }
    }

    setValues(init = false) {
        for(var i = 0; i < this.elements.length; i++) {
            var rect = this.elements[i].getBoundingClientRect();

            if(init) {
                this.eleArr[i] = {
                    'ele': this.elements[i],
                    'top': rect.top,
                    'bottom': rect.bottom,
                    'height': rect.height,
                    'loaded': false
                }
            } else {
                this.eleArr[i]['top'] = rect.top;
            }
        }
    }

    init() {
        this.interval = setInterval(function(){
            this.currentScroll = getScrollOffset();
            this.setValues(); // keep ele top updated
            if(this.toBeLoaded > 0) {
                for(var i = 0; i < this.eleArr.length; i++) {
                    if(!this.eleArr[i]['loaded']) {
                        if( inWindow(this.currentScroll, this.eleArr[i]['top'], this.eleArr[i]['height'], getViewportHeight()) ) {
                            this.eleArr[i]['ele'].classList.add('animate');
                            this.eleArr[i]['loaded'] = true;
                            this.toBeLoaded = this.toBeLoaded - 1;
                        }
                    }
                }
            } else {
                clearInterval(this.interval);
            }
        }.bind(this), 30);
    }
}

var animationInstance = new animations();