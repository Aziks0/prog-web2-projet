const params = new URLSearchParams(location.search);
const pageNumber = parseInt(params.get('page')) || 1; // pageNumber = 1 if no query param
const articlesPerPage = 5;

/**
 * Return the body text of a fetch response if its status is OK, otherwise it
 * throws an error containing its status text
 *
 * @param {Response} res A fetch response
 * @returns {Promise<JSON>} The body text of the response parsed as JSON
 *
 * @throws Error containing the status text of the response
 */
const checkFetchError = (res) => {
    if (res.ok) return res.json();
    throw Error(res.statusText);
};

/**
 * Create pagination elements
 *
 * @param {number} articlesCount The total number of articles
 * @returns {HTMLUListElement} A ul element containing the pagination
 */
const createPagination = (articlesCount) => {
    const totalPages = Math.ceil(articlesCount / articlesPerPage);

    const ulContainer = document.createElement('ul');
    ulContainer.classList.add('index__pagination__container');

    for (let i = 1; i < totalPages + 1; i++) {
        const list = document.createElement('li');

        if (i === pageNumber) list.classList.add('index__pagination__selected');

        const anchor = document.createElement('a');
        anchor.href = `/prog-web2-projet/public?page=${i}`;
        anchor.innerHTML = i;

        list.appendChild(anchor);
        ulContainer.appendChild(list);
    }

    return ulContainer;
};

/**
 * Create articles elements
 *
 * @param {Array} articles An array of articles
 * @returns {HTMLDivElement} A div element containing the articles
 */
const createArticles = (articles) => {
    if (articles.length === 0) return;

    const divContainer = document.createElement('div');
    divContainer.classList.add('index__article__container');

    articles.forEach((article) => {
        const articleElement = document.createElement('article');

        const title = document.createElement('h2');
        title.innerHTML = article.title;

        const body = document.createElement('p');
        body.innerHTML = article.body;

        const category = document.createElement('div');
        category.innerHTML = article.category;

        const date = document.createElement('div');
        date.innerHTML = article.created_at;

        articleElement.appendChild(title);
        articleElement.appendChild(body);
        articleElement.appendChild(category);
        articleElement.appendChild(date);
        divContainer.appendChild(articleElement);
    });

    return divContainer;
};

// TODO: show the error on the page
fetch(`../src/pagination.php?nbArticle=${articlesPerPage}&page=${pageNumber}`)
    .then(checkFetchError)
    .then((response) => {
        console.log(response);

        if (response.articlesCount === 0) return;

        const articlesContainer = createArticles(response.articles);
        const paginationContainer = createPagination(response.articles_count);

        const contentContainer = document.querySelector('.content');
        contentContainer.appendChild(articlesContainer);
        contentContainer.appendChild(paginationContainer);
    })
    .catch((error) => console.log(error));
