// NEWS AND EVENTS AJAX LOADER

class newsEventQuery {
    constructor() {
        this.wrapper = document.querySelector('.posts-container .grid-inner');
        this.currentPage = 0;
        this.loadBtn = document.getElementById('load-more');

        this.loadBtn.addEventListener('click', function(){
            this.loadMore();
        }.bind(this));
    }

    loadMore() {
        this.loadBtn.classList.add('off'); // have gif in button and have gif display on .off
        this.loadArticles();
        this.loadBtn.classList.remove('off'); // next time delay this until success
    }

    loadArticles() {
        var data = {
            'action' : 'load_more_news_posts',
            'currentPage' : this.currentPage
        }

        //AJAX call
        var createXhrRequest = function( httpMethod, url, data, callback ) {

            var xhr = new XMLHttpRequest();
            xhr.open( httpMethod, url );

            xhr.setRequestHeader('Content-Type', 'application/json');

            xhr.onload = function() {
                callback( null, xhr.response, wrapper );
            };

            xhr.onerror = function() {
                callback( xhr.response, null, wrapper );
            };

            xhr.send(JSON.stringify(data));
        }

        var wrapper = this.wrapper;

        createXhrRequest( "GET", ajaxurl+'?action='+data.action, data, function( err, response, wrapper ) {

            if( err ) {
                console.log( "Error!" );

                wrapper.innerHtml += 'Error';
            }

            var response = JSON.parse(response);

            wrapper.innerHTML += response.html;

        });

    }
}

var postGrid = document.getElementById('load-more');
if(postGrid) {
    var postLoader = new newsEventQuery();
}

export default newsEventQuery;