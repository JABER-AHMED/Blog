<?php include '../lib/session.php'; 
session::checkSession();
?>

<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>
<?php include '../helpers/Format.php'; ?>

<?php 

$db = new Database();

?>

<?php 

if (!isset($_GET['delpostid']) || $_GET['delpostid'] == NULL) {
    echo "<script>window.location = 'postlist.php';</script>";
    //header("Location:catlist.php");
}else{
    $postid = $_GET['delpostid'];

    $query = "SELECT * FROM table_post WHERE id = '$postid'";
    $getData = $db->select($query);
    if ($getData) {
    	while ($delimg = $getData->fetch_assoc()) {
    		$dellink = $delimg['image'];
    		unlink($dellink); // delete image from folder.
    	}
    }
    $delquery = "DELETE FROM table_post WHERE id = '$postid'";
    $delData = $db->delete($delquery);
    if ($delData) {
    	echo "<script>alert('Data deleted successfully.')</script>";
    	echo "<script>window.location = 'postlist.php';</script>";
    }
    else{
    	echo "<script>alert('Data Not deleted successfully.')</script>";
    	echo "<script>window.location = 'postlist.php';</script>";
    }
}
?>