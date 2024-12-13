<?php 
            if(isset($_GET['msg'])){
             	if($_GET['msg']==1){
             		 echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success...!</strong> <b>'.$_GET['value'].' Has Been Registered Successfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
             	}
             	if($_GET['msg']==2){
             		 echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success...!</strong> <b>'.$_GET['value'].' Has Been Updated Successfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
             	}
                else if($_GET['msg']==0){
             		 echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error...!</strong> <b>Something Went Wrong.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
             	}
 
            }
?>