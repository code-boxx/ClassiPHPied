<?php
class Images extends Core {
  // (A) GET ALL IMAGES IN UPLOADS FOLDER
  //  $page : optional page number
  function getAll ($page=1, $search="") {
    // (A1) IMAGES & PAGINATION
    if ($search != "") { $search = "*$search"; }
    $iterator = new ArrayObject(glob(PATH_UPLOADS . "$search*.{jpg,jpeg,gif,png,bmp,webp}", GLOB_BRACE));
    $iterator = $iterator->getIterator();
    $this->Core->paginator($iterator->count(), $page);
    $iterator = new LimitIterator($iterator, $this->Core->page["x"], $this->Core->page["y"]);

    // (A2) BASENAME ONLY
    $images = [];
    foreach ($iterator as $i) { $images[] = basename($i); }
    return $images;
  }

  // (B) UPLOAD FILE
  function upload () {
    // (B1) FILE "SETTINGS"
    $source = $_FILES["upfile"]["tmp_name"];
    $destination = PATH_UPLOADS . $_FILES["upfile"]["name"];
    $ext = strtolower(pathinfo($_FILES["upfile"]["name"], PATHINFO_EXTENSION));

    // (B2) FILE TYPE CHECK
    if (!in_array($ext, ["jpg", "jpeg", "webp", "gif", "png"])) {
      $this->error = "'$ext' file is not allowed.";
      return false;
    }

    // (B3) PROCEED UPLOAD
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