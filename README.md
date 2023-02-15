INSTALLATION
------------

1. Создать базу данных "buy-sell"

2. Выполнить миграции
~~~
php yii migrate

php yii migrate --migrationPath=@yii/rbac/migrations/
~~~

3. Выполнить команду "rbac" для установки ролей и доступов
~~~
php yii rbac/init
~~~

4. Настроить transpotr для mailer'a в config/web.php

5. Готово


ДАННЫЕ АДМИНА
------------
~~~
LOGIN      admin@buysell.ru
PASSWORD   123456
~~~
