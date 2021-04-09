<?php include "nav.php" ?>



<?php 
  if (isset($_GET['album_id'])) {
    $id = $_GET['album_id'];  
    $query = "SELECT * FROM albums WHERE id = $id";
      $select_query = mysqli_query($connection, $query);

      if ($select_query) {
        while ($row= mysqli_fetch_assoc($select_query)) {
            $name = $row['name'];
            $artist = $row['artist'];
            $cover = $row['cover'];
            $no_of_tracks = $row['no_of_tracks'];
            $genre = $row['genre'];
            $description = $row['description'];
        
?>


<?php
if (isset($_POST['upload'])) {

 $allowedExts = array("mp3", "jpeg", "jpg", "png");
 $temp = explode(".", $_FILES["file"]["name"]);
 $extension = end($temp);

 echo $_FILES["file"]["type"];

 if ((($_FILES["file"]["type"] == "audio/mp3")
    || ($_FILES["file"]["type"] == "audio/mpeg")
        || ($_FILES["file"]["type"] == "image/jpeg")
        || ($_FILES["file"]["type"] == "image/jpg")
        || ($_FILES["file"]["type"] == "image/pjpeg")
        || ($_FILES["file"]["type"] == "image/x-png")
        || ($_FILES["file"]["type"] == "image/png"))
        && in_array($extension, $allowedExts))
{
   if ($_FILES["file"]["error"] > 0)
   {
      echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
   }
   else
   {
      echo "Upload: " . $_FILES["file"]["name"] . "<br>";
      echo "Type: " . $_FILES["file"]["type"] . "<br>";
      echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
      echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

      if (!is_dir('uploads'))
      {
    mkdir('uploads', 0777, true);
    }

      if (file_exists("uploads/songs" . $_FILES["file"]["name"]))
      {
         echo $_FILES["file"]["name"] . " already exists. ";
      }
      else
      {
        if (!is_dir('uploads/songs'))
          {
        mkdir('uploads/songs', 0777, true);
        }

        $file = $_FILES["file"]["tmp_name"];
        $filename = $_FILES["file"]["name"];
        $songname = $_POST["song_name"];
        $size = $_FILES["file"]["size"]/1024;
          $destination = "uploads/songs/" . $_FILES["file"]["name"];
          
          if (move_uploaded_file($file, $destination)) {
            $query = "INSERT into music (album_id, name, file_name, size, downloads) VALUES ($id ,'$songname', '$filename', $size, 0)";
            if (mysqli_query($connection, $query)) {
                echo "Stored in: " . "uploads/songs/" . $_FILES["file"]["name"];
            }else{
              echo "failed to upload file" . mysqli_error($connection) ;
            }
          }
      }

      
   }
}
else
{
    echo "Invalid file";
}

}
?>





<?php
 if (isset($_SESSION['username']) && $_SESSION['username']=='admin')
        { 
?>
      <form class='form-group' style="margin-top: 50px; margin-left: 1rem; max-width: 80%;" action='' method='post' enctype='multipart/form-data'>
         <b>Add song to album</b>
         <br />
         <input type=text class="form-control" size='60' name='song_name' />
         <br />
         <input name='file' class="form-control" type="file" id="file"  />
         <br /> 
         <input class="btn btn-outline b-black text-black" type='submit' name='upload' value='Add Soundclip' />
      </form>

<?php } ?>

<?php 
    function count_tracks($id, $connection){
      $query = "SELECT * FROM music WHERE album_id = $id ";
      $select_query = mysqli_query($connection, $query);

      if ($select_query) {
        echo mysqli_num_rows($select_query);
      }
    }
  
?>

<div class="pos-rlt">
<div class="page-bg" data-stellar-ratio="2" style="background-image: url('images/b0.jpg')"></div>
</div>
<div class="page-content">
<div class="padding b-b">
    <div class="row-col"  style="margin-top: 50px;">
        <div class="col-sm w w-auto-xs m-b">
            <div class="item w r">
                <div class="item-media">
                    <div class="item-media-content" style="background-image: url(<?php echo 'uploads/images/' . $cover ; ?>)">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="p-l-md no-padding-xs">
                <div class="page-title">
                    <h1 class="inline"><?php echo $name ?></h1>
                </div>
                <p class="item-desc text-ellipsis text-muted" data-ui-toggle-class="text-ellipsis">
                    <?php echo $description ?></p>

                <div class="item-meta"><a class="btn btn-xs rounded white"><?php echo $genre ?></a></div>
            </div>
        </div>
    </div>
</div>

<div class="row-col">
    <div class="col-lg-9 b-r no-border-md">
        <div class="padding">
            <h6 class="m-b"><span class="text-muted">by</span> <a href="#"
                    data-pjax class="item-author _600"> <?php echo $artist; ?> </a> <span
                    class="text-muted text-sm">- <?php count_tracks($id, $connection); ?> song(s)</span></h6>
            <div id="tracks" class="row item-list item-list-xs item-list-li m-b">
                <div class="col-xs-12">
                
                <?php 
                    $query = "SELECT * FROM music WHERE album_id = $id";
                    $select_query = mysqli_query($connection, $query);

                    if ($select_query) {
                      while ($row= mysqli_fetch_assoc($select_query)) {
                          $name = $row['name'];
                          $size = $row['size'];
                          $song_id = $row['id'];
                ?>
                    <div class="item r" data-id="item-10">
                        <div class="item-info">
                            <div class="item-title text-ellipsis"> <a href="download.php?file_id=<?php echo $song_id ?>"><?php echo $name ?> </a></div>
                            <div class="item-meta text-sm text-muted"> <span class="item-meta-right"><a ><?php echo round($size/1024,1) ?> MB</a></span> </div>
                        </div>
                    </div>

                <?php } 
         } ?> 

<?php } 
         }
            } ?> 



<?php include "footer.php" ?>