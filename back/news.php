<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
	<p class="t cent botli">最新消息資料管理</p>
	<form method="post" action="./api/edit.php">
		<table width="100%">
			<tbody>
				<tr class="yel">

					<td width="80%">最新消息資料內容</td>
					<td width="10%">顯示</td>
					<td width="10%">刪除</td>
					<td></td>
				</tr>
				<?php
				$total = $DB->count();
				$div = 5;
				$pages = ceil($total / $div);
				$now = $_GET['p'] ?? 1;
				$start = ($now - 1) * $div;
				$rows = $DB->all(" limit $start,$div");
				// limit 要空一格, 要查一下用法
				foreach ($rows as $row) {

				?>
					<tr>
						<td width="23%">
							<textarea type="text" name="text[<?= $row['id']; ?>]" style="width:90%" value=""><?= $row['text']; ?></textarea>
							<!--  改成textarea及將value傳值改接到後面,不要斷行 -->
						</td>
						<td width="7%">
							<input type="checkbox" name="sh[]" value="<?= $row['id']; ?>" <?= ($row['sh'] == 1) ? 'checked' : ''; ?>>
						</td>
						<td width="7%">
							<input type="checkbox" name="del[]" value="<?= $row['id']; ?>">
						</td>

					</tr>

				<?php
				}
				?>
			</tbody>
		</table>
		<div class="cent">
			<?php
	
			if ($now> 1) {
				$prev = $now - 1;
				echo "<a href='?do=$do&p=$prev'> < </a>";
			}
	
			for ($i = 1; $i <= $pages; $i++) {
				$fontsize = ($now == $i) ? '24px' : '16px';
				echo "<a href='?do=$do&p=$i' style='font-size:$fontsize'> $i </a>";
			}
	
			if ($now < $pages){
				$next = $now + 1;
				echo "<a href='?do=$do&p=$next'> > </a>";
			}
			?>
			<table style="margin-top:40px; width:70%;">
				<tbody>
					<tr>
						<input type="hidden" name="table" value="<?= $do; ?>">
						<td width="200px"><input type="button" onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,'./modal/<?= $do; ?>.php?table=<?= $do; ?>')" value="新增動態文字廣告"></td>
						<td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置"></td>
					</tr>
				</tbody>
			</table>

		</div>

	</form>
</div>