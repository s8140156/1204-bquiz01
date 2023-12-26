<div class="di" style="height:540px; border:#999 1px solid; width:53.2%; margin:2px 0px 0px 0px; float:left; position:relative; left:20px;">
	<!-- <marquee scrolldelay="120" direction="left" style="position:absolute; width:100%; height:40px;">
	</marquee> -->
	<?php include "marquee.php"; ?>
		<!-- 將跑馬燈功能(獨立一個功能) include到其他前台頁面（因為前台頁面都是獨立的） -->


	<div style="height:32px; display:block;"></div>
	<!--正中央-->
	<h3>更多最新消息顯示區</h3>
	<hr>
	<?php
	$total = $DB->count(['sh' => 1]);
	// 因為是前台 只能show select有顯示的 所以資料庫在count要加上只有顯示的
	$div = 5;
	$pages = ceil($total / $div);
	$now = $_GET['p'] ?? 1;
	// 這邊是三元運算式(而且又簡寫) 主要是取得目前在哪一頁藉由網址p傳值,but這邊有判斷
	//如果 $_GET['p'] 存在且不為 null，則將其值賦給 $now；否則，將默認值 1 (第一頁)賦給 $now。
	//原式：$now = isset($_GET['p']) ? $_GET['p'] : 1;
	$start = ($now - 1) * $div;
	//計算當前頁面的"起始索引"，用於資料庫查詢
	//起始索引從0(主要從0開始),5,10, 所以要找起始索引 可以從傳來的頁數-1 就是該頁索引值
	$news = $News->all(['sh' => 1], " limit $start,$div");
	// 從資料庫撈有顯示的 並限制是從該開始頁開始,每頁取五筆資料
	?>
	<ol start='<?= $start + 1; ?>'>
		<!-- 這邊把ul->ol 然後就不使用style:decimal -->
		<!-- decimal:數字 是說列表有編碼 沒有decimal就是點點 style還有square... -->
		<!-- 因為$start是索引值 與頁數會差一 所以+1 ex.第二頁 索引值5+1 第二頁第一篇文章編號就是6 -->
		<?php
		foreach ($news as $n) {
			echo "<li class='sswww'>";
			// 在li放入class='sswww' 用在下面js使用, 放在li滑鼠在滑過每條文章有彈出視窗顯示
			echo mb_substr($n['text'], 0, 20);
			echo "<div class='all' style='display:none'>";
			echo $n['text'];
			echo "</div>";
			echo "...</li>";
		}
		?>
	</ol>
	<div class="cent">

		<?php
		if ($now > 1) {
			$prev = $now - 1;
			echo "<a href='?do=$do&p=$prev'> < </a>";
		}

		for ($i = 1; $i <= $pages; $i++) {
			$fontsize = ($now == $i) ? '24px' : '16px';
			echo "<a href='?do=$do&p=$i' style='font-size:$fontsize'> $i </a>";
		}

		if ($now < $pages) {
			$next = $now + 1;
			echo "<a href='?do=$do&p=$next'> > </a>";
		}
		?>
	</div>
</div>
<!-- 以下這段容器+js是從back.php(其實index也有)用在顯示文章旁邊彈開視窗搬過來的-->
<!-- 解題過程 有發生裡面pre格式無法顯現(因為index也有同樣的程式 造成程式重複跑？) -->
<!-- 因為news這是前台的所以index那邊的js要刪除或是註解以免程式重複跑造(應該index那邊先)成格式無法導入 -->
<div id="alt" style="position: absolute; width: 350px; min-height: 100px; word-break:break-all; text-align:justify;  background-color: rgb(255, 255, 204); top: 50px; left: 400px; z-index: 99; display: none; padding: 5px; border: 3px double rgb(255, 153, 0); background-position: initial initial; background-repeat: initial initial;">
</div>
<script>
	$(".sswww").hover(
		function() {

			$("#alt").html('<pre>' + $(this).children(".all").html() + '</pre>').css({
				//這邊有另加上<pre></pre>
				"top": $(this).offset().top - 50
				//offset跳開 位移
			})
			$("#alt").show()
		}
	)
	$(".sswww").mouseout(
		function() {
			$("#alt").hide()
		}
	)
</script>