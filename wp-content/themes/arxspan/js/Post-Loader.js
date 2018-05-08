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

        console.log('load');

        var createXhrRequest = function( httpMethod, url, data, callback ) {
            var xhr = new XMLHttpRequest();
            xhr.open( httpMethod, url );
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onreadystatechange = function() {
                callback(xhr);
            };
            xhr.send(JSON.stringify(data));
        }

        createXhrRequest( "GET", ajaxurl+'?action='+data.action, data, function(xhr) {

            console.log(xhr);

            if(xhr.readyState == 4 && xhr.status == 400) {

                var response = JSON.parse(xhr.response);

                this.wrapper.innerHTML += response.html;
            }

        }.bind(this));

    }
}

export default newsEventQuery;