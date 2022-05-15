<?php
    include_once "../../global/php/db-functions.php";    
    function signUp(){
        if(!($_SERVER['REQUEST_METHOD'] == 'POST')){
            throw new Exception("{$_SERVER['REQUEST_METHOD']} form isn't submitted to the database.");
        }

        if (!fileUploaded('user_pic')||(!fileUploaded('national_id_photo')))
        throw new Exception("image not uploaded into the database.");
        
        $pfp_name= insert_pic_into_directory($_FILES['user_pic'], $_POST['email'], pfp_directory_path);
        $id_name= insert_pic_into_directory($_FILES['national_id_photo'], $_POST['email'], id_pic_directory_path);

        try{
            run_query("INSERT INTO users (first_name, last_name, email, password, user_pic, national_id_photo, user_type) 
        VALUES ('{$_POST['first_name']}','{$_POST['last_name']}','{$_POST['email']}','{$_POST['password']}','$pfp_name' ,'$id_name',3) ");
        }
        catch (Exception $e){
            echo $e->getMessage();
            throw new Exception("unable to signup.");
        }
        
    }
    try{
        signUp();
        echo "successful.";
    }
    catch(Exception $e){
        echo $e->getMessage();
    }

?>
