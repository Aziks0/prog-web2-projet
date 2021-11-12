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

// TODO: show the articles on the page
// TODO: show the error on the page
fetch(`../src/pagination.php?nbArticle=${articlesPerPage}&page=${pageNumber}`)
    .then(checkFetchError)
    .then((response) => {
        console.log(response);

        if (response.articlesCount === 0) return;

        const paginationContainer = createPagination(response.articles_count);

        const contentContainer = document.querySelector('.content');
        contentContainer.appendChild(paginationContainer);
    })
    .catch((error) => console.log(error));
