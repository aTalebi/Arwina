<body>
    <div class="row">
        <div class="col-lg-12">
            <div class="pl-5 pt-3">
                <h4>Neues Passwort erstellen</h4>
                <p class="small">Geben Sie Ihre E-Mail-Adresse und</br>das neue Passwort ein.</p>
            </div>
        </div>
    </div>
    <form id="contact" method="POST" action="<?php URL ?>forgot/store" >
        <div class="row">
            <div class="col-lg-4"></div>
                <div class="col-lg-4 bg-light p-5">
                    <div class="">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="token" value="<?php echo Model::tokenSet(); ?>">
                            </div>
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="emailSelector" value="<?php 
                                                                                                            if(isset($data['selector'])){
                                                                                                                echo $data['selector']; 
                                                                                                            }
                                                                                                      ?>"
                                >
                            </div>
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="emailToken" value="<?php
                                                                                                        if(isset($data['token'])){
                                                                                                            echo $data['token']; 
                                                                                                        }
                                                                                                    ?>"
                                >
                            </div>
                            
                            <div class="form-group">
                                <label for="email">E-Mail</label>
                                <input type="email" class="form-control" placeholder="Enter email" id="email" name="email" value="<?php 
                                                                                                                                if(isset($_COOKIE["remember_email"])){ 
                                                                                                                                    echo $_COOKIE["remember_email"];} 
                                                                                                                                ?>">
                                <span class="text-danger small">
                                    <?php 
                                        if(isset($data['freischalt'])){
                                            echo $data['freischalt'];
                                        }
                                    ?>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="password-1">Neues Passwort</label>
                                <input type="password" class="form-control" placeholder="Enter Neues password" id="password-1" name="password-1">
                                <span class="text-danger small">
                                <?php 
                                    if(isset($data['password1Empty'])){
                                        echo $data['password1Empty'];
                                    }elseif(isset($data['password1Invalid'])){
                                        echo $data['password1Invalid'];
                                    } 
                                ?>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="password-2">Neues Passwort nochmals eingeben</label>
                                <input type="password" class="form-control" placeholder="Enter Neues password" id="password-2" name="password-2">
                                <span class="text-danger small">
                                <?php 
                                    if(isset($data['password2Empty'])){
                                        echo $data['password2Empty'];
                                    }elseif(isset($data['password2Invalid'])){
                                        echo $data['password2Invalid'];
                                    }elseif(isset($data['password'])){
                                        echo $data['password'];
                                    }elseif(isset($data['linkInvalid'])){
                                        echo $data['linkInvalid'];
                                    }
                                ?>
                                </span>
                            </div>
                            <button type="submit" class="btn btn-dark">Weiter</button>
                    </div>
                </div>
            <div class="col-lg-4"></div>
        </div>
    </form>
</body>
</html>