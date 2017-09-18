# OpenCity
[Google Play](https://play.google.com/store/apps/details?id=me.kowo.opencity) | [Веб версия](http://opencity.shpp.me/)

## Помоги проекту
Мы хотим сделать наш проект лучше. У нас три основных направления: фронтенд, бекенд и андроид приложение.
Все активные таски мы пишем на публичной [доске](https://trello.com/b/ZfK6Z8a3/-). Смело выбирайте то что вам по силам и предлагайте свою помощь.
Мы открыты к любым предложениям :)

***
### Установка:

#### Необходимые компоненты:
* Веб сервер, настроенный таким образом, чтоб стартовая страница открывалась из папки `public` проекта;
* PHP версии не ниже 5.6. Также необходимо прописать путь к `php.exe` в пременную окружения `PATH`;
* Должна быть установлена СУБД MySQL ([Ubuntu 16.04 hint](https://www.digitalocean.com/community/tutorials/how-to-install-mysql-on-ubuntu-16-04));
* Нужен установленный [Composer](https://getcomposer.org/download/);

#### Социальные ключи для авторизации
*  [Twitter](https://apps.twitter.com/app/new)
*  [Facebook](https://developers.facebook.com/apps/)

#### Для настройки проекта выполнить:
* В консоли перейти в папку с проектом;
* Выполнить `composer install`;
* Создать новую базу данных или использовать существующую;
* Скопировать файл `.env.example` в `.env` и прописать в нем настройки подключения к БД;
* Через `PhpMyadmin` импортировать в базу данные из файла `database/data/cityguide.sql`;
* Выполнить `php artisan key:generate`;

##### Все. Проект готов к работе.  

##### Для входа в админку необходимо ввести:
* Email: admin@admin.com
* Passsword: qweasd
