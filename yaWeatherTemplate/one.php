<div class="VSVWether">
    <div class="VSVHead">Погода на <?php echo $date; ?></div>

    <?php
    foreach ($weather as $weatherData) {
        ?>
        <div class="VSVTimeText"><?php echo $weatherData['name'] ?></div>
        <div class="VSVPrecipitation">
            <img 
                title="<?php echo $weatherData['wetherTxt'] ?>" 
                src="/i/precipitation/<?php echo $weatherData['imgV3']; ?>.svg"
                width="16"
                height="16">
        </div>
        <div class="VSVTemperature"><?php echo $weatherData['temparature'] ?> <sup>o</sup>C</div>
        <div class="VSVData1Day">
            <div class="VSVPressureText"><?php echo $weatherData['pressure'] ?> мм рт.ст.</div>
            <div class="VSVWindImg">
                <img 
                    title="Ветер: <?php echo $weatherData['windDescription'] ?> <?php echo $weatherData['windSpeed'] ?> м/с" 
                    src="/i/wind/s.svg" style="transform: rotate(<?php echo $weatherData['windRotate']; ?>deg);"
                    width="16"
                    height="16">
            </div>
            <div class="VSVWindText"> <?php echo $weatherData['windSpeed'] ?> м/с</div>
            <div style="clear: left;"></div>  
        </div>
        <div class="delitel"> </div>  
        <?php
    }
    ?>
    <div class="reclam"><a href="/pogoda.3.php" title="Прогноз погоды в Бердске">Прогноз погоды</a></div>
</div>
<div class="VSVAstro">  
    <div class="VSVHead">Астрономические данные</div>  
    <div class="VSVSun">  
        <div class="VSVAstros">Солнце:</div>  
        <div class="VSVSun VSVSunImg"><img src="/i/sun/skc_d.svg"></div>
        <div class="VSVSun VSVSunData">  
            <div class="VSVSunData">Восход: <?php echo $sunrise ?></div>  
            <div class="VSVSunData">Закат: <?php echo $sunset ?></div>  
        </div>
    </div>
    <div class="VSVMoon">  
        <div class="VSVAstros">Луна:</div>  
        <div class="VSVMoon VSVMoonData"><?php echo $moonDescription; ?></div>  
        <div class="VSVMoon VSVMoonImg"><img width="26" height="26" src="/i/moon/<?php echo $moonType; ?>.svg"></div>
    </div>
    <div style="clear: left;"> </div>  
    <div class="VSVMagnit">Магнитное поле: <?php echo $bioemtria; ?></div>  
</div>