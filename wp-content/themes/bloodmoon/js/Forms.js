import { wrapEle } from './helpers.js';

class defaultForm {
    constructor(ele) {
        this.form = ele;
        this.fields = this.form.querySelectorAll('.field');

        if(this.fields.length) {
            for(var i = 0; i < this.fields.length; i++) {
                var input = this.fields[i].querySelector('input:not([type=submit])');

                if(input != null) {
                    var value = null;
                    if(input.value != '') {
                        value = input.value;

                        if(value) {
                            this.fields[i].querySelector('label').classList.add('active');
                        }
                    }
                }
            }
        }
        // Add active class to label on focus
        this.form.addEventListener('focusin', function(e) {
            var label = e.target.previousElementSibling;
            if(label) label.classList.add('active');
        });

        // Remove active class from label on focusout if empty
        this.form.addEventListener('focusout', function(e) {
            var label = e.target.previousElementSibling;
            if(e.target.value == '') {
                if(label) label.classList.remove('active');
            }
        });
    }
}

class styledSelect {
    constructor(select) {
        this.select = select;
        this.options = this.select.querySelectorAll('option');
        this.numberOfOptions = this.options.length;
        this.selected = this.select.options[this.select.selectedIndex].value;

        if (this.selected == this.options[0].text) {
            this.selected = '';
        }

        this.select.classList.add('select-hidden');

        // Wrap select in a div
        this.selectWrapper = wrapEle(this.select, document.createElement('div'), 'select');
        this.selectWrapper.tabIndex = 0;

        // Create new div for styled select and append to wrapper
        this.styledSelect = document.createElement('div');
        this.styledSelect.classList.add('select-styled');
        this.styledSelect.innerText = this.options[0].text;
        this.selectWrapper.appendChild(this.styledSelect);

        // Create list element and append to styled select
        this.list = document.createElement('ul');
        this.list.classList.add('select-options');
        this.styledSelect.appendChild(this.list);

        // Create li for each select option and append to ul
        for (var i = 0; i < this.numberOfOptions; i++) {
            var li = document.createElement('li');
                li.innerText = this.select[i].text;
                li.rel = this.select[i].value;

            this.list.appendChild(li);
        }

        if (this.selected.length) {
            this.styledSelect.text = this.selected.text;
            this.select.value = this.selected.text;
        }

        this.styledSelect.addEventListener('click', function(e) {
            this.open(e);
        }.bind(this));

        this.selectWrapper.addEventListener('focus', function(e) {
            this.open(e);
        }.bind(this));

        this.selectWrapper.addEventListener('blur', function(e) {
           this.close(e);
        }.bind(this));

        this.list.addEventListener('click', function(e) {
            if(e.target.tagName.toLowerCase() == 'li') {
                this.selectOption(e);
            }
        }.bind(this));


        document.addEventListener('click', function (e) {
            this.close();
        }.bind(this));
    }

    open(e) {
        e.stopPropagation();
        // Close other currently active selects
        var activeSelect = document.querySelector('.select-styled.active');
        if(activeSelect) activeSelect.classList.remove('active');

        this.styledSelect.classList.toggle('active');
    }

    close() {
        this.styledSelect.classList.remove('active');
    }

    selectOption(e) {
        e.stopPropagation();
        this.styledSelect.innerText = e.target.innerText;
        this.styledSelect.classList.remove('active');
        this.select.value = e.target.rel;
    }
}

export { styledSelect, defaultForm }