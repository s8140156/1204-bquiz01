<?php

if(isset($_SESSION['login'])){
	to("back.php");
}
// 這應該是判斷如果session有收到login資訊則直接轉到後台

if(isset($_GET['error'])){
	echo "<script>alert('{$_GET['error']}')</script>";
}
// 這邊使用js當登入錯誤使用alert顯示錯誤訊息

?>

<div class="di" style="height:540px; border:#999 1px solid; width:53.2%; margin:2px 0px 0px 0px; float:left; position:relative; left:20px;">
	<!-- <marquee scrolldelay="120" direction="left" style="position:absolute; width:100%; height:40px;">
	</marquee> -->
	<?php include "marquee.php";?>
	<!-- 將跑馬燈功能(獨立一個功能) include到其他前台頁面（因為前台頁面都是獨立的） -->

	<div style="height:32px; display:block;"></div>
	<!--正中央-->
	<form method="post" action="./api/check.php" >
		<!-- 要注意因為front/loginin是已包含在index.php下 所以路徑位置要用index.php角度看 使用../是沒用的 -->
		<!-- ?do=check 是在index.php底下要轉到check.php -->
		<p class="t botli">管理員登入區</p>
		<p class="cent">帳號 ： <input name="acc" autofocus="" type="text"></p>
		<p class="cent">密碼 ： <input name="pw" type="password"></p>
		<p class="cent"><input value="送出" type="submit"><input type="reset" value="清除"></p>
		
	</form>
</div>