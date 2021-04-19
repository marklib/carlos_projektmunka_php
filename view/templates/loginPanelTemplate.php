<div id="loginPanel" class="centerPanel">
    <form method="post" action="<?php echo UrlUtil::MAIN_URL;?>">
        <h2 class="mainTitle text">Bejelentkezés</h2>

        <label for="emailInput" class="text">Email cím</label>
        <input required id="emailInput" name="email" class="inputField" type="text"/><br/>

        <label for="passwordInput" class="text">Jelszó</label>
        <input required id="passwordInput" name="password" class="inputField" type="password"/><br/>

        <input type="hidden" name="operation" value="<?php echo UrlUtil::OPERATION_LOGIN; ?>"/>

        <button id="loginButton" class="primaryButton text" type="submit">Bejelentkezés</button>
    </form>
    <a href="<?php echo UrlUtil::getRoutedUrl(UrlUtil::NAV_REGISTRATION);?>">
        <button id="registrationButton" class="normalButton text" type="submit">Regisztráció</button>
    </a>
    </br>
    </br>
    <center>
        <a href="<?php echo UrlUtil::getRoutedUrl(UrlUtil::NAV_FORGOTTEN_PASSWORD);?>" class="text">Elfelejtett jelszó</a>
    </center>
</div>