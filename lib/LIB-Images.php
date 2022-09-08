<?php
class Images extends Core {
  // (A) GET ALL IMAGES IN UPLOADS FOLDER
  //  $page : optional page number
  function getAll ($page=1) {
    // (A1) IMAGES & PAGINATION
    $images = glob(PATH_UPLOADS . "*.{jpg,jpeg,gif,png,bmp,webp}", GLOB_BRACE);
    $this->core->paginator(count($images), $page);
    
    // (A2) RESHUFFLE + BASENAME ONLY
    if ($this->core->page["entries"]!=0) {
      usort($images, function($file1, $file2) {
        return filemtime($file2) <=> filemtime($file1);
      });
      $images = array_slice($images, $this->core->page["x"], $this->core->page["y"]);
      foreach ($images as $k=>$i) { $images[$k] = basename($i); }
    }

    // (A3) RESULTS
    return $images;
  }

  // (B) UPLOAD FILE
  function upload () {
    $source = $_FILES["upfile"]["tmp_name"];
    $destination = PATH_UPLOADS . $_FILES["upfile"]["name"];
    if (move_uploaded_file($source, $destination)) { return true; }
    else {
      $this->error = "Error uploading to $destination.";
      return false;
    }
  }

  // (C) DELETE FILE
  //  $file : target file (in upload folder)
  function del ($file) {
    if (@unlink(PATH_UPLOADS . $file)) { return true; }
    else {
      $this->error = "Failed to delete $file.";
      return false;
    }
  }
}