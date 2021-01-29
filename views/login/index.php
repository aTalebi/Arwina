<div class="row">
        <div class="col-lg-12">
            <div class="pl-5 pt-3">
                <h4>Anmelden</h4>
            </div>
        </div>
</div>
<div class="row mt-5">
        <div class="col-lg-4"></div>
            <div class="col-lg-4 bg-light p-5">
                <div class="">
                    <!-- Start Form -->
                    <form method="POST" action="<?php URL ?>login/checkUser">
                        <!-- csrf -->
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="token" value="<?php echo Model::tokenSet(); ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="email">E-Mail:</label>
                            <input type="email" class="form-control" placeholder="Enter email" id="email" name="email" value="<?php 
                                                                                                                                if(isset($_COOKIE["remember_email"])){ 
                                                                                                                                    echo $_COOKIE["remember_email"];} 
                                                                                                                                ?>">
                            <span class="text-danger small"><?php
                                                                    if(isset($data['emptyEmail'])){
                                                                        echo $data['emptyEmail'];
                                                                    }
                                                                ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="pwd">Passwort:</label>
                            <input type="password" class="form-control" placeholder="Enter password" id="pswd" name="pswd" value="<?php 
                                                                                                                                    if(isset($_COOKIE["remember_password"])){
                                                                                                                                         echo $_COOKIE["remember_password"];} 
                                                                                                                                  ?>">
                            <span class="text-danger small"><?php 
                                                                    if(isset($data['emptyPassword'])){
                                                                        echo $data['emptyPassword'];
                                                                    }
                                                                    elseif(isset($data['ErrPassword'])){
                                                                        echo $data['ErrPassword'];
                                                                    } 
                                                            ?>
                            </span>
                        </div>
                        <div class="form-group form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="remember" <?php 
                                                                                                    if(isset($_COOKIE["remember_email"])){ 
                                                                                                ?> checked <?php
                                                                                                } 
                                                                                                ?>>Behalte mich in Erinnerung
                            </label>
                        </div>
                        <div class="form-group form-check">
                            <label class="form-check-label">
                                <p class="d-inline">Erstellen sie Ihr <a href="<?php URL ?>register/index">Konto</a></p>
                                <p class="d-inline ml-5">Passwort <a href="<?php URL ?>forgot/index">vergessen?</a></p>
                            </label>
                        </div>
                        <button type="submit" class="btn btn-dark">Einloggen</button>
                    </form> 
                    <!-- Ende Form -->

                </div>
            </div>
        <div class="col-lg-4"></div>
    </div>
</body>
</html>
