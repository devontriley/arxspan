import { getElIndex, getElementContentWidth } from './helpers.js';

class postSlider {
    constructor(ele) {
        this.sliderWrapper = ele;
        console.log(this.sliderWrapper);
        this.ul = this.sliderWrapper.querySelector('ul.post-slider');
        this.lis = this.ul.querySelectorAll('li');
        this.height;
        this.width = (window.mobileDetected) ? getElementContentWidth(this.sliderWrapper) * 2 : getElementContentWidth(this.sliderWrapper);
        this.ulWidth;
        this.horizontalCenter = (getElementContentWidth(this.sliderWrapper) / 2) - (this.width / 2);
        this.currentSlide = 0;

        //set container for nav html
        this.navContainer = document.createElement('div');
        this.navContainer.classList.add('post-slider-nav');
        this.sliderWrapper.appendChild(this.navContainer);
        this.navItems = '';

        console.log(getElementContentWidth(this.sliderWrapper));

        if(this.lis.length) {
            this.positioning();
            // this.setUlPosition(this.currentSlide);
        }

        // Nav click event listener
        this.navContainer.addEventListener('click', function(e) {
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

            if(window.mobileDetected) {
                for(var x = 0; x < this.lis[x].querySelectorAll('.post-container').length; x++){
                    this.navItems += '<button></button>';
                }
            } else {
                this.navItems += '<button></button>';
            }
        }

        // Set ul width
        for(var i = 0; i < this.lis.length; i++) {
            this.lis[i].style.width = this.width+'px';
        }

        // Add nav buttons to div
        this.navContainer.innerHTML += this.navItems;
    }

    navClickHandler(e) {
        var nextSlide = getElIndex(e.target);
        // Set the ul position by passing the position of the next slide
        this.setUlPosition(nextSlide);
    }

    getUlPosition(index) {
        var slideCenterOffset = (index * this.width) + (this.width / 2);

        return (this.sliderWrapper.offsetWidth / 2) - slideCenterOffset;
    }

    setUlPosition(index) {
        var position = this.getUlPosition(index);

        // Set ul position
        this.ul.style.left = position+'px';

        // Remove active from current slide and current nav item
        this.lis[this.currentSlide].classList.remove('active');
        this.navContainer.querySelectorAll('button')[this.currentSlide].classList.remove('active');

        // Add active to new slide
        this.lis[index].classList.add('active');
        this.navContainer.querySelectorAll('button')[index].classList.add('active');

        // Update current active slide
        this.currentSlide = index;
    }
}

export default postSlider;