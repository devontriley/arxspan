import Barba from 'barba.js';
import { getSiblings, isChildOf } from "./helpers";

export class MainNav {
    constructor() {
        this.nav = document.querySelector('#main-nav ul');
        this.toggleLinks = document.querySelectorAll('li.dropdown');
        this.hamburger = document.getElementById('hamburger');
        this.contactButton = document.getElementById('nav-btn');
        this.activeDropdown;

        var clickEvent = function(event) {
            this.clickHandler(event);
        }.bind(this)

        this.nav.addEventListener('click', clickEvent, false);

        // TODO: Display dropdown on focus?
        // this.nav.addEventListener('focus', clickEvent, false);

        document.body.addEventListener('click', function(e) {
            var target = e.target;

            if(!target.classList.contains('dropdown-toggle') && !isChildOf(target, 'dropdown-menu') && this.activeDropdown) {
                this.closeDropdown();
                this.activeDropdown = undefined;
            }
        }.bind(this), false);

        this.hamburger.addEventListener('click', function(e) {
            e.preventDefault();
            this.hamburger.classList.toggle('transform');
            this.MobileNavToggle();
        }.bind(this));

        this.contactButton.addEventListener('click', function(e) {
            e.preventDefault();
            this.MobileNavToggle('close');
        }.bind(this));
    }

    clickHandler(event) {
        event.preventDefault();
        event.stopPropagation();

        var target = event.target;
        var currentNode = target;

        while(currentNode.parentNode && currentNode.parentNode.id != 'main-nav') {

            // Clicking inside dropdown
            if(currentNode.tagName.toLowerCase() == 'a') {
                // Close current active dropdown
                this.closeDropdown();
                this.MobileNavToggle('close');
                Barba.Pjax.goTo(currentNode.href);
                break;
            }

            // Clicking dropdown
            if(currentNode.classList.contains('dropdown')) {
                this.toggleDropdown(currentNode);
                break;
            }

            currentNode = currentNode.parentNode;
        }

    }

    toggleDropdown(target) {
        // Close current active dropdown
        if(this.activeDropdown) {
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
        if(this.activeDropdown != undefined) {
            this.activeDropdown.classList.remove('active');
            this.activeDropdown = undefined;
        }
    }

    openDropdown(target) {
        this.activeDropdown = target;
        this.activeDropdown.classList.add('active');
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