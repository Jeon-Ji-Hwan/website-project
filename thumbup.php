<?php
	include $_SERVER['DOCUMENT_ROOT']."/practice/db2.php";
   
	$bno = $_GET['idx'];
    $thumbup = mysqli_fetch_array($db -> query("select thumbup from board where idx='$bno';"));
    $thumbup = $thumbup['thumbup'] + 1;
    $db -> query("update board set thumbup=".$thumbup." where idx=".$bno.";");
    ?>
    <script type="text/javascript">alert("추천되었습니다.");</script>
    <meta http-equiv="refresh" content="0 url=/practice/index.php" />