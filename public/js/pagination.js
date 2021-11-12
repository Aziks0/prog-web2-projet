const params = new URLSearchParams(location.search);
const pageNumber = params.get('page') || 1; // pageNumber = 1 if no query param
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

// TODO: show pagination on the page
// TODO: show the articles on the page
// TODO: show the error on the page
fetch(`../src/pagination.php?nbArticle=${articlesPerPage}&page=${pageNumber}`)
    .then(checkFetchError)
    .then((response) => {
        console.log(response);
    })
    .catch((error) => console.log(error));
