<?php

class model_admin extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function fileInfos($file){
        $uploadErrors=[];

        $fileName=$file["name"];
        $fileTmpName=$file["tmp_name"];
        $fileSize=$file["size"];
        $fileError=$file["error"];
        $fileType=$file["type"];
        
        $fileExt=explode('.',$fileName);
        $fileActualExt=strtolower(end($fileExt));

        $allowed=["pdf","jpeg","jpg","png"];

        if(in_array($fileActualExt,$allowed)){                               //type Control
            if($fileError === 0){
                if($fileSize < 1000000){
                    if(is_uploaded_file($file["tmp_name"])){                 //if from http upload?
                        $fileNameNew=uniqid('',true).".".$fileActualExt;     //file rename
                        $fileDestination="public/img/slider/".$fileNameNew;
                        move_uploaded_file($fileTmpName,$fileDestination);   //file move
                        $uploadErrors["noError"]="Ihre Datei wurde erfolgreich gespeichert";
                    }else{
                        $uploadErrors["invalidError"]="Ihre Datei ist ungültig";
                    }
                }else{
                    $uploadErrors["muchError"]="Ihre Datei ist zu groß";
                }
            }else{
                $uploadErrors["anyError"]="Beim Hochladen Ihrer Datei ist ein Fehler aufgetreten";
            }
        }else{
            $uploadErrors["typeError"]="Sie können keine Dateien dieses Typs hochladen";
        }

        return $uploadErrors;
    }

}

?>

