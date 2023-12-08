<?php
//這是更新標題網站圖片
// 使用在upload.php(modal)

include_once "db.php";

$table=$_POST['table'];
$DB=${ucfirst($table)};
$row=$DB->find($_POST['id']);

if(isset($_FILES['img']['tmp_name'])){
	move_uploaded_file($_FILES['img']['tmp_name'],'../img/'.$_FILES['img']['name']);
	$row['img']=$_FILES['img']['name'];
}

$DB->save($row);
to("../back.php?do=$table");
// 轉回上一頁