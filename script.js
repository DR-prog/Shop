// Получение формы отзыва и ее элементов
var reviewForm = document.querySelector('.review-form');
var nameInput = document.querySelector('input[name="name"]');
var ratingInput = document.querySelector('input[name="rating"]');
var commentInput = document.querySelector('textarea[name="comment"]');

// Обработчик события отправки формы
reviewForm.addEventListener('submit', function (event) {
    event.preventDefault(); // Предотвращение отправки формы по умолчанию

    // Валидация формы перед отправкой
    if (validateForm()) {
        var reviewData = {
            name: nameInput.value,
            rating: ratingInput.value,
            comment: commentInput.value
        };
        sendReviewData(reviewData);
    }
});

// Функция валидации формы
function validateForm() {
    // Проверка полей формы на заполненность
    if (nameInput.value.trim() === '' || ratingInput.value.trim() === '' || commentInput.value.trim() === '') {
        alert('Пожалуйста, заполните все поля формы.');
        return false; // Возвращение false, чтобы предотвратить отправку формы
    }
    return true;
}

// Функция отправки данных отзыва на сервер
function sendReviewData(reviewData) {
    t
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'submit_review.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    xhr.onload = function () {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                nameInput.value = '';
                ratingInput.value = '';
                commentInput.value = '';

                var reviewsContainer = document.querySelector('.reviews-container');
                var reviewElement = createReviewElement(response.review);
                reviewsContainer.appendChild(reviewElement);
            } else {
                alert('Произошла ошибка при отправке отзыва.');
            }
        }
    };

    // Обработчик ошибки отправки запроса
    xhr.onerror = function () {
        alert('Произошла ошибка при отправке запроса.');
    };

    // Отправка данных отзыва на сервер
    xhr.send(JSON.stringify(reviewData));
}

function createReviewElement(review) {
    var reviewElement = document.createElement('div');
    reviewElement.classList.add('review');
    reviewElement.innerHTML = `
    <p class="author">${review.name}</p>
    <p class="date">${review.date}</p>
    <p class="rating">Рейтинг: ${review.rating}</p>
    <p>${review.comment}</p>
  `;
    return reviewElement;
}