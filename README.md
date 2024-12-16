## О проекте

Laravel 10, PHP8.3, MySql, Docker
<br>
<br>Идея проекта заключается в создании биржи по покупке/продаже пилотов формулы №1

## Возможности

Регистрация пользователя, вход через Google.
Реализованы роли 'user' и 'admin'. 
<br>(вход за админа почта: admin@mail.com пароль: admin)

Загрузка аватара пользователем.
Указание дааты рождения.

Создание кошельков с различными валютами. 
<br>Возможность пополнять и покупать гонщиков на бирже с сохранением истории транзакций.
<br>Возможность выставить гонщика на биржу за полную стоимость или продать сразу за определенный процент от его стоимости.

## Перед запуском

<br>docker-compose build
<br>docker-compose up -d
<br>docker exec -it project_app bash
<br>composer install

<br>php artisan migrate
<br>php artisan db:seed PermissionsSeeder
<br>php artisan db:seed RacerSeeder
