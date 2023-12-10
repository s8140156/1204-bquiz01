<?php

//頁尾版權編輯bottom.php & 進站人數編輯total.php

include_once "db.php";
//取得資料表名稱 (從total.php的hidden input name=table value=total/bottom=>後改為$do)
$table=$_POST['table'];

//把取得的資料表名稱轉成首字大寫的資料表物件變數
$DB=${(ucfirst($table))};

//執行去資料庫 取得id為1的資料
$data=$DB->find(1);

//將資料庫中對應的欄位修改為post過來的值
$data[$table]=$_POST[$table];

// 將存好的資料寫進資料表(庫)
$DB->save($data);

to("../back.php?do=$table");
// 重要：是回“後臺頁面”給do=到對應的網頁

?>