// Get element index
export function getElIndex(el) {
    for (var i = 0; el = el.previousElementSibling; i++);
    return i;
}

// extract host name
export function extractHostname(url) {
    var hostname;
    //find & remove protocol (http, ftp, etc.) and get hostname

    if (url.indexOf("://") > -1) {
        hostname = url.split('/')[2];
    }
    else {
        hostname = url.split('/')[0];
    }

    //find & remove port number
    hostname = hostname.split(':')[0];
    //find & remove "?"
    hostname = hostname.split('?')[0];

    return hostname;
}

// Get element inner width without padding
export function getElementContentWidth(element) {
    var styles = window.getComputedStyle(element);
    var padding = parseFloat(styles.paddingLeft) +
        parseFloat(styles.paddingRight);

    return element.clientWidth - padding;
}

// Get parameter by name
export function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

export function getChildren(n, skipMe){
    var r = [];
    for ( ; n; n = n.nextSibling )
        if ( n.nodeType == 1 && n != skipMe)
            r.push( n );
    return r;
};

export function getSiblings(n) {
    return getChildren(n.parentNode.firstChild, n);
}

// Add event listener for multiple events
export function addListenerMulti(element, eventNames, listener) {
    var events = eventNames.split(' ');
    for (var i=0, iLen=events.length; i<iLen; i++) {
        element.addEventListener(events[i], listener, false);
    }
}

export function getScrollOffset() {
    var v = (window.pageYOffset || document.scrollTop)  - (document.clientTop || 0);
    if(isNaN(v)) {
        v = 0;
    }
    return v;
}

export function getViewportHeight() {
    return Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
}

export function isChildOf(ele,className) {
    while(ele != undefined && ele != null && ele.tagName.toLowerCase() != 'body') {
        if(ele.classList.length) {
            if(ele.classList.contains(className)) {
                return true;
            }
        }
        ele = ele.parentNode;
    }
    return false;
}

export function wrapEle(ele, wrapper, className) {
    ele.parentNode.insertBefore(wrapper, ele);
    wrapper.appendChild(ele);
    wrapper.classList.add(className);

    return wrapper;
}

// get scroll position
export function getScrollPosition() {
    var doc = document.documentElement;
    return (window.pageYOffset || doc.scrollTop) - (doc.clientTop || 0);
}

// easing functions http://goo.gl/5HLl8
Math.easeInOutQuad = function (t, b, c, d) {
    t /= d/2;
    if (t < 1) {
        return c/2*t*t + b
    }
    t--;
    return -c/2 * (t*(t-2) - 1) + b;
};

// requestAnimationFrame for Smart Animating http://goo.gl/sx5sts
var requestAnimFrame = (function(){
    return  window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || function( callback ){ window.setTimeout(callback, 1000 / 60); };
})();

// scroll to a certain point
export function scrollTo(to, callback, duration) {

    function move(amount) {
        document.documentElement.scrollTop = amount;
        document.body.parentNode.scrollTop = amount;
        document.body.scrollTop = amount;
    }
    function position() {
        return document.documentElement.scrollTop || document.body.parentNode.scrollTop || document.body.scrollTop;
    }
    var start = position(),
        change = (to - start),
        currentTime = 0,
        increment = 20;
    duration = (typeof(duration) === 'undefined') ? 500 : duration;
    var animateScroll = function() {
        // increment the time
        currentTime += increment;
        // find the value with the quadratic in-out easing function
        var val = Math.easeInOutQuad(currentTime, start, change, duration); // change to make duration based on distance
        // move the document.body
        move(val);
        // do the animation unless its over
        if (currentTime < duration) {
            requestAnimFrame(animateScroll);
        } else {
            if (callback && typeof(callback) === 'function') {
                // the animation is done so lets callback
                callback();
            }
        }
    };
    animateScroll();
}