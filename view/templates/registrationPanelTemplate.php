<div id="registrationPanel" class="centerPanel">
    <form method="post" action="index.php">
        <h2 class="mainTitle text">Regisztráció</h2>

        <h3 class="mainTitle text">Bejelentkezési adatok</h3>

        <input type="hidden" name="operation" value="register"/>

        <label for="emailInput" class="text">Email cím</label>
        <input required placeholder="pelda@email.hu" id="emailInput" name="email" class="inputField" type="text"/><br/>

        <label for="passwordInput" class="text">Jelszó</label>
        <input required id="passwordInput" class="inputField" name="password" type="password"/><br/>

        <label for="passwordAgainInput" class="text">Jelszó mégegyszer</label>
        <input required id="passwordAgainInput" name="passwordAgain" class="inputField" type="password"/><br/>

        <h3 class="mainTitle text">Saját adatok</h3>

        <label for="fullNameInput" class="text">Teljes név</label>
        <input required placeholder="Példa János" id="fullNameInput" name="fullName" class="inputField" type="text"/><br/>

        <label for="phoneNumberInput" class="text">Telefonszám</label>
        <input required placeholder="+36-70-123-4567" id="phoneNumberInput" name="phoneNumber" class="inputField" type="text"/><br/>
        <br/>
        <input required id="userAgreementCheckbox" type="checkbox"/>
        <label for="userAgreementCheckbox" class="text">Elfogadom a <a href="assets/upload/userAgreement.pdf" target="_blank"><cite>felhasználási feltételeket</cite></a></label>

        <button id="registrationButton" class="primaryButton text" type="submit">Regisztráció</button>
    </form>
    <a href="./login.html">
        <button id="loginButton" class="normalButton text" type="submit">Bejelentkezés</button>
    </a>
</div>