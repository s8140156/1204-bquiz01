<?php

include_once "db.php";

if($Admin->count(['acc'=>$_POST['acc'],'pw'=>md5($_POST['pw'])])){ //在add.php有加入pw的編碼 這邊要同步一起編碼 才有辦法檢查
	$_SESSION['login']=$_POST['acc'];
	to("../back.php");
}else{
	to("../index.php?do=login&error=帳號或密碼錯誤");
}
// 通常程式使用到session要記得寫session_start(), but因為db已寫了session start()這邊不用在寫

// ' OR 1=1; =>SQL注入(injection)
// $acc=htmlspecialchars($_POST['acc']); //改到db從資料輸入就開始檢查 這樣就不用每個表單調整輸入參數欄位
// $pw=htmlspecialchars($_POST['pw']); //將post來的資料先過濾再存入

// if($Admin->count(['acc'=>$_POST['acc'],'pw'=>$_POST['pw']])>0){
	// $_SESSION['login']=$_POST['acc']; //如果上述判斷有的話, 因為也沒撈資料 直接post的資料存進session紀錄狀態
// 	to("../back.php");
// }else{
// 	to("../index.php?do=login&error=帳號或密碼錯誤");
// }


// 以下是如果在表單裡直接檢查 上面先做過濾存成變數後 下面程式要帶變數進去
// if($Admin->count(['acc'=>$acc,'pw'=>$pw])>0){
	// $_SESSION['login']=$acc; //如果上述判斷有的話, 因為也沒撈資料 直接post的資料存進session紀錄狀態
	// to("../back.php");
// }else{
	// to("../index.php?do=login&error=帳號或密碼錯誤");
// }
// 這邊是在判斷進站人數不重複計算

//這邊使用count只是要確認是否有帳密資料 不是要取資料 並這樣可以減少流量




?>