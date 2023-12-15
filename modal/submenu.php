<?php include_once "../api/db.php" ?>
<!-- 這個跟ajax有關 請要再聽一次老師說明 -->
<!-- 有時候不是自己程式的問題 要多方面確認 -->
<!-- 早上找不出為什麼del box未顯現 是因為要有次選單才會有box, 但截至目前menu_id還未寫入資料庫中 老師是手動先調整主/次選單練習 -->
<h3>編輯次選單</h3>
<hr>
<form action="./api/submenu.php" method="post" enctype="multipart/form-data">
	<table class="cent" id="sub">

		<tr>
			<td>次選單名稱</td>
			<td>次選單連結網址</td>
			<td>刪除</td>
		</tr>
		<?php
		$subs = $Menu->all(['menu_id' => $_GET['id']]);
		// 因為送來表單資訊除了有table外,還有id, 所以從這邊可以取得主題的id作為次選單的id
		foreach ($subs as $sub) {
		?>
		<tr>
			<!-- input type="text"特性 就算沒有打任何value 他還是會送出 -->
			<td><input type="text" name="text[]" value="<?= $sub['text']; ?>"></td>
			<td><input type="text" name="href[]" value="<?= $sub['href']; ?>"></td>
			<td><input type="checkbox" name="del[]" value="<?= $sub['id']; ?>"></td>
			<input type="hidden" name="id[]" value="<?= $sub['id']; ?>">
		</tr>
		<?php
		}
		?>

	</table>
	<div>
		<input type="hidden" name="table" value="<?= $_GET['table']; ?>">
		<input type="hidden" name="menu_id" value="<?= $_GET['id']; ?>">
		<!-- 要自己創造name=menu_id傳送過去 而且就是以主選單的id -->
		<input type="submit" value="修改確定">
		<input type="reset" value="重置">
		<input type="button" value="更多次選單" onclick="more()">

	</div>
</form>
<script>
	function more() {
		let item = `<tr>
						<td><input type="text" name="add_text[]" id=""></td>
						<td><input type="text" name="add_href[]" id=""></td>
					</tr>`

		$("#sub").append(item);
	}
</script>