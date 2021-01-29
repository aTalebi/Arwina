<body>
    <header>
        <div class="row">
            <div class="col-lg-3">
                <div class="pl-5">
                    <img src="public/img/arwina-logo.jpeg" with="200" height="100">
                </div>
            </div>

            <div class="col-lg-3">
                <div class="pl-5">
                    
                </div>
            </div>

            <div class="col-lg-3">
                <div class="pl-5">

                </div>
            </div>

            <div class="col-lg-3">
                <div class="pr-5 text-right">
                    <a class="text-decoration-none text-muted mr-2" href="<?php URL ?>login/index">
                        <?php
                            Model::sessionInit();
                            if(isset($_SESSION['name'])){
                                echo "<a href='home/index'>Hallo ".$_SESSION['name']."</a>";
                            }else{
                                echo "anmelden";
                            }
                        ?>
                    </a>
                    <a class="text-decoration-none text-muted" href="<?php URL ?>register/index">
                    <?php
                            if(isset($_SESSION['name'])){
                                echo "";
                            }else{
                                echo "registrieren";
                            }
                        ?> 
                    </a>
                </div>
            </div>
            
        </div>
    </header>