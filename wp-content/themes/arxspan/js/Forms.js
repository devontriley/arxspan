import { wrapEle } from './helpers.js';

class contactForm {
    constructor(form) {
        this.form = form;
        this.fields = form.querySelectorAll('.field');
        this.hiddenFields = form.querySelectorAll('input[type=hidden]');
        this.fieldsArr = [];
        this.errors = false;
        this.success = this.form.querySelector('.form-success');
        this.submit = this.form.querySelector('#submit');
        this.validationErrors = {
            'required': 'Required',
            'name': 'At least 4 characters and include no special characters',
            'email': 'Enter a valid email address',
            'invalid': 'invalid characters',
            'human': 'incorrect'
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

        if(this.fields.length) {
            for (var i = 0; i < this.fields.length; i++) {
                var input = this.fields[i].querySelector('input:not([type=submit])');
                if (input != null) {
                    var value = null;
                    var name = input.name;
                    var inlineMsg = this.fields[i].querySelector('.inline-msg');
                    if (input.value != '') {
                        value = input.value;
                        if (value) {
                            this.fields[i].querySelector('label').classList.add('active');
                        }
                    }

                    this.fieldsArr[i] = {
                        'ele': input,
                        'name': name,
                        'input': input,
                        'value': value,
                        'inlineMsg': inlineMsg
                    }
                }
            }
        }

        form.addEventListener('submit', function(evt) {
            evt.preventDefault();
            this.clearErrors();
            this.validateForm();
        }.bind(this));
    }

    clearErrors() {
        this.errors = false;

        for(var i = 0; i < this.fieldsArr.length; i++) {
            this.fieldsArr[i].ele.classList.remove('error');
            if(this.fieldsArr[i].inlineMsg) {
                this.fieldsArr[i].inlineMsg.innerHTML = '';
            }
        }
    }

    validateForm() {
        for(var i = 0; i < this.fieldsArr.length; i++) {
            var input = this.fieldsArr[i].input,
                value = input.value,
                inlineMsg = this.fieldsArr[i].inlineMsg;

            if(input.required && !value) {
                this.errors = true;
                inlineMsg.innerHTML = this.validationErrors.required;
                this.fieldsArr[i].ele.classList.add('error');
            }

            // TODO Better way to implement error class on fields
            switch(input.type) {
                case 'text':
                    if(input.name == 'fname' || input.name == 'lname'){
                        if(!this.validateName(value) || this.validateChars(value)) {
                            this.errors = true;
                            inlineMsg.innerHTML = this.validationErrors.name;
                            this.fieldsArr[i].ele.classList.add('error');
                        }
                    }
                    if(input.name == 'not_human') {
                        if(!value) {
                            this.errors = true;
                            inlineMsg.innerHTML = this.validationErrors.required;
                            this.fieldsArr[i].ele.classList.add('error');
                        } else if(value !== '9') {
                            this.errors = true;
                            inlineMsg.innerHTML = this.validationErrors.human;
                            this.fieldsArr[i].ele.classList.add('error');
                        }
                    }
                    break;
                case 'email':
                    if(!this.validateEmail(value)) {
                        this.errors = true;
                        inlineMsg.innerHTML = this.validationErrors.email;
                        this.fieldsArr[i].ele.classList.add('error');
                    }
                    break;
                case 'message':
                    // TODO validate textarea
                    break;
            }
        }

        if(!this.errors) {
            this.submitForm();
        }
    }

    validateName(value) {
        if(value){
            if(value.length <= 3) {
                return false;
            } else {
                return true;
            }
        }
    }

    validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    validateChars(value){
        var re = /[~`!#$%\^&*+=\\[\]\\';,/{}|\\":<>\?]/g;
        return re.test(String(value).toLowerCase());
    }

    submitForm() {
        var data = {
            'action' : 'contact_form_submit'
        }

        for(var i = 0; i < this.hiddenFields.length; i++) {
            var name = this.hiddenFields[i].name,
                value = this.hiddenFields[i].value;

            if(name) data[name] = value;
        }

        for(var i = 0; i < this.fieldsArr.length; i++) {
            var name = this.fieldsArr[i].name,
                value = this.fieldsArr[i].input.value;

            if(name) data[name] = value;
        }

        this.submit.innerText = 'Loading';

        var xhr = new XMLHttpRequest();
        xhr.open('POST', ajaxurl+'?action='+data.action, true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function() {
            if (xhr.status === 200 && xhr.readyState == 4) {
                // Hide form
                this.form.style.display = 'none';

                if(this.form.dataset.form == 'contact') {

                    var html = '<p>Thanks for your interest in Arxspan.</p>';

                    this.form.parentNode.innerHTML += html;

                } else if(this.form.dataset.form == 'whitepaper') {

                    var html = '<p>Thanks for your interest in Arxspan. <a href="'+ this.form.dataset.download +'" target="_blank">Click here</a> to download your Whitepaper.</p>';

                    this.form.parentNode.innerHTML += html;

                }
            }
            else if (xhr.status !== 200) {
                console.log('Request failed.  Returned status of ' + xhr.status);
            }
        }.bind(this);

        xhr.send(JSON.stringify(data));
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
                li.tabIndex = 0;

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

export { contactForm, styledSelect }