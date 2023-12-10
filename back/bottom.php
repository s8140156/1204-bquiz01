<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
	<p class="t cent botli">頁尾版權資料管理</p>
	<form method="post" action="./api/edit_info.php">
		<!-- 因為已將total include進back.php(寫在edit_total.php)所以要以back.php角度來看檔案位置 所以會是同一層的api底下 -->
		<!-- target拿掉 action要改成由api裡面程式執行 -->
		<table style="width:50%; margin:auto">
			<tbody>
				<tr class="yel">

					<td width="50%">頁尾版權資料</td>

					<td width="50%">
						<input type="text" name="bottom" value="<?= $Bottom->find(1)['bottom']; ?>">
						<input type="hidden" name="table" value="<?= $do; ?>"> 
						<!--增加一個hidden input, 設個name="table"透過表單要傳值去edit_info.php
						 table裡面的value(資料)其實是table資料表（由$do取得）-->
					</td>

					<td></td>
				</tr>
			</tbody>
		</table>
		<table style="margin-top:40px; width:70%;">
			<tbody>
				<tr>
					<td width="200px"></td>

					<td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置"></td>
				</tr>
			</tbody>
		</table>

	</form>
</div>