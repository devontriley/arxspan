class swapSVG {
    constructor() {
        this.svg = document.getElementById('main-background');
        this.newFilename;
    }

    check() {
        this.firstLoad = 'false';
        this.svg.style.opacity = 0;
        this.ajax();
    }

    ajax() {
        var data = {
            'action' : 'set_main_bg'
        }

        //AJAX call
        var createXhrRequest = function( httpMethod, url, data, callback ) {

            var xhr = new XMLHttpRequest();
            xhr.open(httpMethod, url);
            xhr.setRequestHeader('Content-Type', 'text/html');
            xhr.onreadystatechange = function() {
                callback(xhr);
            };
            xhr.send(JSON.stringify(data));

        }

        createXhrRequest( "GET", ajaxurl+'?action='+data.action, data, function(xhr) {

            if(xhr.status == 200 && xhr.readyState == 4) {

                this.newFilename = xhr.response;

                this.change(this.newFilename);

            }

        }.bind(this));
    }

    change(filename) {
        this.svg.src = filename;
        setTimeout(function() {
            this.svg.style.opacity = 1;
        }.bind(this), 10);
    }
}

export default swapSVG;