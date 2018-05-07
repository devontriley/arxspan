import { getElIndex, getElementContentWidth } from './helpers.js';

class imageSlider {
    constructor(ele) {
        this.sliderWrapper = ele;
        this.ul = this.sliderWrapper.querySelector('ul.slider');
        this.lis = this.ul.querySelectorAll('li');
        this.nav = this.sliderWrapper.querySelector('.slider-nav');
        this.height;
        this.width = (window.mobileDetected) ? getElementContentWidth(this.sliderWrapper) : getElementContentWidth(this.sliderWrapper) / 3;
        this.ulWidth;
        this.horizontalCenter = (getElementContentWidth(this.sliderWrapper) / 2) - (this.width / 2);
        this.currentSlide = 0;

        console.log(getElementContentWidth(this.sliderWrapper));

        if(this.lis.length) {
            this.positioning();
            this.setUlPosition(this.currentSlide);
        }

        // Nav click event listener
        this.nav.addEventListener('click', function(e) {
            if(e.target.tagName.toLowerCase() == 'button') {
                this.navClickHandler(e);
            }
        }.bind(this));
    }



    positioning() {
        this.ulWidth = this.width * this.lis.length;

        this.ul.style.width = this.ulWidth+'px';

        // Set li widths
        for(var i = 0; i < this.lis.length; i++) {
            // Set li width
            this.lis[i].style.width = this.width+'px';

            // We can set the ul height after setting the first li width and getting it's updated height
            if(i == 0) {
                // Set public height
                this.height = this.lis[i].offsetHeight;
                // Set ul height
                this.ul.style.height = this.height+'px';
            }

            // Set li height
            this.lis[i].style.height = this.height+'px';
        }

        // Set ul width
        for(var i = 0; i < this.lis.length; i++) {
            this.lis[i].style.width = this.width+'px';
        }
    }

    navClickHandler(e) {
        var nextSlide = getElIndex(e.target);
        // Set the ul position by passing the position of the next slide
        this.setUlPosition(nextSlide);
    }

    getUlPosition(index) {
        var slideCenterOffset = (index * this.width) + (this.width / 2);
        // - 20 to account for slider wrapper padding ><
        return (this.sliderWrapper.offsetWidth / 2) - slideCenterOffset - 20;
    }

    setUlPosition(index) {
        var position = this.getUlPosition(index);

        // Set ul position
        this.ul.style.left = position+'px';

        // Remove active from current slide and current nav item
        this.lis[this.currentSlide].classList.remove('active');
        this.nav.querySelectorAll('button')[this.currentSlide].classList.remove('active');

        // Add active to new slide
        this.lis[index].classList.add('active');
        this.nav.querySelectorAll('button')[index].classList.add('active');

        // Update current active slide
        this.currentSlide = index;
    }
}

export default imageSlider;