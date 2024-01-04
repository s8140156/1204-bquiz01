<?php

include_once "db.php";
// 通常程式使用到session要記得寫session_start(), but因為db已寫了session start()這邊不用在寫

if($Admin->count(['acc'=>$_POST['acc'],'pw'=>$_POST['pw']])>0){
	$_SESSION['login']=$_POST['acc']; //如果上述判斷有的話, 因為也沒撈資料 直接post的資料存進session紀錄狀態
	to("../back.php");
}else{
	to("../index.php?do=login&error=帳號或密碼錯誤");
}
// 這邊是在判斷進站人數不重複計算

//這邊使用count只是要確認是否有帳密資料 不是要取資料 並這樣可以減少流量




?>