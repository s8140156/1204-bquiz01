<div class="cent" onclick="pp(1)"><img src="./icon/up.jpg" alt=""></div>
					<?php
					$imgs=$Image->all(['sh='=>1]);
					foreach($imgs as $idx => $img){
						?>
					<div id="ssaa<?=$idx;?>" class="im cent">
						<img src="./img/<?=['img'];?>" style="width:150px;height:103px;border:3px solid orange;margin:3px"></div>
					<?php
				}
					?>
					<div class="cent" onclick="pp(2)"><img src="./icon/dn.jpg" alt=""></div>
					<script>
						var nowpage = 1,
							num =<?=$Image->count(['sh'=>1]);?>;
							// 宣告變數 js用,分開即可
							//調整nowpage = 0=>1
							//調整總圖片數num = 0=>9;

						function pp(x) {
							var s, t;
							if (x == 1 && (nowpage - 1) >= 0) {
								// 在php, 運算元最好隔開; js還好
								// x=1應該是點擊上一頁
								{nowpage--;}
							}
							if (x == 2 && (nowpage + 1)<= num * 1 - 3) {
								// x=2應該是點擊下一頁
								//每翻頁一次放三張圖片
								調整
								{nowpage++;}
							}
							$(".im").hide()
							//class=im的物件都會隱藏
							for (s = 0; s <= 2; s++) {
								//迴圈跑三次
								t = s * 1 + nowpage * 1;
								$("#ssaa" + t).show()
								//id=ssaa+1or2or3...的物件會顯示
							}
						}
						pp(2)
					</script>