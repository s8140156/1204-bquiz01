<div class="di" style="height:540px; border:#999 1px solid; width:53.2%; margin:2px 0px 0px 0px; float:left; position:relative; left:20px;">
	<!-- <marquee scrolldelay="120" direction="left" style="position:absolute; width:100%; height:40px;">
	</marquee> -->
	<?php include "marquee.php"; ?>

	<div style="height:32px; display:block;"></div>
	<!--正中央-->
	<h3>更多最新消息顯示區</h3>
	<hr>
	<?php
	$total = $DB->count(['sh' => 1]);
	// select選有顯示的
	$div = 5;
	$pages = ceil($total / $div);
	$now = $_GET['p'] ?? 1;
	$start = ($now - 1) * $div;
	$news = $News->all(['sh' => 1], " limit $start,$div");
	// limit前面還是加空白, 怕sql執行時 字跟字(各條件)黏在一起無法執行
	?>
	<ol class="ssaa" start='<?=$start+1;?>'>
		<!-- 這邊把ul->ol 然後就不使用style:decimal -->
		<!-- decimal:數字 是說列表有編碼 沒有decimal就是點點 style還有square... -->
		<?php
		foreach ($news as $n) {
			echo "<li>";
			echo mb_substr($n['text'], 0, 20);
			echo "<div class='all' style='display:none'>";
			echo $n['text'];
			echo "</div>";
			echo "...</li>";
		}
		?>
	</ol>
	<div style="text-align:center;">
		<a class="bl" style="font-size:30px;" href="?do=meg&p=0">&lt;&nbsp;</a>
		<a class="bl" style="font-size:30px;" href="?do=meg&p=0">&nbsp;&gt;</a>
	</div>
</div>