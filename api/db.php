<?php 
date_default_timezone_set("Asia/Taipei");
session_start();
class DB{

    protected $dsn = "mysql:host=localhost;charset=utf8;dbname=db06";
    //protected $dsn = "mysql:host=localhost;charset=utf8;dbname=bquiz";
    protected $pdo;
    protected $table;
    
    public function __construct($table)
    {
        $this->table=$table;
        //$this->pdo=new PDO($this->dsn,'s1120401','s1120401');
        $this->pdo=new PDO($this->dsn,'root','');
    }


    function all( $where = '', $other = '')
    {
        $sql = "select * from `$this->table` ";
        $sql =$this->sql_all($sql,$where,$other);
        return  $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    function count( $where = '', $other = ''){
        $sql = "select count(*) from `$this->table` ";
        $sql=$this->sql_all($sql,$where,$other);
        return  $this->pdo->query($sql)->fetchColumn(); 
    }
    private function math($math,$col,$array='',$other=''){
        $sql="select $math(`$col`)  from `$this->table` ";
        $sql=$this->sql_all($sql,$array,$other);
        return $this->pdo->query($sql)->fetchColumn();
    }
    function sum($col='', $where = '', $other = ''){
        return  $this->math('sum',$col,$where,$other);
    }
    function max($col, $where = '', $other = ''){
        return  $this->math('max',$col,$where,$other);
    }  
    function min($col, $where = '', $other = ''){
        return  $this->math('min',$col,$where,$other);
    }  
    
    function find($id)
    {
        $sql = "select * from `$this->table` ";
    
        if (is_array($id)) {
            $tmp = $this->a2s($id);
            $sql .= " where " . join(" && ", $tmp);
        } else if (is_numeric($id)) {
            $sql .= " where `id`='$id'";
        } 
        //echo 'find=>'.$sql;
        $row = $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    
    function save($array){
        if(isset($array['id'])){
            $sql = "update `$this->table` set ";
    
            if (!empty($array)) {
                $tmp = $this->a2s($array);
            } 
        
            $sql .= join(",", $tmp);
            $sql .= " where `id`='{$array['id']}'";
        }else{
            $sql = "insert into `$this->table` ";
            $cols = "(`" . join("`,`", array_keys($array)) . "`)";
            $vals = "('" . join("','", $array) . "')";
        
            $sql = $sql . $cols . " values " . $vals;
        }
        // echo $sql;
        return $this->pdo->exec($sql);
    }

    function del($id)
    {
        $sql = "delete from `$this->table` where ";
    
        if (is_array($id)) {
            $tmp = $this->a2s($id);
            $sql .= join(" && ", $tmp);
        } else if (is_numeric($id)) {
            $sql .= " `id`='$id'";
        } 
        //echo $sql;
    
        return $this->pdo->exec($sql);
    }
    
    /**
     * 可輸入各式SQL語法字串並直接執行
     */
    function q($sql){
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    }

    private function a2s($array){
        foreach ($array as $col => $value) {
            $tmp[] = "`$col`='$value'";
        }
        return $tmp;
    }

    private function sql_all($sql,$array,$other){

        if (isset($this->table) && !empty($this->table)) {
    
            if (is_array($array)) {
    
                if (!empty($array)) {
                    $tmp = $this->a2s($array);
                    $sql .= " where " . join(" && ", $tmp);
                }
            } else {
                $sql .= " $array";
            }
    
            $sql .= $other;
            // echo 'all=>'.$sql;
            // $rows = $this->pdo->query($sql)->fetchColumn();
            return $sql;
        } 
    }

}

function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
function to($url){
    header("location:$url");
}

$Title=new DB('titles');
$Total=new DB('total');
$Bottom=new DB('bottom');
$Ad=new DB('ad');
$Mvim=new DB('mvim');
$Image=new DB('image');
$News=new DB('news');
$Admin=new DB('admin');
$Menu=new DB('menu');

if(isset($_GET['do'])){
    if(isset(${ucfirst($_GET['do'])})){
        $DB=${ucfirst($_GET['do'])};
    }
}else{
    $DB=$Title;
}

if(!isset($_SESSION['visited'])){
    $Total->q("update `total` set `total`=`total`+1 where `id`=1");
    $_SESSION['visited']=1;
    // 不是很懂
}

// 為什麼要寫這段是因為發生在index要登入到login時,會有warning訊息
// 所以要保證即使亂打 進哪個頁面都可以正常顯示(不會有錯誤訊息)
// 就是將此專案所有變數都納入考量
//解決db.php中當$_GET['do']的值不為已宣告的資料表變數的問題
//首先檢查是否存在名為 'do' 的 GET 參數。
//如果存在 'do' 參數，則檢查是否存在一個與 $_GET['do'] 相同名稱（首字母大寫）的變數。
//如果存在對應的變數，則將 $DB 設定為該變數。
//如果 'do' 參數不存在，則將 $DB 設定為 $Title 變數的值。
//這段程式碼的目的是根據 GET 參數 'do' 的值，動態地設定變數 $DB 的值，以便後續程式中使用。

//第一種作法
// $tables=array_keys(get_defined_vars());
// // dd($tables);
// // 這支程式是在判別專案裡面所建的所有變數然後使用array_keys把這些變數變成陣列
// if(isset($_GET['do'])){
//     $key=ucfirst($_GET['do']);
//     if(in_array($key,$tables)){
//         $DB=$$key;
//     }
// }else{
//     $DB=$Title;
// }
// 在這邊把資料表存成變數$DB, 然後先include在相關程式先, 解決大量重複問題, 有點像是全域變數
// 不會跟api/edit.php 使用的$DB打架 因為程序導入這個為先, 後edit.php使用$table=$_POST['table']

?>