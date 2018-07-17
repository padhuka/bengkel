<?php
if(!empty($_FILES['filescan']['name'])){
    $uploadedFile = '';
        $fileName = $_FILES['filescan']['name'];
            $sourcePath = $_FILES['filescan']['tmp_name'];
            $targetPath = "../../file/tmp/".$fileName;
            if(move_uploaded_file($sourcePath,$targetPath)){
                $uploadedFile = $fileName;
            }
    
}
?>