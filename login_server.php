<?php
session_start();
include('db.php');


if(isset($_POST['user_id'])  && isset($_POST['user_pass1']))
{
    //보안 강화
    $user_id = mysqli_real_escape_string($connect,$_POST['user_id']);
    $user_pass1 = mysqli_real_escape_string($connect,$_POST['user_pass1']);
    //에러 체크

    if(empty($user_id))
    {
        header("location: login_view.php?error=아이디가 비어있어요");
        exit();
    }
    else if(empty($user_pass1))
    {
        header("location: login_view.php?error=비밀번호가 비어있어요");
        exit();
    }

    else
    {
        $sql = "select * from member where mb_id = '$user_id'";
        $result = mysqli_query($connect,$sql);

        if(mysqli_num_rows($result) === 1)
        {
            $row = mysqli_fetch_assoc($result);
            $hash = $row['password'];

            if(password_verify($user_pass1, $hash))
            {
                $_SESSION['mb_id'] = $row['mb_id'];
                $_SESSION['mb_nick'] = $row['mb_nick'];
                $_SESSION['No'] = $row['No'];
                header("location: main.php");
                exit();
            }
            else
            {
                header("location: login_view.php?error=로그인에 실패하였습니다.");
                exit();
            }
        }
        else
        {
            header("location: login_view.php?error=아이디가 잘못 입력되었습니다.");
            exit();
        }
    }


}
else
{
    header("location: login_view.php?error=알수없는 오류가 발생하였습니다.");
    exit();
}

?>