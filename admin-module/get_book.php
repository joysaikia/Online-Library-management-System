<?php 
require_once("includes/config.php");
if(!empty($_POST["bookid"])) {
  $bookid=$_POST["bookid"];
 
    $sql ="SELECT distinct tbl_bookdetails.BOOK_TITLE,tbl_bookdetails.BOOK_ID,tbl_authors.AUTHOR_NAME,tbl_bookdetails.BOOK_IMG,tbl_bookmaster.BOOK_STATUS FROM tbl_bookdetails
    join tbl_authors on tbl_authors.AUTHOR_ID=tbl_bookdetails.BOOK_AUTHOR_ID join tbl_bookmaster on tbl_bookmaster.BOOK_ID=tbl_bookdetails.BOOK_ID
         WHERE (ISBN=:bookid || BOOK_TITLE like '%$bookid%')";
$query= $dbh -> prepare($sql);
$query-> bindParam(':bookid', $bookid, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0){
?>
<table border ="1">

  <tr>
<?php foreach ($results as $result) {?>
    <th style="padding-left:5%; width: 10%;">
<img src="bookimg/<?php echo htmlentities($result->BOOK_IMG); ?>" width="120"><br />
      <?php echo htmlentities($result->BOOK_TITLE); ?><br />
    <?php echo htmlentities($result->AUTHOR_NAME); ?><br />
    <?php if($result->BOOK_STATUS=='1'): ?>
<p style="color:red;">Book Already issued</p>
<?php else:?>
<input type="radio" name="bookid" value="<?php echo htmlentities($result->BOOK_ID); ?>" required>
<?php endif;?>
  </th>
    <?php  echo "<script>$('#submit').prop('disabled',false);</script>";
}
?>
  </tr>

</table>
</div>
</div>

<?php  
}else{?>
<p>Record not found. Please try again.</p>
<?php
 echo "<script>$('#submit').prop('disabled',true);</script>";
}
}
?>
