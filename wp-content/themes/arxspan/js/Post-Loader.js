// NEWS AND EVENTS AJAX LOADER

class newsEventQuery {
    constructor() {
        this.wrapper = document.querySelector('#posts-container .grid-inner');
        this.currentPage = 0;
        // this.totalPosts = this.wrapper.dataset.total;
        // this.pageOffset = this.wrapper.dataset.offset;
        // this.totalPages = Math.ceil(this.total / 8);
        this.loadBtn = document.getElementById('load-more');
        this.ajaxData = '';

        console.log('GOODBYE');


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

        var wrapper = this.wrapper;

        //AJAX call
        var createXhrRequest = function( httpMethod, url, data, wrapper, callback ) {

            console.log(wrapper);

            var xhr = new XMLHttpRequest();
            xhr.open( httpMethod, url );

            xhr.setRequestHeader('Content-Type', 'application/json');

            xhr.onload = function() {
                callback( null, xhr.response, wrapper );
            };

            xhr.onerror = function() {
                callback( xhr.response, wrapper );
            };

            xhr.send(JSON.stringify(data));
        }

        createXhrRequest( "GET", ajaxurl+'?action='+data.action, data, this.wrapper, function( err, response, wrapper ) {

            // Do your post processing here.
            if( err ) { console.log( "Error!" ); }

            // console.log(response);

            this.wrapper.innerHTML += response.html;

        });

        // var xhr = new XMLHttpRequest();
        // xhr.open('GET', ajaxurl+'?action='+data.action, true);
        // xhr.setRequestHeader('Content-Type', 'application/json');
        // xhr.onreadystatechange = function() {
        //
        //     // check for success
        //     if (xhr.status === 200 && xhr.readyState == 4) {
        //         //alert('Something went wrong.  Name is now ' + xhr.responseText);
        //         // console.log(xhr.responseText.html);
        //         var html = xhr.responseText.html;
        //
        //         console.log(wrapper);
        //
        //         wrapper.innerHTML += html;
        //         this.currentPage++;
        //     }
        //     else if (xhr.status !== 200) {
        //         console.log('Request failed.  Returned status of ' + xhr.status);
        //     }
        // };
        // //actually send it
        // xhr.send(JSON.stringify(data));

    }
}

var postGrid = document.getElementById('load-more');
if(postGrid) {
    var postLoader = new newsEventQuery();
}

export default newsEventQuery;