/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.css');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// var $ = require('jquery');

import axios from 'axios';


console.log('Hello Webpack Encore! Edit me in assets/js/app.js');

function deleteButtonClicked(event)
{
    console.log(event);
    const itemId = event.target.getAttribute('data-id');
    console.log(itemId);

    // send the HTTP REQ
    axios.delete('/todoList/deleteItem/' + itemId)
        .then(response => location.reload());
}

function completeButtonClicked(event)
{
    const itemId = event.target.getAttribute('data-id');
    axios.post('/todoList/item/' + itemId + '/toggleIsDone')
        .then(response => location.reload());
}

let deleteButtons = document.querySelectorAll('.deleteButton');
deleteButtons.forEach(button => button.addEventListener('click', deleteButtonClicked));

let isDoneButtons = document.querySelectorAll('.completeButton');
isDoneButtons.forEach(button => button.addEventListener('click', completeButtonClicked));
