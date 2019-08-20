import Axios from "axios";

export default function () {
    const streek$ = document.querySelectorAll('[data-attribute="streek"]');

    if (streek$.length < 1) {
        throw new Error('Streek niet gevonden.');
    }

    for (let streek in streek$) {
        if (streek$.hasOwnProperty(streek)) {
            const el = streek$[streek] as HTMLElement;

            Axios.get(`/wp-json/wp/v2/streek?slug=${el.dataset.value}`)
                .then(res => {
                    el.innerHTML = `<a href="${res.data[0].link}">${res.data[0].title.rendered}</a>`
                })
                .catch(e => {
                    // do nothing. No link found for this 'streek'
                })
        }
    }

}
