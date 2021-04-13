<div id="loginPanel" class="centerPanel">
    <form method="post" action="index.php">
        <h2 class="mainTitle text">Bejelentkezés</h2>

        <label for="emailInput" class="text">Email cím</label>
        <input required id="emailInput" name="emailInput" class="inputField" type="text"/><br/>

        <label for="passwordInput" class="text">Jelszó</label>
        <input required id="passwordInput" class="inputField" type="password"/><br/>

        <input type="hidden" name="operation" value="login"/>

        <button id="loginButton" class="primaryButton text" type="submit">Bejelentkezés</button>
    </form>
    <a href="./registration.html">
        <button id="registrationButton" class="normalButton text" type="submit">Regisztráció</button>
    </a>
    </br>
    </br>
    <center>
        <a href="./forgottenPassword.html" class="text">Elfelejtett jelszó</a>
    </center>
</div>