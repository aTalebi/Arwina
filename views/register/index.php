<body>
    <div class="row">
        <div class="col-lg-12">
            <div class="pl-5 pt-3">
                <h4>Konto Erstellen</h4>
            </div>
        </div>
    </div>
    <form id="contact" method="POST" action="<?php URL ?>register/store" >
        <div class="row">
            <div class="col-lg-4"></div>
                <div class="col-lg-4 bg-light p-5">
                    <div class="">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="token" value="<?php echo Model::tokenSet(); ?>">
                            </div>
                            <div class="form-group">
                                <label for="username">Ihr Name</label>
                                <input type="text" class="form-control" placeholder="Enter username" id="username" name="username">
                                <span class="text-danger small"><?php 
                                                                    if(isset($data['usernameEmpty'])){
                                                                        echo $data['usernameEmpty'];
                                                                    }elseif(isset($data['userNameInvalid'])){
                                                                        echo $data['userNameInvalid'];
                                                                    } 
                                                                ?>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="email">E-Mail</label>
                                <input type="email" class="form-control" placeholder="Enter email" id="email" name="email">
                                <span class="text-danger small"><?php 
                                                                    if(isset($data['emailEmpty'])){
                                                                        echo $data['emailEmpty'];
                                                                    }elseif(isset($data['emailInvalid'])){
                                                                        echo $data['emailInvalid'];
                                                                    }
                                                                    elseif(isset($data['emailExists'])){
                                                                        echo $data['emailExists'];
                                                                    } 
                                                                ?>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="password-1">Passwort</label>
                                <input type="password" class="form-control" placeholder="Enter password" id="password-1" name="password-1">
                                <span class="text-danger small"><?php 
                                                                    if(isset($data['password1Empty'])){
                                                                        echo $data['password1Empty'];
                                                                    }elseif(isset($data['password1Invalid'])){
                                                                        echo $data['password1Invalid'];
                                                                    } 
                                                                ?>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="password-2">Passwort nochmals eingeben</label>
                                <input type="password" class="form-control" placeholder="Enter password" id="password-2" name="password-2">
                                <span class="text-danger small"><?php 
                                                                    if(isset($data['password2Empty'])){
                                                                        echo $data['password2Empty'];
                                                                    }elseif(isset($data['password2Invalid'])){
                                                                        echo $data['password2Invalid'];
                                                                    }elseif(isset($data['password'])){
                                                                        echo $data['password'];
                                                                    }  
                                                                ?>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="code">Ihr Code</label>
                                <input type="text" class="form-control" placeholder="Enter code" id="code" name="code">
                                <span class="text-danger small"><?php 
                                                                    if(isset($data['codeEmpty'])){
                                                                        echo $data['codeEmpty'];
                                                                    }elseif(isset($data['codeInvalid'])){
                                                                        echo $data['codeInvalid'];
                                                                    } 
                                                                ?>
                                </span>
                            </div>
                
                            <button type="submit" class="btn btn-dark">Erstellen sie Ihr Konto</button>

                            <p class="mt-2">Sie haben bereits ein Konto? <a href="<?php URL ?>login/index">Anmelden</a></p>
                    </div>
                </div>
            <div class="col-lg-4"></div>
        </div>
    </form>
</body>
</html>