<?php

include_once "db.php";

// $_POST (會從表單傳遞資料)
// $_FILE (會有上傳圖檔)

$DB=${ucfirst($_POST['table'])};
$table=$_POST['table'];

if(isset($_FILES['img']['tmp_name'])){
	move_uploaded_file($_FILES['img']['tmp_name'],"../img/".$_FILES['img']['name']);
	$_POST['img']=$_FILES['img']['name'];
}

unset($_POST['table']);
$DB->save($_POST);

to("../back.php?do=$table");



?>
