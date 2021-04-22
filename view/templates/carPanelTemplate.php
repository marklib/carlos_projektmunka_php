<div id="newCarPanel" class="centerPanel">
    <form method="post" action="<?php echo UrlUtil::MAIN_URL; ?>">
        <?php if ($type == UrlUtil::OPERATION_NEW_CAR) {
            echo '<h2 class="mainTitle text">Új autó</h2>
                <input type="hidden" name="operation" value="' . UrlUtil::OPERATION_NEW_CAR . '"/>';
        } else {
            echo '<h2 class="mainTitle text">Autó módosítása</h2>
                <input type="hidden" name="operation" value="' . UrlUtil::OPERATION_CAR_MODIFY . '"/>';
        }?>
        <h3 class="mainTitle text">Autó adatok</h3>

        <label for="nameInput" class="text">Autó megnevezése</label>
        <input required id="nameInput" name="name" class="inputField" type="text"/>
        </br></br>
        <label for="brandInput" class="text">Márka</label>
        <input required id="brandInput" name="brand" class="inputField" type="text"/>
        </br></br>
        <label for="fuelTypeSelect" class="text">Üzemanyag</label>
        <select id="fuelTypeSelect" class="inputField" name="fuelType">
            <option value="petrol">Benzin</option>
            <option value="diesel">Dízel</option>
            <option value="electric">Elektromos</option>
            <option value="other">Egyéb</option>
        </select>
        </br></br>
        <label class="text">Állapot</label></br>
        <input required type="radio" id="perfectConditionCheckbox" name="condition" class="" value="perfect">
        <label for="perfectConditionCheckbox">Tökéletes</label></br>
        <input required type="radio" id="normalConditionCheckbox" name="condition" value="normal">
        <label for="normalConditionCheckbox">Normál</label><br>
        <input required type="radio" id="badConditionCheckbox" name="condition" value="bad">
        <label for="badConditionCheckbox">Rossz</label><br>

        <h3 class="mainTitle text">Bérlési adatok</h3>

        <label for="rentFrom" class="text">Mikortól bérelhető?</label>
        <input required type="date" id="rentFrom" name="rentFrom" class="inputField" min="2021-03-08">

        <!--<h3 class="mainTitle text">Képek</h3>
        <input type="file" id="carPicture" name="carPicture" accept="image/png, image/jpeg">

        <input type="hidden" name="sessionId" value="4815162342"/>-->

        <button id="saveButton" class="primaryButton text" type="submit">Mentés</button>
    </form>
    <a href="<?php echo UrlUtil::MAIN_URL ?>">
        <button id="cancelButton" class="normalButton text" type="reset">Mégse</button>
    </a>
</div>