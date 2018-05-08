// NEWS AND EVENTS AJAX LOADER

class newsEventQuery {
    constructor() {
        this.wrapper = document.querySelector('.posts-container .grid-inner');
        this.currentPage = 0;
        this.loadBtn = document.getElementById('load-more');
        this.stopLoading = false;

        this.createXhrRequest = function( httpMethod, url, data, callback ) {
            var xhr = new XMLHttpRequest();
            xhr.open( httpMethod, url );
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onreadystatechange = function() {
                callback( xhr );
            };
            xhr.send(JSON.stringify(data));
        }

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

        this.createXhrRequest( "GET", ajaxurl+'?action='+data.action, data, function( xhr ) {

            if (xhr.readyState == 4 && xhr.status == 200) {

                if (xhr.response && !this.stopLoading) {

                    this.wrapper.innerHTML += response.html;

                    this.stopLoading = true;

                }

            }

        }.bind(this));

    }
}

var postGrid = document.getElementById('load-more');
if(postGrid) {
    var postLoader = new newsEventQuery();
}

export default newsEventQuery;