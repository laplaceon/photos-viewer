<?php

$conn = new mysqli('127.0.0.1', 'root');
session_start();
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

mysqli_select_db($conn, "435proj");

function createAlbum() {
    $sql = "INSERT INTO album (username, size, name) VALUES ('" . $_SESSION['user_id'] . "', '6', '" . $_GET['name'] . "')";

    global $conn;

    if($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}

function addPhoto() {
    $sql = "INSERT INTO photo (album_key, path2photo) VALUES ('" . $_GET['album_key'] . "', '" . $_POST['data'] . "')";

    global $conn;
    
    if($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function deletePhoto() {
    $sql = "DELETE FROM photos WHERE id = " . $_GET['id'];
}

function getPhotos() {
    $sql = "SELECT id, path2photo FROM photo WHERE album_key = '" . $_GET['album_key'] . "'";

    global $conn;
    
    $result = $conn->query($sql);

    while($row = $result->fetch_assoc()) {
        echo '<div class="row"><div class="col"><a href="./photos.html?id=' . $row["id"] . '"><img src="' . $row["path2photo"] . '"></img></a></div></div>';
    }
}
    
function getAlbums() {
    $sql = "SELECT * FROM album where username = '" . $_SESSION['user_id'] . "'";
    
    global $conn;
    
    $result = $conn->query($sql);
    
    $i = 1;
    
    if($result === FALSE) {
        echo '';
        return true;
    }
    
    while($row = $result->fetch_assoc()) {
        echo '<div class="row"><div class="col"><a href="./photos.html?album_id=' . $row["album_key"] . '">' . $row["name"] . '</a></div></div>';
    }
}

$method = $_GET['method'];

if($method == 'createAlbum') {
    createAlbum();
} elseif($method == 'addPhoto') {
    addPhoto();
} elseif($method == 'deletePhoto') {
    deletePhoto();
} elseif($method == 'getPhotos') {
    getPhotos();
} elseif($method == 'getAlbums') {
    getAlbums();
}

?>
