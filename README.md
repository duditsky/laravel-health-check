# Laravel API Health Check Service

Тестове завдання на позицію PHP розробника. Проєкт реалізує API-ендпоїнт для моніторингу стану бази даних та кешу.

## Технологічний стек
- **Framework:** Laravel 11
- **PHP:** 8.3-FPM
- **Infrastrucutre:** Nginx, MySQL 8.0, Redis
- **Containerization:** Docker Compose

## Вимоги та особливості
- **Middleware:** Перевіряє заголовок `X-Owner` (UUID) та автоматично логує кожен запит у таблицю `api_logs`.
- **Rate Limiting:** Обмежено до 60 запитів на хвилину.
- **Health Status:** Повертає статус 200, якщо база та кеш доступні, або 500, якщо виникла помилка.

## Як запустити проєкт (Quick Start)

1.  **Підготуйте середовище:**
    ```bash
    cp .env.example .env
    ```

2.  **Запустіть контейнери:**
    ```bash
    docker compose up -d --build
    ```

3.  **Встановіть залежності та запустіть міграції:**
    ```bash
    docker compose exec app composer install
    docker compose exec app php artisan migrate
    ```

## Як протестувати API

Виконайте команду в терміналі для перевірки ендпоїнта (порт **8876**):

```bash
curl -i -H "X-Owner: 550e8400-e29b-41d4-a716-446655440000" \
     http://localhost:8876/api/v1/health-check
```