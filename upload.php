<?php include "nav.php" ?>

<?php 
  if (isset($_GET['login']))  {
      echo "<div style='margin-top: 30px;' class='alert alert-success'>Login Successful</div>";
    }
  
?>

<?php



if (isset($_SESSION['username']) && $_SESSION['username']=='admin') {


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
          echo "<div style='margin-top: 30px;' class='alert alert-success'>Uploaded Successfully</div>";

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
    	        	$query = "INSERT into music (name, file_name, size, downloads) VALUES ('$songname', '$filename', $size, 0)";
    	        	if (mysqli_query($connection, $query)) {
    	        	    echo "Stored in: " . "uploads" . $_FILES["file"]["name"];
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



    <form class='form-group' style="max-width: 80% ;margin-top: 60px; margin-left: 1rem" action='' method='post' enctype='multipart/form-data'>
       <input type="hidden" name="id" value="<?php echo $pid; ?>"/> 
       
       <br /> 
       
       <b>Song Title</b>
       <br />
       <input class="form-control" type=text size='60' name='song_name' />
       <br />
       <input class="form-control" name='file' type="file" id="file"  />
       <br /> 
       <input type='submit' class="btn btn-outline b-black text-black" name='upload' value='Add Soundclip' />
    </form>
<?php } ?>

<div class="pos-rlt">
<div class="page-bg" data-stellar-ratio="2" style="background-image: url('images/b0.jpg')"></div>
</div>
<div class="page-content">
<div class="row-col">
    <div class="col-lg-9 b-r no-border-md">
    <h1 style="margin-left: 15px; margin-top: 4rem">Latest Songs</h1>
        <div class="padding">

            <div id="tracks" class="row item-list item-list-xs item-list-li m-b">
                <div class="col-xs-12">
                

<?php
      $query = "SELECT * FROM music";
      $select_query = mysqli_query($connection, $query);

      if ($select_query) {
        while ($row= mysqli_fetch_assoc($select_query)) {
            $id = $row['id'];
            $name = $row['name'];
            $size = $row['size'];
            $downloads = $row['downloads'];
        
?>
	
	<div class="item r" data-id="item-10">
	    <div class="item-info">
	        <div class="item-title text-ellipsis"> <a href="download.php?file_id=<?php echo $id ?>"><?php echo $name ?> </a></div>
	        <div class="item-meta text-sm text-muted"> <span class="item-meta-right"><a ><?php echo floor($size/1024) ?> MB</a></span> </div>
	    </div>
	</div>



<?php }} ?>



<?php include "footer.php" ?>