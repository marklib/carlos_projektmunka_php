<div id="forgottenPasswordPanel" class="centerPanel">
    <form method="post" action="<?php echo UrlUtil::MAIN_URL; ?>">
        <h2 class="mainTitle text">Elfelejtett jelszó</h2>

        <label for="emailInput" class="text">Email cím</label>
        <input required id="emailInput" name="email" class="inputField" type="text"/><br/>

        <input type="hidden" name="operation" value="<?php echo UrlUtil::OPERATION_FORGOTTEN_PASSWORD; ?>"/>

        <button id="sendButton" class="primaryButton text" type="submit">Elküld</button>
    </form>
    <a href="./login.html">
        <button id="loginButton" class="normalButton text" type="submit">Bejelentkezés</button>
    </a>
</div>
