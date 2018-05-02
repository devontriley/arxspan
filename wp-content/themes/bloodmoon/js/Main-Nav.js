import Barba from 'barba.js';
import { getSiblings, isChildOf } from "./helpers";

// TODO: Display dropdown on focus?

export class MainNav {
    constructor() {
        this.nav = document.querySelector('#main-nav ul');
        this.toggleLinks = document.querySelectorAll('li.dropdown');
        this.hamburger = document.getElementById('hamburger');
        this.activeDropdown;

        var clickEvent = function(event) {
            this.clickHandler(event);
        }.bind(this)

        this.nav.addEventListener('click', clickEvent, false);
        // this.nav.addEventListener('focus', clickEvent, false);

        document.body.addEventListener('click', function(e) {
            var target = e.target;

            if(!target.classList.contains('dropdown-toggle') && !isChildOf(target, 'dropdown-menu') && this.activeDropdown ) {
                this.closeDropdown();
                this.activeDropdown = undefined;
            }
        }.bind(this), false);

        this.hamburger.addEventListener('click', function(e) {
            e.preventDefault();
            this.MobileNavToggle();
        }.bind(this));
    }

    clickHandler(event) {
        var target = event.target;

        // Toggle dropdown
        if(target.classList.contains('dropdown-toggle')) {
            this.toggleDropdown(target);
        }

        // Navigate to url
        if(isChildOf(target, 'dropdown-menu') && target.tagName.toLowerCase() == 'a') {
            event.preventDefault();
            this.closeDropdown();
            this.activeDropdown = undefined;
            this.MobileNavToggle('close');
            Barba.Pjax.goTo(target.href);
        }
    }

    toggleDropdown(target) {
        if(this.activeDropdown) {
            // Close current active dropdown
            this.closeDropdown();
        }
        // Open when we're not clicking on currently open dropdown
        if(target != this.activeDropdown) {
            this.openDropdown(target);
        } else {
            // Reset activeDropdown when clicking currently active dropdown
            this.activeDropdown = undefined;
        }
    }

    closeDropdown() {
        this.activeDropdown.parentNode.classList.remove('active');
    }

    openDropdown(target) {
        this.activeDropdown = target;
        this.activeDropdown.parentNode.classList.add('active');
    }

     MobileNavToggle(close) {
        if(close == 'close'){
            document.body.classList.remove('mobile-nav-active');
        } else {
            document.body.classList.toggle('mobile-nav-active');
        }
    }
}

export default MainNav;