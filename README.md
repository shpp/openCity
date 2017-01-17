# OpenCity
***
### Установка:  
####Необходимые компоненты:
* Веб сервер, настроенный таким образом, чтоб стартовая страница открывалась из папки `public` проекта; 
* PHP версии не ниже 5.6. Также необходимо прописать путь к `php.exe` в пременную окружения `PATH`;
* Нужен установленный `Composer`;

####Для настройки проекта выполнить:
* В консоли перейти в папку с проектом;
* Выполнить `composer install`;  
* Скопировать файл `.env.example` в `.env` и прописать в нем настройки подключения к БД;
* Выполнить `php artisan key:generate`;
* Через `PhpMyadmin` импортировать в базу данные из файла `database/data/cityguide.sql`;

#####Все. Проект готов к работе.  

#####Для входа в админку необходимо ввести:
* Email: admin@admin.com
* Passsword: qweasd
