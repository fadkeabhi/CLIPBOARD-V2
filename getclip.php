<?php
/**
 * @var $conn mysqli
 */
include __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']))
{
    $id = $_POST['id'];
    $sql = "SELECT clip, created_at FROM clips WHERE publicid = '$id' ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0)
    {
        //clip not found
        echo json_encode(['valid'=>0, 'error'=>'clip not found']);
    }
    else
    {
        $row = mysqli_fetch_assoc($result);
        echo json_encode(['valid'=>1, 'created_at'=>$row["created_at"], 'clip'=>$row["clip"]]);
    }
}