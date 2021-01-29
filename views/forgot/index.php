<div class="row">
        <div class="col-lg-12">
            <div class="pl-5 pt-3">
                <h4>Passworthilfe</h4>
                <p class="small">Geben Sie die E-Mail-Adresse ein,</br> die mit Ihrem Awina-Konto verbunden ist. </p>
            </div>
        </div>
    </div>
<div class="row mt-5">
        <div class="col-lg-4"></div>
            <div class="col-lg-4 bg-light p-5">
                <div class="">
                    <!-- Start Form -->
                    <form method="POST" action="<?php URL ?>forgot/checkEmail">
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
                                                                    if(isset($data['invalidEmail'])){
                                                                        echo $data['invalidEmail'];
                                                                    }
                                                                    if(isset($data['errorEmail'])){
                                                                        echo $data['errorEmail'];
                                                                    }
                                                                ?>
                            </span>
                        </div>
                        <button type="submit" class="btn btn-dark" name="submit">Weiter</button>
                    </form> 
                    <!-- Ende Form -->

                </div>
            </div>
        <div class="col-lg-4"></div>
    </div>
</body>
</html>
