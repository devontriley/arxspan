define(function(require) {

    function Utilities() {

        // Get element index
        this.getElIndex = function(el) {
            for (var i = 0; el = el.previousElementSibling; i++);
            return i;
        }

        // Get parameter by name
        this.getParameterByName = function(name, url) {
            if (!url) url = window.location.href;
            name = name.replace(/[\[\]]/g, "\\$&");
            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, " "));
        }

    }

    return Utilities;

});