## О проекте

Laravel 10, PHP8.3, MySql.
Идея проекта в создании биржи для покупки/продажи гонщиков формулы №1.

## Возможности
Регистрация пользователя, вход через Google.
Реализованы роли 'user' и 'admin'. 
(вход за админа почта: admin@mail.com пароль: admin)

Загрузка аватара пользователем.
Указание дааты рождения.

Создание кошельков с различными валютами. Возможность пополнять и покупать гонщиков на бирже с сохранением истории транзакций.
Возможность выставить гонщика на биржу за полную стоимость или продать сразу за определенный процент от его стоимости.

## Перед запуском
php artisan db:seed PermissionsSeeder
php artisan db:seed RacerSeeder

