<?php
	$connection = mysqli_connect('localhost', 'root', '', 'music_and_images');

if (isset($_GET['file_id'])) {
    $id = $_GET['file_id'];

    // fetch file to download from database
    $sql = "SELECT * FROM music WHERE id=$id";
    $result = mysqli_query($connection, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = 'uploads/songs/' . $file['file_name'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('uploads/songs/' . $file['file_name']));
        readfile('uploads/songs/' . $file['file_name']);

        // Now update downloads count
        $newCount = $file['downloads'] + 1;
        $updateQuery = "UPDATE music SET downloads=$newCount WHERE id=$id";
        mysqli_query($connection, $updateQuery);
        exit;
    }

}

?>