<?php
/**
 * @var $conn mysqli
 */
include __DIR__ . '/db.php';


// Retrieving data from the server
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST['data'];

    // If the retrieved data is empty.
    if (empty($data)) {
        $msg = 'Clip is empty.';
        echo json_encode(['valid'=>0, 'error'=>$msg]);
    // If the retrieved data exceeds 1000 characters
    } elseif (strlen($data) > 1000) {
        $msg = 'Clip must not exceed 1000 characters.';
        echo json_encode(['valid'=>0, 'error'=>$msg]);
    // If the data satisfies the condictions,inserting data to database
    } else {
        $data = htmlspecialchars($data);
        $data = str_replace("\\","&#92;",$data);
        $data = str_replace("'","&#39;",$data);
        $pub_id = rand(1000,9999);
        $sql = "INSERT INTO clips (publicid,clip) VALUES ('$pub_id','$data')";

        // Displaying success message.
        if (mysqli_query($conn, $sql)) {
            $msg = 'Clip saved successfully. ID to retrive is : $pub_id.';
            echo json_encode(['valid'=>1, 'public_id'=>$pub_id]);
        } else {
            $msg = "Error: $sql<br>" . mysqli_error($conn);
            echo json_encode(['valid'=>0, 'error'=>$msg]);
        }
    }
}