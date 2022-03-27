<?php
$uri=$_SERVER["REQUEST_URI"];
$q=$_REQUEST['q'];
if ($q[0]==='/') $q=substr($q,1);
$q=explode('/',$q,3);

$lll=$l=$q[0];
$ll=$l= $lll==='zh'?($_REQUEST['zh']==='t'?1:0):($lll==='jp'?2:3);
if ($l===3&&$q[0]!=='en') {
    http_response_code(404);
    $q[0]='en';
    $q[1]='404';
    $uri='/en';
}
if ($l===1) {
    $l=0;
    $zht="?zh=t";
}
$uri2=substr($uri,3);

$TITLE=['少女躁狂妄想',null,'とある躁うつ少女の妄想',"The Delusions of a Young Girl"][$l];
$TOC=[
    'story'=>['原案','原案','原案','Story'],
    'more'=>['补充设定','補充設定','補足設定','More Settings'],
    'br1'=>[],
    'github'=>['GitHub','GitHub','GitHub','GitHub'],
    'art'=>['概念艺术','概念藝術','コンセプトアート','Concept Art'],
    'game'=>['游戏','遊戲','ゲーム','Game'],
    'br2'=>[],
    'snowy'=>['关于Snowy','關於Snowy','Snowyプロフィール','About Snowy'],
    'contact'=>['联系Snowy','聯繫Snowy','お問い合わせ','Contact']
];
if (!$q[1]&&$q[1]!=='0') $q[1]='homepage';
else if (!$TOC[$q[1]]) {
    http_response_code(404);
    $q[1]='404';
    $uri2='';
}
?>

<!DOCTYPE html>
<html lang="<?php echo ['zh-cn','zh-tw','jp','en'][$ll]; ?>">
    <head>
        <title><?php echo $TITLE; ?></title>
        <link href="/main.css" type="text/css" rel="stylesheet"/>
    </head>
    <body>
        <nav>
            <?php echo "<a href=\"/$lll\"><h1>$TITLE</h1></a>";?>
            <a href="/zh<?php echo $uri2; ?>">中文</a> <a href="/jp<?php echo $uri2; ?>">日本語</a> <a href="/en<?php echo $uri2; ?>">English</a><br>
            <?php
            if ($l===0) echo '<a href="'.parse_url($uri, PHP_URL_PATH).'">简</a> <a href="?zh=t">繁</a><br>';
            echo '<br>';
            foreach($TOC as $k=>$v) {
                if ($k==='br1'||$k==='br2') echo '<br>';
                else {
                    $_blank='target="_blank"';
                    switch($k) {
                        case 'github':$href='https://github.com/SnowyYANG/Delusions';break;
                        case 'contact':$href='mailto:snowyyang@outlook.com';break;
                        default:$href="/$lll/$k$zht";$_blank='';
                    }
                    echo "<a href=\"$href\" $_blank>$v[$ll]</a><br>";
                }
             } ?>
        </nav>
        <div class="mp">
            <main><?php require_once "pages/$q[1]$ll.php";?></main>
            <footer>©2013-2022 Snowy</footer>
        </div>
    </body>
</html>