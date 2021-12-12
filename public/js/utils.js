/**
 *  Format SQL date to **DD/MM/YY**
 *
 * @param {string} date
 *
 * @returns {string} Formated date
 */
export const formatDateFromSQL = (date) => {
    const dateSplited = date.replace(' ', '-').split('-');
    const yearTwoDigits = dateSplited[0].slice(1, 3);
    const formatedDate =
        dateSplited[2] + '/' + dateSplited[1] + '/' + yearTwoDigits;

    return formatedDate;
};

/**
 * Return the body text of a fetch response if its status is OK, otherwise it
 * throws an error containing its status text
 *
 * @param {Response} res A fetch response
 * @returns {Promise<JSON>} The body text of the response parsed as JSON
 *
 * @throws Error containing the status text of the response
 */
export const checkFetchError = (res) => {
    if (res.ok) return res.json();
    throw Error(res.statusText);
};

export const getTranslation = async () => {
    const language = document.documentElement.lang;
    return fetch('./locales/' + language + '.json').then((response) =>
        response.json()
    );
};
