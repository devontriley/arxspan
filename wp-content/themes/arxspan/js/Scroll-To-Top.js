import { scrollTo } from './helpers';

class scrollToTop {
    constructor(){
        this.scrollTopButton = document.getElementById('scroll-to-top');

        if(this.scrollTopButton){
            this.scrollTopButton.addEventListener('click', function(e) {
               scrollTo(0, function(){

                }, 1500);
            }.bind(this));
        }
    }
}

export default scrollToTop;