<?php
//這是新增圖片及顯示
//使用在ad/title.php(modal)

include_once "db.php";

// $_POST (會從表單傳遞資料)
// $_FILE (會有上傳圖檔)

$DB=${ucfirst($_POST['table'])};
$table=$_POST['table'];
// 先把post傳來的資料存成變數$table
switch($table){
    case "admin":
        unset($_POST['pw2']);
    break;
}

if(isset($_FILES['img']['tmp_name'])){
	move_uploaded_file($_FILES['img']['tmp_name'],"../img/".$_FILES['img']['name']);
	$_POST['img']=$_FILES['img']['name'];
}
if($table != 'admin'){
	$_POST['sh']=($table=='title')?0:1;
}

switch($table){
    case "menu";
    $_POST['menu_id']=0;
}
//如果有多加以上switch case針對menu_id寫進先預設為0的話,則mac應該就可以直接寫入資料庫而不會有fatal warning



unset($_POST['table']);
// 因為從modal/title.php來的資訊 有text, 也有table 但table在資料表裡沒有欄位 無法寫入 所以在執行存進資料表前 先unset $_post['table'](刪除變數 不需要的欄位)再存入
$DB->save($_POST);

to("../back.php?do=$table");



?>
