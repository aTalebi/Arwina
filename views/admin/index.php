<div class="row mt-5">
    <div class="col-lg-4"></div>
        <div class="col-lg-4 bg-light p-5">
            <div>
                <form method="POST" action="admin/checkfile" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="file">Datei wählen</label>
                        <input type="file" id="file" name="file" class="form-control">

                        <span class="text-danger small d-block mt-2">
                            <?php
                                if(isset($data['muchError'])){
                                    echo $data['muchError'];
                                }
                                if(isset($data['anyError'])){
                                    echo $data['anyError'];
                                }
                                if(isset($data['typeError'])){
                                    echo $data['typeError'];
                                }
                                if(isset($data['invalidError'])){
                                    echo $data['invalidError'];
                                }
                            ?>
                        </span>
                        <span class="text-success small d-block mt-2">
                            <?php
                                if(isset($data['noError'])){
                                    echo $data['noError'];
                                }
                            ?>
                        </span>
                        
                        <button type="submit" name="submit" class="btn-sm btn-dark mt-2">hochladen</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
