<?php
    include '../includes/connection.php';
    
    if(isset($_POST['general_settings'])){
        $stmt = $db->query("UPDATE configuration SET site_title='".$_POST['title']."' WHERE id='".$_POST['general_settings']."'");
        if($stmt){
            ?>
                <script type="text/javascript">                      
                      window.location = "general_settings?id=<?php echo $_POST['general_settings']; ?>&msg=2&value=General Settings";
                </script>
            <?php
        }else{
            ?>
                <script type="text/javascript">                      
                      window.location = "general_settings?msg=0";
                </script>
            <?php  
        }
    }else if(isset($_POST['edit_user_profile_form'])){
        //department_registration_form
        $stmt = $db->query("UPDATE users SET first_name='".$_POST['first_name']."', last_name='".$_POST['last_name']."', contact='".$_POST['cell_no']."', username='".$_POST['email']."', password='".$_POST['password']."' WHERE id='".$_POST['edit_id']."'");
        if($stmt){
            ?>
                <script type="text/javascript">                      
                      window.location = "user_profile?msg=2&value=Profile";
                </script>
            <?php
        }else{
            ?>
                <script type="text/javascript">                      
                      window.location = "user_profile?msg=0";
                </script>
            <?php  
        }
        
    }

?>