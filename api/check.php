<?php

include_once "db.php";
// 因為db已寫了session start這邊不用在寫

if($Admin->count(['acc'=>$_POST['acc'],'pw'=>$_POST['pw']])>0){
	$_SESSION['login']=$_POST['acc'];
	to("../back.php");
}else{
	to("../index.php?do=login&error=帳號或密碼錯誤");
}





?>