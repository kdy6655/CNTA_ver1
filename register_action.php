<?php
$connect = mysqli_connect('localhost', 'root', '', 'db_board') or die("connect failed");

$id = $_POST['id'];
$pw = $_POST['pw'];

$date = date('Y-m-d H:i:s');

//id 중복 확인
$query1 = "select * from member where id='$id'";
$result1 = $connect->query($query1);
$count = mysqli_num_rows($result1);

if ($count) {      //만약 중복된 id가 있다면
?><script>
        alert('이미 존재하는 ID입니다.');
        history.back();
    </script>
    <?php } else {  //없다면
    //입력받은 데이터를 DB에 저장
    $query = "insert into member(id, password, date, permit) values('$id', '$pw', '$date', 0)";

    $result = $connect->query($query);

    //저장이 되었다면 (result = true) 가입 완료
    if ($result) {
    ?> <script>
            alert('회원가입에 성공하였습니다.');
            location.replace("./login.php");
        </script>

    <?php } else {
    ?> <script>
            alert("회원가입에 실패하였습니다.");
        </script>
<?php }
}
mysqli_close($connect);
?>