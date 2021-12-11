import { formatDateFromSQL, checkFetchError } from './utils.js';

const params = new URLSearchParams(location.search);
const articleId = parseInt(params.get('id'));

if (!articleId) {
    displayError('Bad article id');
    throw new Error('article id not found');
}

const displayError = (error) => {
    const p = document.createElement('p');
    p.classList.add('article__error');
    p.innerText = error;

    const contentElement = document.querySelector('.article__content');
    contentElement.innerHTML = ''; // Remove content before appending the error
    contentElement.appendChild(p);
};

fetch('../src/article?id=' + articleId)
    .then(checkFetchError)
    .then((response) => {
        const title = document.querySelector('.article__title');
        title.innerText = response.title;

        const category = document.querySelector('.article__category');
        category.innerText = response.category;

        // TODO: image from db
        const image = document.querySelector('.article__image');
        image.src =
            'https://i0.wp.com/www.10wallpaper.com/wallpaper/1680x1050/1912/007_No_Time_to_Die_2020_Daniel_Craig_Films_Poster_1680x1050.jpg';
        image.alt = response.title + ' image';

        const body = document.querySelector('.article__body');
        body.innerText = response.body;

        const createdAt = formatDateFromSQL(response.created_at);
        const updatedAt = formatDateFromSQL(response.updated_at);

        const createdAtElement = document.querySelector('.article__created_at');
        createdAtElement.innerText = createdAt;

        const updatedAtElement = document.querySelector('.article__updated_at');
        if (updatedAt !== createdAt)
            updatedAtElement.innerText = '- MAJ: ' + updatedAt;

        const author = document.querySelector('.article__author');
        author.innerText = response.author;
    })
    .catch((error) => displayError(error + ' :(\nPlease retry later'));
