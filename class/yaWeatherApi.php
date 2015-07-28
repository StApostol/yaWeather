<?php

/**
 * Class yaWeatherApi
 */
class yaWeatherApi
{

    public $idCity;
    public $weeklyDayNames
        = array(
            'Monday'    => 'Понедельник',
            'Tuesday'   => 'Вторник',
            'Wednesday' => 'Среда',
            'Thursday'  => 'Четверг',
            'Friday'    => 'Пятница',
            'Saturday'  => 'Суббота',
            'Sunday'    => 'Воскресенье',
        );
    public $timeTxt
        = array(
            'morning' => 'Утро',
            'day'     => 'День',
            'evening' => 'Вечер',
            'night'   => 'Ночь'
        );
    public $windTxt
        = array(
            'n'  => 'северный',
            'nw' => 'северо-западный',
            'w'  => 'западный',
            'sw' => 'юго-западный',
            's'  => 'южный',
            'se' => 'юго-восточный',
            'e'  => 'восточный',
            'ne' => 'северо-восточный',
        );
    public $windRotate
        = array(
            'n'  => 180,
            'nw' => 135,
            'w'  => 90,
            'sw' => 45,
            's'  => 0,
            'se' => -45,
            'e'  => -90,
            'ne' => -135,
        );
    public $moonDescription
        = array(
            0  => 'Полнолуние',
            1  => 'Убывающая луна',
            2  => 'Убывающая луна',
            3  => 'Убывающая луна',
            4  => 'Последняя четверть',
            5  => '',
            6  => '',
            7  => '',
            8  => 'Новолуние',
            9  => '',
            10 => '',
            11 => '',
            12 => '',
            13 => 'Растущая луна',
            14 => 'Растущая луна',
            15 => 'Растущая луна',
            16 => 'Полнолуние',
        );
    private $_data;
    private $_xml;
    private $fileNameForSave10Day = 'pogoda.10.php';
    private $fileNameForSave1Day = 'pogoda.1.php';
    private $fileNameForSave3Day = 'pogoda.3.php';
    private $fileNameTemplate10Day = '../yaWeatherTemplate/many.php';
    private $fileNameTemplate1Day = '../yaWeatherTemplate/one.php';
    private $fileNameTemplate3Day = '../yaWeatherTemplate/tree.php';
    private $folderDirectoryImage = '../i/';
    private $mail = "you@email.com";
    private $mailFrom = "no-reaply@yaWeather.ru";
    private $url = 'http://export.yandex.ru/weather-ng/forecasts/';

    public function __construct($idCity = 27612, $params = array())
    {
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                if (!property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }
        $this->idCity = $idCity;
        if (empty($this->idCity)) {
            return $this->writeLog("Номер города не определен");
        }

        $this->_xml = simplexml_load_file($this->url . $this->idCity . '.xml');
        if (empty($this->_xml)) {
            return $this->writeLog("Яндекс не отдал данные");
        }

        $this->_parseData();
    }

    /**
     * Функция записи в лог
     *
     * @param type $str
     */
    public function writeLog($str)
    {
        $prefiks = date("d-m-Y");
        $fp = fopen("log/log-$prefiks.txt", "a");
        fwrite($fp, date("d-m-Y H:i:s") . " - " . $str . "\r\n");
        fclose($fp);
        $this->sendMail($str);
    }

    private function _parseData()
    {
        foreach ($this->_xml->day as $day) {
            $this->_parseDataToArray($day);
            if (count($this->_data) == 1) {
                $this->_saveDayWeather($this->fileNameTemplate1Day, $this->fileNameForSave1Day);
            }
            if (count($this->_data) == 3) {
                $this->_saveDayWeather($this->fileNameTemplate3Day, $this->fileNameForSave3Day);
            }
            if (count($this->_data) == 10) {
                $this->_saveDayWeather($this->fileNameTemplate10Day, $this->fileNameForSave10Day);
                break;
            }
        }
    }

    /**
     * Функция оповещения на почту о проблемах с системой распарсивания
     *
     * @param type $message = "Проверьте работу скрипта на сайте, скрипт почему-то не смог распарсить данные"
     * @param type $subject = "Проблемы с погодой на сайте"
     */
    public function sendMail($message = "Проверьте работу скрипта на сайте, скрипт почему-то не смог распарсить данные",
        $subject = "Проблемы с погодой на сайте"
    )
    {
        if (!$this->sendEmail || empty($this->mail)) {
            return;
        }
        $headers = 'From: ' . $this->mailFrom . "\r\n" .
            'Content-type: text/html; charset=UTF-8' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($this->mail, $subject, $message, $headers);
    }

    private function _parseDataToArray($day)
    {
        $weather = array();
        /** @var $dayPart SimpleXMLElement */
        foreach ($day->day_part as $dayPart) {

            $listAttribute = $dayPart->attributes();
            $txt = (string)$listAttribute[1];

            if (!isset($this->timeTxt[$txt])) {
                continue;
            }

            $this->saveImg((string)$dayPart->{'image-v3'}[0], 'precipitation/');

            $imageAttr = $dayPart->{'image-v3'}->attributes();
            $wetherAttr = $dayPart->weather_condition->attributes();
            $temperatureAttr = $dayPart->{'temperature-data'}->attributes();

            $data = array(
                'name'             => (string)$this->timeTxt[$txt],
                'img'              => (string)$dayPart->{'image'},
                'imgV3'            => (string)$dayPart->{'image-v3'}[0],
                'imgColor'         => (string)$imageAttr['color'],
                'wetherTxt'        => (string)$dayPart->weather_type,
                'wetherCode'       => (string)$wetherAttr['code'],
                'temparature'      => (string)$dayPart->{'temperature-data'}->avg,
                'temparatureColor' => (string)$temperatureAttr['bgcolor'],
                'windDirection'    => (string)$dayPart->wind_direction,
                'windSpeed'        => (string)$dayPart->wind_speed,
                'windDescription'  => (string)$this->windTxt[(string)$dayPart->wind_direction],
                'windRotate'       => $this->windRotate[(string)$dayPart->wind_direction],
                'humidity'         => (string)$dayPart->humidity, //влажность
                'pressure'         => (string)$dayPart->pressure, //давление
                'mslpPressure'     => (string)$dayPart->mslp_pressure, //атмосферное давление
            );

            $bioemtria = false;
            if (isset($day->biomet)) {
                $biometAttr = (string)$day->biomet->attributes();
                if (isset($biometAttr['geomag']) && !empty($biometAttr['geomag'])) {
                    $bioemtria = true;
                }
            }
            $weather[] = $data;
        }
        $listAttributes = $day->attributes();
        $keyDay = date('l', strtotime((string)$listAttributes[0]));
        $data = array(
            'weeklyDayName'   => $this->weeklyDayNames[$keyDay], //атмосферное давление
            'moonType'        => (string)$day->moon_phase, //атмосферное давление
            'moonDescription' => $this->moonDescription[(string)$day->moon_phase], //атмосферное давление
            'date'            => (string)$listAttributes[0],
            'sunrise'         => (string)$day->sunrise,
            'sunset'          => (string)$day->sunset,
            'weather'         => $weather,
            'bioemtria'       => $bioemtria ? 'неустойчивое' : 'устойчивое'
        );
        $this->_data[] = $data;
    }

    private function _saveDayWeather($fileNameTemplate, $fileNameSave)
    {
        if (count($this->_data) == 1) {
            $params = current($this->_data);
        } else {
            $params['days'] = $this->_data;
        }

        $content = $this->_render($fileNameTemplate, $params);

        file_put_contents($fileNameSave, $content);
    }

    /**
     * Функция сохранения изображения
     *
     * @param $fileName
     * @param $folder
     *
     * @return string
     */
    public function saveImg($fileName, $folder = '')
    {

        $url = "http://yastatic.net/weather/i/icons/svg/" . $fileName . ".svg";
        $absolutePath = __DIR__ . DIRECTORY_SEPARATOR . $this->folderDirectoryImage . $folder;
        if (!file_exists($absolutePath) && !is_dir($absolutePath)) {
            mkdir($absolutePath);
        }
        $filename = $absolutePath . $fileName . ".svg";

        if (!file_exists($filename)) {
            $file = file_get_contents($url);
            $openedfile = fopen($filename, "w");
            fwrite($openedfile, $file);
            fclose($openedfile);
        }
        return $filename;
    }

    private function _render($fileName, $params = array())
    {
        $absolutePath = __DIR__ . DIRECTORY_SEPARATOR . $fileName;
        extract($params);

        ob_start();
        ob_implicit_flush(false);
        require_once($absolutePath);
        $content = ob_get_clean();
        return $content;
    }

}