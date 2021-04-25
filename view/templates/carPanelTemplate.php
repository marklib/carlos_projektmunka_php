<div id="newCarPanel" class="centerPanel">
    <form method="post" action="<?php echo UrlUtil::MAIN_URL; ?>" enctype="multipart/form-data">
        <?php if ($type == UrlUtil::OPERATION_NEW_CAR) {
            echo '<h2 class="mainTitle text">Új autó</h2>
                <input type="hidden" name="operation" value="' . UrlUtil::OPERATION_NEW_CAR . '"/>';
        } else {
            echo '<h2 class="mainTitle text">Autó módosítása</h2>
                <input type="hidden" name="operation" value="' . UrlUtil::OPERATION_CAR_MODIFY . '"/>
                <input type="hidden" name="carId" value="'.$_GET['carId'].'">';
                $_SESSION['carForm'] = CarService::findCarById($_GET['carId']);
        }?>
        <h3 class="mainTitle text">Autó adatok</h3>

        <label for="nameInput" class="text">Autó típusa</label>
        <input <?php if($type == UrlUtil::OPERATION_NEW_CAR) { echo 'required';} else{ echo 'value="'.$_SESSION['carForm']->getName().'"';}?> id="nameInput" name="name" class="inputField" type="text"/>
        </br></br>
        <label for="brandInput" class="text">Márka</label>
        <input <?php if($type == UrlUtil::OPERATION_NEW_CAR) { echo 'required';}  else{ echo 'value="'.$_SESSION['carForm']->getBrand().'"';}?> id="brandInput" name="brand" class="inputField" type="text"/>
        </br></br>
        <label for="fuelTypeSelect" class="text">Üzemanyag</label>
        <select id="fuelTypeSelect" class="inputField" name="fuelType">
            <option <?php if(isset($_SESSION['carForm']) && $_SESSION['carForm']->getFuelType() == 'petrol'){echo 'selected';}?> value="petrol">Benzin</option>
            <option <?php if(isset($_SESSION['carForm']) && $_SESSION['carForm']->getFuelType() == 'diesel'){echo 'selected';}?> value="diesel">Dízel</option>
            <option <?php if(isset($_SESSION['carForm']) && $_SESSION['carForm']->getFuelType() == 'electric'){echo 'selected';}?> value="electric">Elektromos</option>
            <option <?php if(isset($_SESSION['carForm']) && $_SESSION['carForm']->getFuelType() == 'other'){echo 'selected';}?> value="other">Egyéb</option>
        </select>
        </br></br>
        <label class="text">Állapot</label></br>
        <input <?php if($type == UrlUtil::OPERATION_NEW_CAR) { echo 'required';} else{if($_SESSION['carForm']->getCondition() == 'perfect'){echo 'checked';}}?> type="radio" id="perfectConditionCheckbox" name="condition" class="" value="perfect">
        <label for="perfectConditionCheckbox">Tökéletes</label></br>
        <input <?php if($type == UrlUtil::OPERATION_NEW_CAR) { echo 'required';} else{if($_SESSION['carForm']->getCondition() == 'normal'){echo 'checked';}}?> type="radio" id="normalConditionCheckbox" name="condition" value="normal">
        <label for="normalConditionCheckbox">Normál</label><br>
        <input <?php if($type == UrlUtil::OPERATION_NEW_CAR) { echo 'required';} else{if($_SESSION['carForm']->getCondition() == 'bad'){echo 'checked';}}?> type="radio" id="badConditionCheckbox" name="condition" value="bad">
        <label for="badConditionCheckbox">Rossz</label><br>

        <h3 class="mainTitle text">Bérlési adatok</h3>

        <label for="rentFrom" class="text">Mikortól bérelhető?</label>
        <input <?php if($type == UrlUtil::OPERATION_NEW_CAR) { echo 'required';} else{echo 'value="'.$_SESSION['carForm']->getRentFrom().'"';}?> type="date" id="rentFrom" name="rentFrom" class="inputField" min="2021-03-08">

        <h3 class="mainTitle text">Képek</h3>
        <input <?php if($type == UrlUtil::OPERATION_NEW_CAR) { echo 'required';}?> type="file" id="carPicture" name="carPicture" accept="image/png, image/jpeg">

        <button id="saveButton" class="primaryButton text" type="submit">Mentés</button>
    </form>
    <a href="<?php echo UrlUtil::MAIN_URL ?>">
        <button id="cancelButton" class="normalButton text" type="submit">Mégse</button>
    </a>
</div>