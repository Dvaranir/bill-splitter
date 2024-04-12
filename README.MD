# Bill Splitter App

# ENGLISH START

## Did not add external libraries, did everything using built-in language mechanisms.

## API requests are formed according to the following principles:

1. The request specifies the input file /api/index.php
2. In the query parameters, you need to specify the controller's name without .controller.php and the method suffix without the first verb (without get, post, delete, put)
3. The request method corresponds to the verb

Note:

```
/api/index.php?controller=Users&suffix=BillUsers
```

It works like this: the input file checks for the presence of the controller file, and if it exists, it passes the request for processing to that controller. If not, it returns a 404 error. The controller itself checks for the presence of the requested method.

## To migrate data into the database:
1. Fill in the .env file following the example in .env.example
2. Execute:
```
php migrate.php
```

## Additionally, you can rollback migrations using:
```
php migrate.php rollback
```

# ENGLISH END

# RUSSIAN START

## Не стал добавлять сторонние библиотеки, сделал все на встроенных в языки машинериях.

## Запросы в апи формируются по следующим принципам:
1. В запросе указывается входной файл /api/index.php
2. В query параметрах необходимо указать имя контроллера без .controller.php и суффикс метода без первого глагола (без get, post, delete, put)
3. За глагол отвечает метод запроса

Прим.:
```
/api/index.php?controller=Users&suffix=BillUsers
```

Работает так, входной файл проверяет наличие файла контроллера и если он есть, передает запрос дальше на обработку этим самым контроллером, если нет - 404. Сам контроллер проверяет у себя наличие запрашиваемого метода

## Чтобы мигрировать данные в базу: 
1. Необходимо заполнить .env по примеру из .env.example 
2. Выполнить
```
php migrate.php
```

## Так же можно миграции откатывать через:
```
php migrate.php rollback
```

# RUSSIAN END