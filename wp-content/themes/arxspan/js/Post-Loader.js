// NEWS AND EVENTS AJAX LOADER

class newsEventQuery {
    constructor() {
        this.currentPage = parseInt(this.wrapper.dataset.page) + 1;
        this.totalPosts = this.wrapper.dataset.total;
        this.pageOffset = this.wrapper.dataset.offset;
        this.totalPages = Math.ceil(this.total / 8);
        this.loadBtn = document.getElementById('load-more');
        this.btnText = document.getElementById('load-text');
        this.loader = document.getElementById('loader');
        this.wrapper = document.querySelector('#posts-container .grid-inner');
        this.ajaxData = '';


        this.loadBtn.addEventListener('click', function(){
            this.loadMore();
        }.bind(this));
    }

    loadMore() {
        this.loader.classList.add('active');
        this.btnText.classList.add('off');
        this.loadArticles();
        this.btnText.classList.remove('off');
        this.loader.classList.remove('active');
    }

    loadArticles() {
        $.ajax({
            url: ajaxurl,
            dataType : 'json',
            data: {
                'action': 'load_more_news_posts',
                'wrapper' : this.currentPage,
                'offset' : this.pageOffset
            },
            type: 'GET',
            success: function (data) {
                this.ajaxData = data.html;
                this.pageOffset = parseInt(this.pageOffset) + parseInt(data.offset);
                this.currentPage = this.currentPage + 1;

                if(this.pageOffset >= parseInt(this.totalPosts)){
                    this.loadBtn.classList.add('disable');
                }

                this.wrapper.append(this.ajaxData);

            }.bind(this)
        });
    }
}

var postGrid = document.getElementById('load-more');
if(postGrid) {
    var postLoader = new newsEventQuery();
}