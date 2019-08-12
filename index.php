<?php
//やりたいことを一つのオブジェクトにする考え
//現場では基本的にオブジェクトとインスタンスは使い分けずに呼んでいる

//クラスはオブジェクトを作るための設計図のこと ここではインスタンスとオブジェクトは同意とする
//オブジェクトにはプロパティという属性と実の動きのがある
//クラスという設計図を書き換えるだけでもとになるクラスからいろんなインスタンスが生成される
//インスタンスとは大きい変数のようなものでそれにたいしてメモリがとられる




//publicとかprotectedとか　
//constructorとは　関数　中身のプロパティ 
//インスタンス生成時に一度だけ呼ばれる関数 絶対publicが必要になる 引数が定義できる　
//$thisは自分自身のクラス　インスタンス化されたそれぞれ自身




//アクセス権とカプセル化　
//アクセス修飾子　クラス内のプロパティやメソッドにつけ、外からアクセスできる範囲を制限できる
//絶対につけなければいけないもの　つけなければ　publicとみなされる
// pirvateそのクラスから  protectedそのクラスとサブクラス　 publicガバガバ
//その値はしてしたカプセルつまりクラスからしかアクセスできないようにすること
// *実際のプロパティの操作はプロパティ操作のためのメソッドを用意し、
//*その外側からもアクセスできるようにするセッターメソッド、ゲッターメソッドがある




//オーバーライドとは
//クラスは設計図にしか過ぎないので、継承クラスにおいて、親クラスのメソッドを上書きさせる仕組み
//親クラスのメソッドのプロパティやらメソッドはいらなかったり、追加させたかったりする。
//それを殺したい場合とかに使用する
//--> 親クラスと同じ名前のクラスを作るだけでいい




//静的メンバとは　スタティックメンバ  インスタンスではなくクラス自体にくっついているものという理解をしておく
//前述のとおり、プロパティやメソッドへのアクセスはインスタンスを生成しなければできない
//しかしインスタンスを生成せずともアクセスが可能なメンバのこと
//メンバ変数とはオブジェクト指向での属性を定義したもの　クラスの中の変数のこと
//静的メンバでは、プロパティでのメソッドを定義したときにメモリを食わない
//staticプロパティは定義したクラス自体にくっついているのでコピーされないということ
// *必ず静的メンバじゃパブリックにって
// public static プロパティ名
// public static メソッド名　になる
//呼び出すときは
//クラス外なら、クラス名::$プロパティ名　　クラス名::メソッド名()
//クラス内なら、self::$プロパティ名　　　self::メソッド名()




//クラス定数とは　
//defineをつかったグローバル定数と変わらないが、
//そのクラスにぞくしたプロパティの定数だ　という意味を明示させるもの
//主にクラスないの設定値として使う 呼び出しかたなどは静的メンバをだいたい同じ
//設定方法　const 定数名　= 値
//クラス外での呼び出し　クラス名::定数名
//クラス内での呼び出し self::定数名




//抽象クラス
//直接インスタンスを生成できないクラスのこと
//かならず継承して使用すること
//抽象クラスには抽象メソッドが定義できる
//抽象メソッドとは処理内容を持たず形だけで名前だけ定義されたメソッド　abstract public function sayCry()みたいな
//抽象クラスでは、継承先のクラスにたいして特定のメソッドの実装を強制することができる
//また、抽象クラスでは普通のプロパティやメソッドも定義することができる
//抽象クラスと抽象メソッドを付け加えれば、抽象クラスいがいのメソッドも利用できるクラスが出来上がる



//インターフェースとは
//クラスの一種。　中身は抽象クラスしか定義ができない
//抽象クラスでは普通のメソッドも定義することがでたが、インターフェースでは抽象メソッドしか定義できない
//書き方　
//interface kurasumei{
//    public function methodmei();  //abstractはいらない　アクセス修飾子にはpublicしか指定ができない
//}
//継承するとき
//class　継承クラス名　interfave1, interface2 ....　//このように多重継承ができる



//ポリモーフィズムと多態性
//異なる動作を同じ操作で実現させること
//phpの場合、クラスは異なっても同じ名前のメソッドでいろんな動きを実現させる事をいう
//それを理解するにはインターフェースが絡んでくる
//洗濯機のイメージ　ボタンを押す、という一つの動作をするだけで、どのボタンが押されたか判定し、それぞれの処理をしていく



//オブジェクト指向設計のコツ
//まずは先読みして設計図を作る
//おおもと設計図から、継承クラスをつくる
//実際にインスタンス(オブジェクト)を生成
//ただの関数を使って処理をしていく



ini_set('log_errors', 'on');
ini_set('error_log', 'php.log');
session_start();


$monsters = array();

class Sex {
    const MAN = 1;
    const WOMAN = 2;
    const OKAMA = 3; 
}

abstract class Creature{//継承させるために抽象クラス
    protected $name;
    protected $hp;
    protected $attackMin;
    protected $attackMax;
    //オーバーライドさせる！　同じ名前で継承先に！
    abstract public function sayCry();//抽象クラスのための抽象メソッド　継承先で内容は設定
    public function setName($str){
        $this->name = $str;
    }
    public function getName(){
       return $this->name;
    }
    public function setHp($num){
        $this->hp = $num;
    }
    public function getHp(){
        return $this->hp;
    }
    public function attack($targetObj){
        $attackPoint = mt_rand($this->attackMin, $this->attackMax);
        if(!mt_rand(0, 9)){
            $attackPoint = $attackPoint * 1.5;
            $attackPoint =  (int)$attackPoint;
        }
        $targetObj->setHp($targetObj->getHp() - $attackPoint);
    }
}

class Human extends Creature{
    protected $sex;//humanをもとに勇者を作るので、サブクラスにも適用させるためにprotected
    public function __construct($name, $sex, $hp, $attackMin, $attackMax){
        $this->name = $name;
        $this->sex = $sex;
        $this->hp = $hp;
        $this->attackMin = $attackMin;
        $this->attacnMax = $attackMax;
    }
    public function setSex($num){
        $this->ses = $num;
    }
    public function getSex(){
        return $this->sex;
    }
    public function sayCry(){
        switch($this->sex){
            case Sex::MAN:
                History::set('ぐはーー');
                break;
            case Sex::WOMAN:
                History::set('きゃっ！');
                break;
            case Sex::OKAMA:
                History::set('okama!');
                break;
        }
    }
}
class Monster extends Creature{
    protected $img; //魔法モンスターにも継承させるのでprotectedで
    public function __construct($name, $hp ,$img, $attackMin, $attackMax)
    {
        $this->name = $name;
        $this->hp = $hp;
        $this->img = $img;
        $this->attackMin = $attackMin;
        $this->attackMax = $attackMax;
    }
    public function getImg(){
        return $this->img;
    }
    public function sayCry(){
        History::set($this->name.'が叫ぶ');
        History::set('はうああ');
    }
}
class MagicMonster extends Monster{
    private $magicAttack;//これ以上継承しないのでprivateでカプセル化
    public function __construct($name, $hp, $img, $attackMin, $attackMax, $magicAttack)
    {  
        //一括で親コンストラクタから継承できる
        //全部継承しないといけないわけではなく　あまったものは個別で指定できる
        parent::__construct($name, $hp, $img, $attackMin, $attackMax);
        $this->magicAttack = $magicAttack;
    }
    public function attack($targetObj)
    {
        if(!mt_rand(0, 4)){
            History::set($this->name. 'の魔法攻撃！');
            $targetObj->setHp($targetObj->getHp() - $this->magicAttack);
            History::set($this->magicAttack.'ポイントのダメージを受けた');
        }else{
            //親クラスのattackメソッドを継承
            //この場合monsterクラスではなくcretureを継承している
            parent::attack($targetObj);
        }
    }
}
interface HistoryInterface{
    //中身は抽象クラスしか定義できない
    //アクセス修飾子はpublicのみ
    //抽象クラスなので抽象メソッドで定義していく 形だけのメソッド
    public function set();
    public function clear();
}
class History implements HistoryInterface{
    public static function set($str){ //静的メンバなのでclass::methiodで呼び起せる
        if(empty($_SESSION['history']))$_SESSION['history'] = '';
        $_SESSION['history'] .= $str. '<br>';
    }
    public static function clear(){
        unset($_SESSION['history']);
    }
}


$humann = new Human('勇者見習い', Sex::OKAMA, 500, 40, 120);
$monsters[] = new Monster('フランケン', 100, 'img/monsetr01,ong', 300, 20);
$monsters[] = new Monster('フランケン', 100, 'img/monsetr01,ong', 300, 20);
$monsters[] = new Monster('フランケン', 100, 'img/monsetr01,ong', 300, 20);
$monsters[] = new Monster('フランケン', 100, 'img/monsetr01,ong', 300, 20);
$monsters[] = new Monster('フランケン', 100, 'img/monsetr01,ong', 300, 20);


//ただのメソッド
function createMonster(){
    global $monsters;
    $monster = $monsters[mt_rand(0,7)];
    //
    $_SESSION['monster'] = $monster;
}
function createHuman(){
    global $human;
    $_SESSION['human'] = $human;
}
function init(){//
    History::clear();
    History::set('初期化します');
    $_SESSION['knockDownCount'] = 0;
    createHuman();
    createMonster();
}
function gameOver(){
    $_SESSION = array();
}



//ゲーム開始はスタートボタンのpostで
if(!empty($_POST)){
    $attackFlg = (!empty($_POST['attack']))? true : false;
    $startFlg = (!empty($_POST['start']))? true : false;
    if($strartFlg){
        init();
    }else{
         // 攻撃するを押した場合
    if($attackFlg){
      
        // モンスターに攻撃を与える
        History::set($_SESSION['human']->getName().'の攻撃！');
        $_SESSION['human']->attack($_SESSION['monster']);
        $_SESSION['monster']->sayCry();
        
        // モンスターが攻撃をする
        History::set($_SESSION['monster']->getName().'の攻撃！');
        $_SESSION['monster']->attack($_SESSION['human']);
        $_SESSION['human']->sayCry();
        
        // 自分のhpが0以下になったらゲームオーバー
        if($_SESSION['human']->getHp() <= 0){
          gameOver();
        }else{
          // hpが0以下になったら、別のモンスターを出現させる
          if($_SESSION['monster']->getHp() <= 0){
            History::set($_SESSION['monster']->getName().'を倒した！');
            createMonster();
            $_SESSION['knockDownCount'] = $_SESSION['knockDownCount']+1;
          }
        }
      }else{ //逃げるを押した場合
        History::set('逃げた！');
        createMonster();
      }
    }

}
?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ホームページのタイトル</title>
    <style>
    	body{
	    	margin: 0 auto;
	    	padding: 150px;
	    	width: 25%;
	    	background: #fbfbfa;
        color: white;
    	}
    	h1{ color: white; font-size: 20px; text-align: center;}
      h2{ color: white; font-size: 16px; text-align: center;}
    	form{
	    	overflow: hidden;
    	}
    	input[type="text"]{
    		color: #545454;
	    	height: 60px;
	    	width: 100%;
	    	padding: 5px 10px;
	    	font-size: 16px;
	    	display: block;
	    	margin-bottom: 10px;
	    	box-sizing: border-box;
    	}
      input[type="password"]{
    		color: #545454;
	    	height: 60px;
	    	width: 100%;
	    	padding: 5px 10px;
	    	font-size: 16px;
	    	display: block;
	    	margin-bottom: 10px;
	    	box-sizing: border-box;
    	}
    	input[type="submit"]{
	    	border: none;
	    	padding: 15px 30px;
	    	margin-bottom: 15px;
	    	background: black;
	    	color: white;
	    	float: right;
    	}
    	input[type="submit"]:hover{
	    	background: #3d3938;
	    	cursor: pointer;
    	}
    	a{
	    	color: #545454;
	    	display: block;
    	}
    	a:hover{
	    	text-decoration: none;
    	}
    </style>
  </head>
  <body>
   <h1 style="text-align:center; color:#333;">ゲーム「ドラ◯エ!!」</h1>
    <div style="background:black; padding:15px; position:relative;">
      <?php if(empty($_SESSION)){ ?>
        <h2 style="margin-top:60px;">GAME START ?</h2>
        <form method="post">
          <input type="submit" name="start" value="▶ゲームスタート">
        </form>
      <?php }else{ ?>
        <h2><?php echo $_SESSION['monster']->getName().'が現れた!!'; ?></h2>
        <div style="height: 150px;">
          <img src="<?php echo $_SESSION['monster']->getImg(); ?>" style="width:120px; height:auto; margin:40px auto 0 auto; display:block;">
        </div>
        <p style="font-size:14px; text-align:center;">モンスターのHP：<?php echo $_SESSION['monster']->getHp(); ?></p>
        <p>倒したモンスター数：<?php echo $_SESSION['knockDownCount']; ?></p>
        <p>勇者の残りHP：<?php echo $_SESSION['human']->getHp(); ?></p>
        <form method="post">
          <input type="submit" name="attack" value="▶攻撃する">
          <input type="submit" name="escape" value="▶逃げる">
          <input type="submit" name="start" value="▶ゲームリスタート">
        </form>
      <?php } ?>
      <div style="position:absolute; right:-350px; top:0; color:black; width: 300px;">
        <p><?php echo (!empty($_SESSION['history'])) ? $_SESSION['history'] : ''; ?></p>
      </div>
    </div>
    
  </body>
</html>