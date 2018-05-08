// NEWS AND EVENTS AJAX LOADER

class newsEventQuery {
    constructor() {
        this.wrapper = document.querySelector('.posts-container .grid-inner');
        this.currentPage = 0;
        this.foundPosts = this.wrapper.dataset.found;
        this.loadBtn = document.getElementById('load-more');

        this.loadBtn.addEventListener('click', function(){
            if( this.foundPosts > ((this.currentPage * 4) + 8) ) {
                this.loadMore();
            }
        }.bind(this));
    }

    loadMore() {
        this.loadBtn.classList.add('off'); // have gif in button and have gif display on .off
        this.loadArticles();
    }

    loadArticles() {
        var data = {
            'action' : 'load_more_news_posts',
            'currentPage' : this.currentPage
        }

        //AJAX call
        var createXhrRequest = function( httpMethod, url, data, callback ) {

            var xhr = new XMLHttpRequest();
            xhr.open(httpMethod, url);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onreadystatechange = function() {
                callback(xhr);
            };
            xhr.send(JSON.stringify(data));

        }

        createXhrRequest( "POST", ajaxurl+'?action='+data.action, data, function(xhr) {

            if(xhr.status == 200 && xhr.readyState == 4) {
                var response = JSON.parse(xhr.response);

                this.wrapper.innerHTML += response.html;
                this.loadBtn.classList.remove('off');

                this.currentPage++;

                if( this.foundPosts <= ((this.currentPage * 4) + 8) ) {
                    this.loadBtn.style.display = 'none';
                }
            }

        }.bind(this));

    }
}

export default newsEventQuery;