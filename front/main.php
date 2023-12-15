
<div class="di" style="height:540px; border:#999 1px solid; width:53.2%; margin:2px 0px 0px 0px; float:left; position:relative; left:20px;">
	<?php include "marquee.php";?>
	<!-- 注意同層不用加. or ./ -->
				<div style="height:32px; display:block;"></div>
				<!--正中央-->
				<div style="width:100%; padding:2px; height:290px;">
					<div id="mwww" loop="true" style="width:100%; height:100%;">
					<!-- 搬移這塊往上(執行script的空間(容器))是因為先前script寫在上面 造成尚無空間可以執行 -->
						<div style="width:99%; height:100%; position:relative;" class="cent">沒有資料</div>
					</div>
				</div>
				<script>
					var lin = new Array();
					<?php 
					$lins=$Mvim->all(['sh'=>1]);
						foreach($lins as $lin){
							echo "lin.push('{$lin['img']}');";
							// 這邊只聽懂在後面字串寫完後要加; 不然會讓js在執行時 造成字沒有區隔 js無法執行;才可以判別是獨立字串
						}
						?>
					var now = 0;
					ww();
					// 在這邊先執行一次js, 讓圖片可以直接顯示也不會變成先顯現第二張圖
					if (lin.length > 1) {
						// 假如lin這個陣列個數>1(也就是陣列至少要2個)
						setInterval("ww()", 3000);
						// 每隔三秒鐘執行ww()一次(第一次執行是3秒後開始第一次)
						now = 1;
					}

					function ww() {
						$("#mwww").html("<embed loop=true src='./img/" + lin[now] + "' style='width:99%; height:100%;'></embed>")
						// 這邊要記得把圖片路徑放上
						//$("#mwww").attr("src",lin[now])
						now++;
						if (now >= lin.length)
						// length:指陣列的個數
							now = 0;
					}
				</script>
				<div style="width:95%; padding:2px; height:190px; margin-top:10px; padding:5px 10px 5px 10px; border:#0C3 dashed 3px; position:relative;">
					<span class="t botli">最新消息區
						<?php
						if($News->count(['sh'=>1])>5){
							echo "<a href='?do=news' style='float:right'>More</a>";

						}

						?>
					</span>
					<ul class="ssaa" style="list-style-type:decimal;">
					<!-- decimal:數字 是說列表有編碼 沒有decimal就是點點 style還有square... -->
					<?php
					$news=$News->all(['sh'=>1],' limit 5');
					// limit前面還是加空白, 怕sql執行時 字跟字(各條件)黏在一起無法執行
					foreach($news as $n){
						echo "<li>";
						echo mb_substr($n['text'],0,20);
						echo "<div class='all' style='display:none'>";
						echo $n['text'];
						echo "</div>";
						echo "...</li>";
					}
					?>
					</ul>
					<div id="altt" style="position: absolute; width: 350px; min-height: 100px; background-color: rgb(255, 255, 204); top: 50px; left: 130px; z-index: 99; display: none; padding: 5px; border: 3px double rgb(255, 153, 0); background-position: initial initial; background-repeat: initial initial;"></div>
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