<?php include 'nav.php' ?>
<div class="pos-rlt">
<div class="page-bg" data-stellar-ratio="2" style="background-image: url('images/b0.jpg')"></div>
</div>
<div class="page-content">
<div class="row-col">
    <div class="col-lg-9 b-r no-border-md">
    <h1 style="margin-left: 15px;">All Songs</h1>
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