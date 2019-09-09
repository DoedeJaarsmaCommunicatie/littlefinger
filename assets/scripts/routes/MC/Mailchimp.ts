export default class Mailchimp {
    static route = 'wp-json/djc/v1/mailchimp';

    options = {
        formSelector: '.js-mc-form'
    };

    form?: HTMLFormElement;

    constructor() {
        this.getForm();
        this.stopEvents();
    }

    getForm() {
        // @ts-ignore
        this.form = document.querySelector(this.options.formSelector)
    }

    stopEvents() {
        this.form!.addEventListener('submit', function (e: any) {
            e.preventDefault();
            e.target.querySelector('button').innerHTML = 'Verzenden...';
            e.target.querySelector('button').disabled = true;
            
            
            let data = new FormData(e.target);
            
            fetch('/wp-json/djc/v1/mailchimp', {
                method: 'POST',
                body: data
            }).then(res => {
                e.target.reset();
                e.target.querySelector('button').innerHTML = 'Aanmelden';
                e.querySelector('button').disabled = false;
            }).catch(err => {
                e.target.querySelector('button').innerHTML = 'Aanmelden';
                e.querySelector('button').disabled = false;
            })
        })
    }
}