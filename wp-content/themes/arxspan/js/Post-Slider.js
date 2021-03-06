import { getElIndex, getElementContentWidth } from './helpers.js';

class postSlider {
    constructor(ele) {
        this.sliderWrapper = ele;
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
            }

            if(window.mobileDetected) {
                var posts = this.lis[i].querySelectorAll('.post-container');
                for(var x = 0; x < posts.length; x++){
                    posts[x].style.maxWidth = (this.width / 2)+'px';
                    if(i == 0 && x == 0) {
                        this.navItems += '<button class="active"></button>';
                    } else {
                        this.navItems += '<button></button>';
                    }
                }
            } else {
                if(i == 0) {
                    this.navItems += '<button class="active"></button>';
                } else {
                    this.navItems += '<button></button>';
                }
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
        var slideCenterOffset = (window.mobileDetected) ? (index * (this.width / 2)) : (index * this.width) + (this.width / 2);

        return (window.mobileDetected) ? -slideCenterOffset : (this.sliderWrapper.offsetWidth / 2) - slideCenterOffset;
    }

    setUlPosition(index) {
        var position = this.getUlPosition(index);

        // Set ul position
        this.ul.style.left = position+'px';


        // Active class on nav buttons
        this.navContainer.querySelectorAll('button')[this.currentSlide].classList.remove('active');
        this.navContainer.querySelectorAll('button')[index].classList.add('active');

        // Update current active slide
        this.currentSlide = index;
    }
}

export default postSlider;