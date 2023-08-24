# REST API по тестовой задаче
Это решение тестовой задачи, по созданию рест апи с авторизацией и одним крудом новостей

## Для запуска проекта необходимо: 
1. Запустить установку пакетов через composer
```shell
composer i
```
2. Настроить окружение
```dotenv
DB_DATABASE="tt_qtim"
DB_USERNAME=root
DB_PASSWORD=
```
2. Выполнить миграции <i>(с <code> --seed</code> если необходимо сразу заполнить посты)</i>
```shell
php artisan migrate 
```
3. Запустить приложение
```shell
php artisan serve 
```

## Использованные сторонние библиотеки:
> <b>[wendelladriel/laravel-validated-dto](https://github.com/WendellAdriel/laravel-validated-dto)</b> - Использован для типизирования входящих и выходящих данных
> 
> <b>[phpstan/phpstan](https://github.com/phpstan/phpstan)</b> - Статанализатор

Все остальное - Laravel

## Остальное:
 Postman коллекция лежит в корне с названием:
> <b>[TT-Qtim.postman_collection.json](TT-Qtim.postman_collection.json) </b>
