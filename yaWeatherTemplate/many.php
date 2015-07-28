<div class="menu_pole">
    <div class="menuk">¤ <a href="/pogoda.3.php" title="Прогноз погоды на 3 дня">Прогноз погоды на 3 дня</a></div>
    <div class="menuk">¤ <a href="/pogoda.10.php" title="Прогноз погоды на 10 дня">Прогноз погоды на 10 дней</a>
    </div>
</div>

<p class="td1">Прогноз погоды на 10 дня</p>
<div class="VAV10Weather">
    <div class="VAV10Data">Дата</div>
    <div class="VAV10Moons"> &nbsp; </div>
    <div class="VAV10HeadPrecipitation">Погода</div>
    <div class="VAV10Temperature">Температура<br><sup>o</sup>C</div>
    <div class="VAV10Pressure">Давление<br>мм рт.ст.</div>
    <div class="VAV10HeadHumidity">Влажность<br>%</div>
    <div class="VAV10Wind">Ветер<br>м/с</div>
    <div class="VAV10Sun">Восход<br>Закат</div>
    <div class="VAV10Moons">Фаза<br>луны</div>
    <div class="delitel"></div>
    <?php
    foreach ($days as $weatherData) {
        ?>
        <div class="VAV10Data">
            <div class="VAVDate10"><?php echo $weatherData['date'] ?></div>
        </div>
        <div class="VAV10Moons">
            <div class="VAVUpText"><?php echo $weatherData['weather'][1]['name']; ?></div>
            <div class="VAVDownText"><?php echo $weatherData['weather'][3]['name']; ?></div>
        </div>
        <div class="VAV10Precipitation">
            <div class="VAVUpImg">
                <img
                    title="<?php echo $weatherData['weather'][1]['wetherTxt'] ?>"
                    src="/i/precipitation/<?php echo $weatherData['weather'][1]['imgV3']; ?>.svg"
                    width="16"
                    height="16">
            </div>
            <div class="VAVDownImg">
                <img
                    title="<?php echo $weatherData['weather'][3]['wetherTxt'] ?>"
                    src="/i/precipitation/<?php echo $weatherData['weather'][3]['imgV3']; ?>.svg"
                    width="16"
                    height="16">
            </div>
        </div>
        <div class="VAV10Temperature">
            <div class="VAVUpText"><?php echo $weatherData['weather'][1]['temparature'] ?></div>
            <div class="VAVDownText"><?php echo $weatherData['weather'][3]['temparature'] ?></div>
        </div>
        <div class="VAV10Pressure">
            <div class="VAVUpText"><?php echo $weatherData['weather'][1]['pressure'] ?></div>
            <div class="VAVDownText"><?php echo $weatherData['weather'][3]['pressure'] ?></div>
        </div>
        <div class="VAV10Humidity">
            <div class="VAVUpText"><?php echo $weatherData['weather'][1]['humidity'] ?>%</div>
            <div class="VAVDownText"><?php echo $weatherData['weather'][1]['humidity'] ?>%</div>
        </div>
        <div class="VAV10Wind">
            <div class="VAV10WindImg">
                <img
                    title="Ветер: <?php echo $weatherData['weather'][1]['windDescription'] ?> <?php echo $weatherData['weather'][1]['windSpeed'] ?> м/с"
                    src="/i/wind/s.svg"
                    style="transform: rotate(<?php echo $weatherData['weather'][1]['windRotate']; ?>deg);"
                    width="16"
                    height="16">
            </div>
            <div class="VAVUpText"> <?php echo $weatherData['weather'][1]['windSpeed']; ?> м/с</div>
            <div style="clear: left;"></div>
            <div class="VAV10WindImg">
                <img
                    title="Ветер: <?php echo $weatherData['weather'][3]['windDescription'] ?> <?php echo $weatherData['weather'][3]['windSpeed'] ?> м/с"
                    src="/i/wind/s.svg"
                    style="transform: rotate(<?php echo $weatherData['weather'][3]['windRotate']; ?>deg);"
                    width="16"
                    height="16">
            </div>
            <div class="VAVDownText"> <?php echo $weatherData['weather'][3]['windSpeed']; ?> м/с</div>
            <div style="clear: left;"></div>
        </div>
        <div class="VAV10Sun">
            <div class="VAVUpText"><?php echo $weatherData['sunrise']; ?></div>
            <div class="VAVDownText"><?php echo $weatherData['sunset']; ?></div>
        </div>
        <div class="VAV10MoonsImg">
            <img width="26" height="26" src="/i/moon/<?php echo $weatherData['moonType']; ?>.svg">
        </div>
        <div class="delitel"></div>

    <?php } ?>

</div>