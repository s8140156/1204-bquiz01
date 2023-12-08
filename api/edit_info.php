<?php

//頁尾版權編輯bottom.php

include_once "db.php";
//取得資料表名稱 (從total.php的hidden input name=table)
$table=$_POST['table'];

//把取得的資料表名稱轉成首字大寫的資料表物件變數
$DB=${(ucfirst($table))};

//執行去資料庫 取得id為1的資料
$data=$DB->find(1);

//將資料中對應的欄位修改為post過來的值
// 將取得的post資料寫進資料庫
$data[$table]=$_POST[$table];

$DB->save($data);

to("../back.php?do=$table");
// 是回後臺頁面給do=total值

?>