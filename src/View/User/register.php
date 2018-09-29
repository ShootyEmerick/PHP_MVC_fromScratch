<h1>Arrived in View/User/register/</h1>
<a href="<?php
echo BASE_URI . "/user/login/";
?>"><button>Connexion</button></a>
<form method="post" action="/PiePHP/user/register">
    <div class="col-lg-4 col-md-12">
        <label for="email" class="labels-login">Login / Email *</label>
        <input type="email" id="email" name="email"
               class="form-control" placeholder="Votre email">
        <p class="comments"></p>
    </div>
    <div class="col-lg-4 col-md-12">
        <label for="password" class="labels-login">Password *</label>
        <input type="password" id="password" name="password"
               class="form-control" placeholder="Votre email">
        <p class="comments"></p>
    </div>
    <div class="col-lg-4 col-md-12">
        <label for="password_check" class="labels-login">Confirmation password *</label>
        <input type="password" id="password_check" name="password_check"
               class="form-control" placeholder="Votre email">
        <p class="comments"></p>
    </div>
    <input type="submit" class="btn btn-warning" id="btn_form" value="Inscription">
</form>
