<?php

include $_SERVER['DOCUMENT_ROOT']."/practice/db2.php";

//각 변수에 write.php에서 input name값들을 저장한다
$username = $_POST['name'];
$userpw = password_hash($_POST['pw'], PASSWORD_DEFAULT);
$title = $_POST['title'];
$content = $_POST['content'];
$date = date('Y-m-d H:i:s');
if(isset($_POST['lock_post'])){
	$lock_post = "1";
}else{
	$lock_post = "0";
}
$tmpfile =  $_FILES['b_file']['tmp_name'];
$o_name = $_FILES['b_file']['name'];
$filename = iconv("UTF-8", "EUC-KR",$_FILES['b_file']['name']);
$folder = "../../upload/".$filename;
move_uploaded_file($tmpfile,$folder);

if($username && $userpw && $title && $content)
{
    $sql = mq("insert into board(name,pw,title,content,date,lock_post,file) values('".$_POST['name']."','".$userpw."','".$_POST['title']."','".$_POST['content']."','".$date."','".$lock_post."','".$o_name."')"); ?>
    <script type="text/javascript">alert("글쓰기 완료되었습니다.");</script>
    <meta http-equiv="refresh" content="0 url=index.php" />
<?php
}
else{
    echo "<script>
    alert('글쓰기에 실패했습니다.');
    history.back();</script>";
}
?>