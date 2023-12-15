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
			// 確認次選單不要有空值, 所以如果不是空值才增加
			$data=[];
			$data['text']=$text;
			$date['href']=$_POST['add_href'][$idx];
			$data['sh']=1;
			$data['menu_id']=$_POST['menu_id'];
			// 有在modal/submenu設定hidden id=menu_id(就是傳過來的主id)
				$Menu->save($data);

		}

	}
}

to("../back.php?do=menu");

?>