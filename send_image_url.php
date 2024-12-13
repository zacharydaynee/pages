<?php
include '../includes/connection.php';
$query = $db->query("SELECT * FROM images WHERE status='0' ORDER BY id DESC LIMIT 1");
if($query->num_rows>0){
    $q = $query->fetch_assoc();
if($q['status']==0)
echo "E:/xammp/htdocs/smart/".$q['image_url'];
else
echo "-";
}else{
    echo "-";
}

?>