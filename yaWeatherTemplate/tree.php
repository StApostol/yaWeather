<div class="radius main_pole">
    <p class="td"> Прогноз погоды на 3 дня</p>

    <div class="menu_pole">
        <div class="menuk">¤ <a href="/pogoda.3.php" title="Прогноз погоды на 3 дня">Прогноз погоды на 3 дня</a></div>
        <div class="menuk">¤ <a href="/pogoda.10.php" title="Прогноз погоды на 10 дня">Прогноз погоды на 10 дней</a>
        </div>
    </div>

    <p class="td1">Прогноз погоды на 3 дня</p>
    <?php

    foreach ($days as $weatherData) {
        ?>
        <div class="VAVWether">
            <div class="VAVHead">
                <div class="VAVDate"><?php echo $weatherData['date'] ?></div>
                <div class="VAVDateNedelya"><?php
                    echo $weatherData['weeklyDayName'];
                    ?>
                </div>
            </div>
            <div class="VAVHead">
                <div class="VAVSun">Восход: <?php echo $weatherData['sunrise']; ?>
                    Закат: <?php echo $weatherData['sunset']; ?></div>
                <div class="VAVMoonImg">
                    <img width="26" height="26" src="/i/moon/<?php echo $weatherData['moonType']; ?>.svg">
                </div>
                <div class="VAVMoonText"><?php echo $weatherData['moonDescription']; ?></div>
                <div style="clear: right"></div>
                <div class="VAVMagnit">Магнитное поле: <?php echo $weatherData['bioemtria']; ?></div>
            </div>
            <div style="clear: left; height: 12px;"></div>
            <div class="VAVWeatherBlok VAVWeatherTx">
                <div class="VAVPrecipitationTx">Погода:</div>
                <div class="VAVTemperatureTx">Температура:</div>
                <div class="VAVPressureText">Давление:</div>
                <div class="VAVHumidityText">Влажность:</div>
                <div class="VAVWindTx">Ветер:</div>
            </div>

            <?php
            foreach ($weatherData['weather'] as $weather) {
                ?>
                <div class="VAVWeatherBlok">
                    <div class="VAVTimeText"><?php echo $weather['name'] ?></div>
                    <div class="VAVPrecipitation">
                        <img
                            title="<?php echo $weather['wetherTxt'] ?>"
                            src="/i/precipitation/<?php echo $weather['imgV3']; ?>.svg"
                            width="16"
                            height="16">
                    </div>
                    <div class="VAVTemperature"><?php echo $weather['temparature'] ?> <sup>o</sup>C</div>
                    <div class="VAVPressureText"><?php echo $weather['pressure'] ?> мм рт.ст.</div>
                    <div class="VAVHumidityText"><?php echo $weather['humidity'] ?>%</div>
                    <div class="VAVWindImg">
                        <img
                            title="Ветер: <?php echo $weather['windDescription'] ?> <?php echo $weather['windSpeed'] ?> м/с"
                            src="/i/wind/s.svg" style="transform: rotate(<?php echo $weather['windRotate']; ?>deg);"
                            width="16"
                            height="16">
                    </div>
                    <div class="VAVWindText"> <?php echo $weather['windSpeed'] ?> м/с</div>
                    <div style="clear: left;"></div>
                </div>
                <?php
            }
            ?>
            <div style="clear: left; height: 12px; border-top:#339900 1px dotted;"></div>
        </div>

    <?php } ?>

</div>  