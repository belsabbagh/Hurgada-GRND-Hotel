
<?php
    include_once "../../global/php/db-functions.php";    
    function signUp(){
        if(!post_data_exists()){
            throw new Exception("form wasn't submitted to the database.");
        }
        run_query("INSERT INTO USERS")
    }
?>