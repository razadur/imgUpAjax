<?php
$count = $_POST['count'];

$imgName = $_FILES['upload']['name'];
$imgType = $_FILES['upload']['type'];
$imgTmp_name = $_FILES['upload']['tmp_name'];
$imgSize = $_FILES['upload']['size'];
$chk=0;
for($i=0; $i<$count;$i++){
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES['upload']['name'][$i]);
    if(move_uploaded_file($_FILES["upload"]["tmp_name"][$i], $target_file)){
        $chk++;
    }
}
if($count == $chk){
    echo "Yes Working :)";
}
?>