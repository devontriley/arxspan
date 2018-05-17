import {getScrollPosition, scrollTo} from './helpers';

class scrollToTop {
    constructor(){
        this.scrollTopButton = document.getElementById('scroll-to-top');

        //get height of page
        var body = document.body,
            html = document.documentElement;

        var docHeight = Math.max( body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight );
        var halfHeight = ( (docHeight / 2) - 317 ); // half height does not account for header + footer

        console.log(halfHeight);

        this.interval = setInterval(function(){
            this.currentScroll = getScrollPosition();

            // show if 50% scroll or greater
            if (this.currentScroll >= halfHeight){
                this.scrollTopButton.classList.add('active');
            }

            // remove button if scroll back to top
            if (this.currentScroll < halfHeight) {
                    this.scrollTopButton.classList.remove('active');
                }

            console.log(this.currentScroll);
        }.bind(this), 30);

        if(this.scrollTopButton){
            this.scrollTopButton.addEventListener('click', function(e) {
               scrollTo(0, function(){

                }, 1500);
            }.bind(this));
        }
    }
}

export default scrollToTop;