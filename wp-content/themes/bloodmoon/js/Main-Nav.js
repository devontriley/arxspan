import Barba from 'barba.js';
import { getSiblings, isChildOf } from "./helpers";

// TODO: Add close when clicking outside dropdown
// TODO: blur() when clicking away from list item
// TODO: On clicking dropdown menu item, Barba.Pjax.goTo(url)

export class MainNav {
    constructor() {
        this.nav = document.querySelector('#main-nav ul');
        this.toggleLinks = document.querySelectorAll('li.dropdown');
        this.hamburger = document.getElementById('hamburger');

        var clickEvent = function(event) {
            this.clickHandler(event);
        }.bind(this)

        this.nav.addEventListener('click', clickEvent, false);
        this.nav.addEventListener('focus', clickEvent, false);
        // document.body.addEventListener('click', function(e) {
        //     this.closeDropdown(e);
        // }.bind(this))

        this.hamburger.addEventListener('click', function(e) {
            e.preventDefault();

            this.MobileNavToggle();
        }.bind(this));
    }

    clickHandler(event) {
        var ele = event.target;
        var siblings;

        if(isChildOf(ele, 'dropdown-menu') && ele.tagName.toLowerCase() == 'a') {
            // Element is inside dropdown and is <a>
            event.preventDefault();
            Barba.Pjax.goTo(ele.href);
        } else {
            while(!ele.classList.contains('dropdown-toggle')) {
                ele = ele.parentNode;
                event.stopPropagation();
            }

            siblings = getSiblings(ele.parentNode);

            for(var i = 0; i < siblings.length; i++) {
                siblings[i].classList.remove('active');
            }

            if(!ele.parentNode.classList.contains('active')) {
                ele.parentNode.classList.add('active');
            } else {
                ele.parentNode.classList.remove('active');
            }
        }
    }

    // closeDropdown(event) {
    //     console.log(this.toggleLinks);
    // }

     MobileNavToggle() {
        document.body.classList.toggle('mobile-nav-active');
    }
}

export default MainNav;