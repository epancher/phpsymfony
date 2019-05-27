/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

import Places from 'places.js';
import Map from './modules/map';

Map.init()

let inputAddress = document.querySelector('#evenement_address')

if (inputAddress !== null) // si l'élément a été trouvé dans le DOM
{
    //on inclue l'import Places
    let place = Places(
        {
            // on met container comme paramètre
            //container est l'élément qui sera remplacé par le système d'auto complétion
            container: inputAddress
        }
    )

    // et on va écouter les changements sur la variable place (quand l'utilisateur aura saisi une valeur):
    place.on('change', e => {
        document.querySelector('#evenement_city').value = e.suggestion.city
        document.querySelector('#evenement_postal_code').value = e.suggestion.postcode
        document.querySelector('#evenement_lat').value = e.suggestion.latlng.lat
        document.querySelector('#evenement_lng').value = e.suggestion.latlng.lng
    })
}




let $ = require('jquery')
// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.css');

require('select2')

$('select').select2()
let $contactButton = $('#contactButton')
$contactButton.click(e => {
    e.preventDefault()
    $('#contactForm').slideDown();
    $contactButton.slideUp();
})

// Suppression des éléments
document.querySelectorAll('[data-delete]').forEach(a => {
    a.addEventListener('click', e => {
        e.preventDefault()
        fetch(a.getAttribute('href'), {
            method: 'DELETE',
            headers: {
                'X-Requested-Width': 'XMLHttpRequest',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({'_token': a.dataset.token})
        }).then(response => response.json())
          .then(data => {
              if (data.success){
                a.parentNode.parentNode.removeChild(a.parentNode)
              } else {
                  alert(data.error)
              }
        })
        .catch(e => alert(e))
    })
})

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// const $ = require('jquery');

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');
