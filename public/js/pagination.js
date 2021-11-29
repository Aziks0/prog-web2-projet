import { formatDateFromSQL, checkFetchError } from './utils.js';

const params = new URLSearchParams(location.search);
const pageNumber = parseInt(params.get('page')) || 1; // pageNumber = 1 if no query param
const articlesPerPage = 5;

/**
 * Create pagination elements
 *
 * @param {number} articlesCount The total number of articles
 * @returns {HTMLUListElement} A ul element containing the pagination
 */
const createPagination = (articlesCount) => {
    const totalPages = Math.ceil(articlesCount / articlesPerPage);

    const divContainer = document.createElement('div');
    divContainer.classList.add('index__pagination__container');

    const buttonPrevious = document.createElement('button');
    if (pageNumber === 1) buttonPrevious.disabled = true;
    buttonPrevious.type = 'Button';
    buttonPrevious.innerText = '<';
    buttonPrevious.onclick = () =>
        (location.href = `/prog-web2-projet/public?page=${pageNumber - 1}`);
    divContainer.appendChild(buttonPrevious);

    const ul = document.createElement('ul');

    for (let i = 1; i < totalPages + 1; i++) {
        const list = document.createElement('li');

        if (i === pageNumber) list.classList.add('index__pagination__selected');

        const anchor = document.createElement('a');
        anchor.href = `/prog-web2-projet/public?page=${i}`;
        anchor.innerText = i;

        list.appendChild(anchor);
        ul.appendChild(list);
    }

    divContainer.appendChild(ul);

    const buttonNext = document.createElement('button');
    if (pageNumber === totalPages) buttonNext.disabled = true;
    buttonNext.type = 'Button';
    buttonNext.innerText = '>';
    buttonNext.onclick = () =>
        (location.href = `/prog-web2-projet/public?page=${pageNumber + 1}`);
    divContainer.appendChild(buttonNext);

    return divContainer;
};

/**
 * Create articles elements styled for desktop
 *
 * @param {Array} articles An array of articles
 * @param {number} articlesCount The total number of articles
 * @returns {HTMLDivElement} A div element containing the articles
 */
const createDesktopArticles = (articles, articlesCount) => {
    if (articles.length === 0) return;

    const backgroundContainer = document.createElement('div');
    backgroundContainer.classList.add(
        'index__article__background__container',
        'index__article__desktop'
    );

    const container = document.createElement('div');
    container.classList.add(
        'index__article__container',
        'index__article__desktop'
    );

    articles.forEach((article) => {
        const articleElement = document.createElement('article');

        const infoContainer = document.createElement('div');
        infoContainer.classList.add('index__article__info__container');
        infoContainer.onclick = () =>
            (window.location.href = `./articles?id=${article.id}`);

        // TODO: image from db
        const image = document.createElement('img');
        image.classList.add('image');
        image.src =
            'https://i0.wp.com/www.10wallpaper.com/wallpaper/1680x1050/1912/007_No_Time_to_Die_2020_Daniel_Craig_Films_Poster_1680x1050.jpg';
        image.alt = article.title + ' image';

        const textContainer = document.createElement('div');
        textContainer.classList.add('index__article__text__container');

        const title = document.createElement('h2');
        title.classList.add('index__article__title');
        title.innerText = article.title;

        const body = document.createElement('div');
        body.classList.add('index__article__body');
        body.innerText = article.body.replace(/\n/g, '').slice(0, 1000);

        const bottomContainer = document.createElement('div');
        bottomContainer.classList.add('index__article__bottom__container');

        const category = document.createElement('div');
        category.innerText = article.category;

        const date = document.createElement('div');
        date.innerText = formatDateFromSQL(article.created_at);

        bottomContainer.appendChild(category);
        bottomContainer.appendChild(date);

        textContainer.appendChild(title);
        textContainer.appendChild(body);
        textContainer.appendChild(bottomContainer);

        infoContainer.appendChild(image);
        infoContainer.appendChild(textContainer);

        const line = document.createElement('div');
        line.classList.add('index__article__line');

        articleElement.appendChild(infoContainer);
        articleElement.appendChild(line);

        container.appendChild(articleElement);
    });

    const paginationContainer = createPagination(articlesCount);

    backgroundContainer.appendChild(container);
    backgroundContainer.appendChild(paginationContainer);

    return backgroundContainer;
};

/**
 * Create articles elements styled for mobiles
 *
 * @param {Array} articles An array of articles
 * @param {number} articlesCount The total number of articles
 * @returns {HTMLDivElement} A div element containing the articles
 */
const createMobileArticles = (articles, articlesCount) => {
    if (articles.length === 0) return;

    const divContainer = document.createElement('div');
    divContainer.classList.add(
        'index__article__container',
        'index__article__mobile'
    );

    articles.forEach((article) => {
        const articleElement = document.createElement('article');
        articleElement.onclick = () =>
            (window.location.href = `./articles?id=${article.id}`);

        // TODO: image from db
        const image = document.createElement('img');
        image.classList.add('image');
        image.src =
            'https://i0.wp.com/www.10wallpaper.com/wallpaper/1680x1050/1912/007_No_Time_to_Die_2020_Daniel_Craig_Films_Poster_1680x1050.jpg';
        image.alt = article.title + ' image';

        const title = document.createElement('h2');
        title.classList.add('index__article__title');
        title.innerText = article.title;

        const category = document.createElement('div');
        category.innerText = article.category;

        const bottomContainer = document.createElement('div');
        bottomContainer.classList.add('index__article__bottom__container');

        const date = document.createElement('div');
        date.innerText = formatDateFromSQL(article.created_at);

        const line = document.createElement('div');
        line.classList.add('index__article__line');

        bottomContainer.appendChild(category);
        bottomContainer.appendChild(date);

        articleElement.appendChild(title);
        articleElement.appendChild(image);
        articleElement.appendChild(bottomContainer);
        articleElement.appendChild(line);

        divContainer.appendChild(articleElement);
    });

    const paginationContainer = createPagination(articlesCount);
    divContainer.appendChild(paginationContainer);

    return divContainer;
};

/**
 * Create no article element
 *
 * @param {string} message The message to be displayed
 * @returns {HTMLDivElement} A div element containing the no article message
 */
const createNoArticle = (message) => {
    const noArticleDiv = document.createElement('div');
    noArticleDiv.classList.add('index__no_article');
    noArticleDiv.innerText = message;
    return noArticleDiv;
};

fetch(`../src/pagination.php?nbArticle=${articlesPerPage}&page=${pageNumber}`)
    .then(checkFetchError)
    .then((response) => {
        const contentContainer = document.querySelector('.index__content');

        if (response.articlesCount === 0) {
            const noArticleElement = createNoArticle('Aucune critique :(');
            contentContainer.appendChild(noArticleElement);
            return;
        }

        const articlesDesktopContainer = createDesktopArticles(
            response.articles,
            response.articles_count
        );
        const articlesMobileContainer = createMobileArticles(
            response.articles,
            response.articles_count
        );

        contentContainer.appendChild(articlesDesktopContainer);
        contentContainer.appendChild(articlesMobileContainer);
    })
    .catch((error) => {
        const noArticleElement = createNoArticle(
            error.message + ' :(\n\nPlease retry later'
        );
        const contentContainer = document.querySelector('.index__content');
        contentContainer.appendChild(noArticleElement);
    });
