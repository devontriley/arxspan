// NEWS AND EVENTS AJAX LOADER

class newsEventQuery {
    constructor() {
        this.currentPage = 0;
        this.total = $('#article-grid').attr('data-total');
        this.totalPages = Math.ceil(this.total / 6);
        this.prevBtn = document.querySelector('#page-counter #prev');
        this.nextBtn = document.querySelector('#page-counter #next');
        this.pageBtns = document.querySelectorAll('#page-counter button.page-num');
        this.loader = document.getElementById('loader');
        this.gridInner = document.querySelector('#article-grid #grid-inner');
        this.rows = this.gridInner.querySelectorAll('.row');
        this.rowCounter = 0;
        this.row1;
        this.row2;
        this.ajaxData = '';

        this.prevBtn.addEventListener('click', function(){
            this.prev();
        }.bind(this));

        this.nextBtn.addEventListener('click', function(){
            this.next();
        }.bind(this));

        for(var i = 0; i < this.pageBtns.length; i++) {
            var btn = this.pageBtns[i];
            var current = i;
            btn.addEventListener('click', function(e){
                this.goToPage(e.target);
            }.bind(this));
        }

    }

    prev() {
        if(this.currentPage !== 0) { // don't go below 0
            this.loader.classList.add('active');
            this.currentPage = this.currentPage - 1;
            this.loadPage();
            if(this.currentPage == 0) {
                this.prevBtn.classList.add('disable');
            }
        }
        this.nextBtn.classList.remove('disable');
    }

    next() {
        if(this.currentPage < (this.totalPages - 1)) {
            this.loader.classList.add('active');
            this.prevBtn.classList.remove('disable');
            this.currentPage = this.currentPage + 1;
            this.loadPage();
            if(this.currentPage == this.totalPages - 1) {
                this.nextBtn.classList.add('disable');
            }
        }
    }

    addRows() {
        setVendor(this.row1, 'opacity', '0');
        setVendor(this.row1, 'transform', 'translateX(50px)');
        setVendor(this.row2, 'opacity', '0');
        setVendor(this.row2, 'transform', 'translateX(50px)');

        this.gridInner.appendChild(this.row1);
        this.gridInner.appendChild(this.row2);
        this.rows = this.gridInner.querySelectorAll('.row');

        setTimeout(function(){
            setVendor(this.row1, 'opacity', '1');
            setVendor(this.row1, 'transform', 'translateX(0)');
        }.bind(this), 100);

        setTimeout(function(){
            setVendor(this.row2, 'opacity', '1');
            setVendor(this.row2, 'transform', 'translateX(0)');

            this.scrollUp();
        }.bind(this), 300);
    }

    loadPage() {
        $.ajax({
            url: ajaxurl,
            dataType : 'json',
            data: {
                'action': 'knowledge_base_query',
                'currentPage': this.currentPage
            },
            type: 'GET',
            cache: true,
            beforeSend: function() {
                // set minimum height on row container
                var total = 0;
                for(var i = 0; i < this.rows.length; i++) {
                    total = total + this.rows[i].getBoundingClientRect().height;
                }
                this.gridInner.style.minHeight = total+'px';
            }.bind(this),
            success: function (data) {
                this.ajaxData = data.html;
                var tempDiv = document.createElement('div');
                tempDiv.innerHTML = this.ajaxData;
                this.row1 = tempDiv.children[0];
                this.row2 = tempDiv.children[1];

                this.loader.classList.remove('active');

                // Slide/fade out rows
                this.removeRows();

            }.bind(this)
        });
    }
}

var resourcesGrid = document.querySelector('body.page-template-page-resources #article-grid');
if(resourcesGrid) {
    var postLoader = new newsEventQuery();
}