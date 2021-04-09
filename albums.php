<?php include "nav.php" ?>

<?php if (isset($_SESSION['username']) && $_SESSION['username']=='admin')
         { 
?>
      <?php 
      	if (isset($_POST['upload'])) {
      		$name = $_POST['album_name'];
          $artist = $_POST['artist'];
          $genre = $_POST['genre'];
          $description = $_POST['description'];
          
          
          if (!is_dir('uploads'))
          {
            mkdir('uploads', 0777, true);
          }

          if (!is_dir('uploads/images'))
          {
            mkdir('uploads/images', 0777, true);
          }

          if (file_exists("uploads/images" . $_FILES["album_cover"]["name"]))
          {
             echo $_FILES["album_cover"]["name"] . " already exists. ";
          }
          else
          {
            

            $file = $_FILES["album_cover"]["tmp_name"];
            $filename = $_FILES["album_cover"]["name"];
            $destination = "uploads/images/" . $_FILES["album_cover"]["name"];
              
            if (move_uploaded_file($file, $destination)) {
              $query = "INSERT into albums (name, cover, artist ,no_of_tracks, genre, description) VALUES ('$name', '$filename', '$artist' , 0, '$genre', '$description')";
              if (mysqli_query($connection, $query)) {
                  echo "Stored in: " . "uploads/images/" . $_FILES["album_cover"]["name"];
              }else{
                echo "failed to upload file" . mysqli_error($connection) ;
              }
            }

      	 }
        }
      ?>


      <form style="max-width: 80%; margin-left: 1rem; margin-top: 40px !important;" class="" action='' method='post' enctype='multipart/form-data'>
      <br /> 
         <label>Album name</label>
         <input class="form-control" type=text name='album_name'  />
         
         <br />
         <label>Artist</label>
         <input class="form-control" type=text name='artist'  />
         
         <br />
         <label>Album Cover</label>
         <input class="form-control" type="file" name="album_cover" > 
         
         <br />
         <label>Genre</label>
         <input class="form-control" type="text" name="genre" > 
         
         <br />
         <label>Description</label>
         <input class="form-control" type="text" name="description" > 
         
         <br />
         <input class="btn btn-outline b-black text-black" type='submit' name='upload' value='Add Album' />
      </form>

<?php } ?>

<div class="app-body" id="view">
<div class="page-content">
<div class="row-col">
<div class="col-lg-9 b-r no-border-md">
    <div class="padding">
        <div class="page-title m-b">
            <h1 class="inline m-a-0">Browse</h1>
        </div>

<?php
      $query = "SELECT * FROM albums";
      $select_query = mysqli_query($connection, $query);

      if ($select_query) {
        while ($row= mysqli_fetch_assoc($select_query)) {
            $id = $row['id'];
            $name = $row['name'];
            $artist = $row['artist'];
            $cover = $row['cover'];
            $no_of_tracks = $row['no_of_tracks'];

        
?>


    <div class="col-xs-4 col-sm-4 col-md-3">
        <div class="item r" data-id="item-5">
            <div class="item-media"><a href="album.php?album_id=<?php echo $id ?>";"
                    class="item-media-content"
                    style="background-image: url(<?php echo 'uploads/images/' . $cover ; ?>)"></a>
            </div>
            <div class="item-info">
                <div class="item-overlay bottom text-right">
                </div>
                <div class="item-title text-ellipsis">
                    <a href="album.php?album_id=<?php echo $id; ?>"><?php echo $name; ?></a>
                </div>
                <div class="item-author text-sm text-ellipsis"><a 
                        class="text-muted"><?php echo $artist; ?></a></div>
            </div>
        </div>
    </div>

<?php }} ?>
</div>
</div>
</div>
</div>

<?php include "footer.php" ?>