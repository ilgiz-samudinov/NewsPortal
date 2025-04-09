// public/js/main.js

// Функция для подтверждения удаления новости
function confirmDelete(newsId) {
    if (confirm('Вы уверены, что хотите удалить эту новость?')) {
        fetch(`/admin/news/delete/${newsId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => {
            if (response.ok) {
                window.location.href = '/';
            } else {
                alert('Не удалось удалить новость');
            }
        })
        .catch(error => {
            console.error('Ошибка:', error);
            alert('Произошла ошибка при удалении новости');
        });
    }
}

// Добавление обработчиков событий после загрузки DOM
document.addEventListener('DOMContentLoaded', () => {
    // Пример: добавление активного класса к текущей странице в навигации
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('nav a');
    
    navLinks.forEach(link => {
        if (link.getAttribute('href') === currentPath) {
            link.classList.add('active');
        }
    });

    // Дополнительные интерактивные функции можно добавить здесь
    const deleteButtons = document.querySelectorAll('.delete-news');
    deleteButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            const newsId = button.dataset.newsId;
            confirmDelete(newsId);
        });
    });
});

// Функция для валидации формы перед отправкой
function validateNewsForm(form) {
    const title = form.querySelector('#title');
    const shortContent = form.querySelector('#short_content');
    const fullContent = form.querySelector('#full_content');

    // Проверка длины заголовка
    if (title.value.trim().length < 3) {
        alert('Заголовок должен содержать не менее 3 символов');
        title.focus();
        return false;
    }

    // Проверка длины краткого описания
    if (shortContent.value.trim().length < 10) {
        alert('Краткое описание должно содержать не менее 10 символов');
        shortContent.focus();
        return false;
    }

    // Проверка длины полного текста
    if (fullContent.value.trim().length < 20) {
        alert('Полный текст новости должен содержать не менее 20 символов');
        fullContent.focus();
        return false;
    }

    return true;
}

// Добавление валидации форм
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function(e) {
        if (!validateNewsForm(this)) {
            e.preventDefault();
        }
    });
});