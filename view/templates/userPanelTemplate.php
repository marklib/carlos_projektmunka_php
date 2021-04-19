<div id="registrationPanel" class="centerPanel">
    <form method="post" action="<?php echo UrlUtil::MAIN_URL; ?>">
        <?php if ($type == 'registration') {
            echo '<h2 class="mainTitle text">Regisztráció</h2>
                <input type="hidden" name="operation" value="' . UrlUtil::OPERATION_REGISTER . '"/>';
        } else {
            echo '<h2 class="mainTitle text">Felhasználói beállítások</h2>
                <input type="hidden" name="operation" value="' . UrlUtil::OPERATION_USER_SETTINGS_SAVE . '"/>';
        }?>
        <h3 class="mainTitle text">Bejelentkezési adatok</h3>


        <label for="emailInput" class="text">Email cím</label>
        <input required placeholder="pelda@email.hu" id="emailInput" value="<?php echo $this->user->getEmail();?>" name="email" class="inputField" type="text"/><br/>

        <label for="passwordInput" class="text">Jelszó</label>
        <input <?php if($type == 'registration') { echo 'required';} ?> id="passwordInput" class="inputField" name="password" type="password"/><br/>

        <label for="passwordAgainInput" class="text">Jelszó mégegyszer</label>
        <input <?php if($type == 'registration') { echo 'required';} ?> id="passwordAgainInput" name="passwordAgain" class="inputField" type="password"/><br/>

        <h3 class="mainTitle text">Saját adatok</h3>

        <label for="fullNameInput" class="text">Teljes név</label>
        <input required placeholder="Példa János" id="fullNameInput" value="<?php echo $this->user->getFullName();?>" name="fullName" class="inputField" type="text"/><br/>

        <label for="phoneNumberInput" class="text">Telefonszám</label>
        <input required placeholder="+36-70-123-4567" id="phoneNumberInput" value="<?php echo $this->user->getPhoneNumber();?>" name="phoneNumber" class="inputField" type="text"/><br/>
        <br/>

        <?php if ($type == 'registration') {
            echo '<input required id="userAgreementCheckbox" type="checkbox"/>
                <label for="userAgreementCheckbox" class="text">Elfogadom a <a href="assets/upload/userAgreement.pdf" target="_blank"><cite>felhasználási feltételeket</cite></a></label>
        
                <button id="registrationButton" class="primaryButton text" type="submit">Regisztráció</button>';
        } else {
            echo '<button id="registrationButton" class="primaryButton text" type="submit">Mentés</button>';
        }?>
    </form>
    <?php if ($type == 'registration') {
        echo '<a href="' . UrlUtil::getRoutedUrl(UrlUtil::NAV_REGISTRATION) . '">
                <button id="loginButton" class="normalButton text" type="submit">Bejelentkezés</button>
            </a>';
    } else {
        echo '<a href="' . UrlUtil::MAIN_URL . '">
                <button id="loginButton" class="normalButton text" type="submit">Mégse</button>
            </a>';
    }?>
</div>