<div class="di" style="height:540px; border:#999 1px solid; width:53.2%; margin:2px 0px 0px 0px; float:left; position:relative; left:20px;">
	<?php include "marquee.php"; ?>
	<!-- 將跑馬燈功能(獨立一個功能) include到其他前台頁面（因為前台頁面都是獨立的） -->
	<!-- 注意同層不用加. or ./ -->
	<div style="height:32px; display:block;"></div>
	<!--正中央-->
	<div style="width:100%; padding:2px; height:290px;">
		<div id="mwww" loop="true" style="width:100%; height:100%;">
			<!-- 搬移這塊往上(執行script的空間(容器))是因為先前script寫在上面 造成尚無空間可以執行 -->
			<!-- 要建房子先找地! 之前html(地)位置是在js底下會導致js開始沒有承接的地方　所以容器mwww要先產生 -->
			<div style="width:99%; height:100%; position:relative;" class="cent">沒有資料</div>
			<!-- 在js程式 有一段.html("<embed loop=true src='./img/" + lin[now] + "' style='width:99%; height:100%;'></embed>")-->
			<!-- 這邊插入圖片後 是取代上面div-->
		</div>
	</div>
	<script>
		var lin = new Array();
		<?php
		$lins = $Mvim->all(['sh' => 1]);
		// 因為是在js底下操作 使用php叫出資料庫撈出mvim的資料讓他變成$lin陣列
		foreach ($lins as $lin) {
			echo "lin.push('{$lin['img']}');";
			// 在js裡面執行php程式如果沒有把程式寫清楚(字串寫完後要加;)php會吃掉後面的程式 會讓js在執行時 造成字沒有區隔 js無法執行;才可以判別是獨立字串
			//　可以在畫面上右鍵"檢查網頁原始碼"=>是看當下寫完的php程式狀況
			//　最終是要把php撈出來的資料（變成字串）變成js陣列可以顯示
			// lin.push在lin陣列push n個字串{$lin['img']}（記得後面要加;）
		}
		?>
		var now = 0;
		ww();
		// 在這邊先執行一次js, 讓圖片可以直接顯示也不會變成先顯現第二張圖;這不是新增　是調整執行位置
		if (lin.length > 1) {
			// 假如lin這個陣列個數>1(也就是陣列至少要2個)
			setInterval("ww()", 3000);
			// 每隔三秒鐘執行ww()一次(第一次執行是3秒後開始第一次)
			now = 1;
			//原先變數now預設0 但接下來執行setInterval 變數now為1(idx=1), 
			//三秒後是顯示第二張圖;有修改程式在宣告now=0後先執行一次ww();讓圖片先顯示出來
		}

		function ww() {
			$("#mwww").html("<embed loop=true src='./img/" + lin[now] + "' style='width:99%; height:100%;'></embed>")
			// 這邊要記得把圖片路徑放上(在js程式下)
			//$("#mwww").attr("src",lin[now])
			now++;
			if (now >= lin.length)
				// length:指lin的陣列的個數(數量)
				now = 0;
		}
	</script>
	<div style="width:95%; padding:2px; height:190px; margin-top:10px; padding:5px 10px 5px 10px; border:#0C3 dashed 3px; position:relative;">
		<span class="t botli">最新消息區
			<?php
			if ($News->count(['sh' => 1]) > 5) {
				echo "<a href='?do=news' style='float:right'>More...</a>";
			}

			?>
		</span>
		<ul class="ssaa" style="list-style-type:decimal;">
			<!-- decimal:數字 是說列表有編碼 沒有decimal就是點點 style還有square... -->
			<?php
			$news = $News->all(['sh' => 1], ' limit 5');
			// limit前面還是加空白, 怕sql執行時 字跟字(各條件)黏在一起無法執行
			foreach ($news as $n) {
				echo "<li>";
				echo mb_substr($n['text'], 0, 20);
				echo "<div class='all' style='display:none'>";
				// 這是用在彈出視窗的內容, 以class=all綁js, display:none是不要讓內容顯示變兩個(主文區)
				// 只是讓內容不要出現在html上 but js還是可以抓到資料 但如果使用hidden是真的會讓內容不見
				echo $n['text'];
				echo "</div>";
				echo "...</li>";
			}
			?>
		</ul>
		<div id="altt" style="position: absolute; width: 350px; min-height: 100px; background-color: rgb(255, 255, 204); top: 50px; left: 130px; z-index: 99; display: none; padding: 5px; border: 3px double rgb(255, 153, 0); background-position: initial initial; background-repeat: initial initial;"></div>
		<!-- 這邊是最新消息區的彈出視窗(顯示文章完整內容) -->
		
		<script>
			$(".ssaa li").hover(
				function() {
					$("#altt").html("<pre>" + $(this).children(".all").html() + "</pre>")
					// .html 是在做把後面pre(整段字串)放到id=altt(容器)裡面
					// $(this)=>是指hover過去該<li>的元素以下的容器.children (.all=>設定class=all)
					// 最後一個.html() 就像sql all() 抓取整個資料
					$("#altt").show()
				}
			)
			$(".ssaa li").mouseout(
				function() {
					$("#altt").hide()
				}
			)
		</script>
	</div>
</div>