// Get element index
export function getElIndex(el) {
    for (var i = 0; el = el.previousElementSibling; i++);
    return i;
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