<?php include "nav.php" ?>




<div class="page-content">
<div class="row-col">
    <div class="col-lg-9 b-r no-border-md">
		
		<form class='form-group' style="max-width: 90% ;margin-top: 80px; margin-left: 1rem" action='' method='post' enctype='multipart/form-data'>
		  
		   <input class="form-control" style="margin-bottom: .5rem" type=text size='60' name='tag' placeholder="Enter keyword to search..." required="true" />
		 
		   <input type='submit' class="btn btn-outline b-black text-black" name='search' value='Search' />

		</form>
        
        <div class="padding">

            <div id="tracks" class="row item-list item-list-xs item-list-li m-b">
                <div class="col-xs-12">

<?php
  if (isset($_POST['search'])) {
      if (isset($_POST['tag'])) {
      	$tag = $_POST['tag'];
      	$query = "SELECT * FROM music WHERE name LIKE '%$tag%'";
      };
	  
	  $search_query = mysqli_query($connection, $query);
      
      if (!$search_query) {
        echo "Sorry, Something went wrong";;
      }

      $count = mysqli_num_rows($search_query);

            if ($count == 0){
                echo "<h4> No Result</h4><p>Please try another keyword</p>";
          	}else{

          	echo "<h5 style='margin-right:.3rem;'><b>" . mysqli_num_rows($search_query) . " Result(s)</b></h5>";

            while ($row= mysqli_fetch_assoc($search_query)) {
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



<?php }}} ?>

</div>
</div>
</div>




<?php include "footer.php" ?>