// Make sure main is loaded first
require(['main'], function() {
    // Load dependencies
    require(['jquery', 'modules/Tab-Module'], function($, tabModule) {

        var tabModule1 = new tabModule(document.querySelector('.tab-module'), 'Properties we can pass!!');

        if(document.getElementsByClassName('tab-module')){
            var tabModules = document.getElementsByClassName('tab-module'); // will return an array
            var tabModulesArr = []; // to add custom data

            for(i = 0; i < tabModules.length; i++){

                tabModulesArr.push( //for each instance of tab module we will add object to array
                    new tabModule(tabModules[i]) // will ref element we are passing to class
                ) // after this will have array of all classes
            }
        }
    });
});