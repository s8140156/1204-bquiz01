<?php 
include_once "db.php";

if(isset($_POST['id'])){
	foreach($_POST['id'] as $idx => $id){
		if(isset($_POST['del']) && in_array($id,$_POST['del'])){
			$Menu->del($id);
		}else{
			$row=$Menu->find($id);
			$row['text']=$_POST['text'][$idx];
			$row['href']=$_POST['href'][$idx];
			$Menu->save($row);
		}

	}
}

if(isset($_POST['add_text'])){
	foreach($_POST['add_text'] as $idx => $text){
		if($text!=""){
			// 這個判斷是在“次選單的名稱(這個欄位)”不可以有空值後 才可以執行以下程式（增加欄位寫入）
			// 但是 如果次選單名稱有輸入 但“次選單連結網址”沒有資訊 還是可寫進資料庫
			$data=[];
			$data['text']=$text;
			$data['href']=$_POST['add_href'][$idx];
			$data['sh']=1;
			$data['menu_id']=$_POST['menu_id'];
			// 有在modal/submenu設定hidden id=menu_id(就是傳過來的主id)
				$Menu->save($data);

		}

	}
}

to("../back.php?do=menu");

?>