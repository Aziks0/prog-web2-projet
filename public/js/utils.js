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
