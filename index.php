<?php

  public class DatabaseManager {
    $deletePhotosQuery = "DELETE FROM photos WHERE id = ?";
    $addPhotosQuery = "INSERT INTO photos (albumid, filepath) VALUES (?, ?)";
    $getPhotosQuery = "SELECT filepath FROM photos WHERE albumid = ?";
  }
?>
