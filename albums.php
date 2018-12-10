<?php

$conn = new mysqli('localhost', 'root');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

function createAlbum() {
    $sql = "INSERT INTO album (username, size, name) VALUES (" . $_GET['username'] . ", '0', " . $_GET['name'] . ")";

    if($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}

function addPhoto() {
    $sql = "INSERT INTO photos (albumkey, path2photo) VALUES (" . $_GET['album'] . ", " . $_GET['path'] . ")";

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
    $sql = "SELECT id, path2photo FROM photo WHERE albumid = " . $_GET['id'];

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"]. " - path: " . $row["path2photo"]. "<br>";
        }
    } else {
        echo "0 results";
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
} else {
    
}

?>