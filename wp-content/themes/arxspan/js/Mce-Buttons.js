(function() {
    tinymce.create('tinymce.plugins.customButtons', {

        init : function(ed, url) {
            // ed.addButton('columns', {
            //     title : 'Columns',
            //     cmd : 'columns',
            //     image : url + '/products-toolbar-btn.jpg'
            // });

            ed.addButton('sliderimages', {
                title : 'Image Slider',
                cmd : 'sliderimages',
                image : url + '/img-slider-btn.jpg'
            });

            // ed.addCommand('columns', function(){
            //     var ids = prompt('Directions here'),
            //         shortcode = '[shortcode here]';
            //
            //     ed.execCommand('mceInsertContent', 0, shortcode);
            // });

            ed.addCommand('sliderimages', function(){
                var ids = prompt('Enter up to ten comma separated image ids. These ids may be found in the media library. Eg: 264, 265'),
                    shortcode = '[img-slider sliderimages="'+ ids +'"]';

                ed.execCommand('mceInsertContent', 0, shortcode);
            });
        },

        createControl : function(n, cm) {
            return null;
        },

        getInfo : function() {
            return {
                longname : 'Custom Editor Buttons',
                author : 'The Devinator ft: Big Z',
                authorurl : 'http://knowncreative.co',
                infourl : '',
                version : '0.1'
            };
        }
    });

    tinymce.PluginManager.add( 'custom-buttons', tinymce.plugins.customButtons );
})();
