# yaWeather
Парсер погоды с яндекса

Номер города находится по ссылке 
http://weather.yandex.ru/static/cities.xml

# Использование
```sh
require_once('vendor/autoload.php');
include_once 'class/yaWeatherApi.php';

$yaW = new yaWeatherApi();
```