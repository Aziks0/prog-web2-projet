const categoryList = ['movie', 'tvshow'];

const form = document.querySelector('form');

const title = document.getElementById('title');
const titleLabel = document.getElementById('title-label');

const image = document.getElementById('image');
const imageLabel = document.getElementById('image-label');

const category = document.getElementById('category');
const categoryLabel = document.getElementById('category-label');

const body = document.getElementById('body');
const bodyLabel = document.getElementById('body-label');

let titleError = false;
let categoryError = false;
let imageError = false;
let bodyError = false;

form.addEventListener('submit', (event) => {
    event.preventDefault();

    // Title must be between 6 and 100 characters
    if (title.value.length < 6 || title.value.length > 100) {
        titleError = true;
        titleLabel.classList.add('error');
    }

    if (image.files.length === 0) {
        imageError = true;
        imageLabel.classList.add('error');
    }

    // Prevent users from using an invalid category
    if (!categoryList.includes(category.value)) {
        categoryError = true;
        categoryLabel.innerText += ' categorie invalide!';
        categoryLabel.classList.add('error');
    }

    // Body must have at least 300 characters
    if (body.value.length < 300) {
        bodyError = true;
        bodyLabel.classList.add('error');
    }

    if (titleError || imageError || categoryError || bodyError) return;

    form.submit();
});

// Remove the errors when the user is typing

title.addEventListener('input', () => {
    if (!titleError) return;

    titleError = false;
    titleLabel.classList.remove('error');
});

image.addEventListener('input', () => {
    if (!imageError) return;

    imageError = false;
    imageLabel.classList.remove('error');
});

category.addEventListener('input', () => {
    if (!categoryError) return;

    categoryError = false;
    categoryLabel.innerText = 'Categorie:';
    categoryLabel.classList.remove('error');
});

body.addEventListener('input', () => {
    if (!bodyError) return;

    bodyError = false;
    bodyLabel.classList.remove('error');
});
