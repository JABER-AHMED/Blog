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

if (!isset($_GET['sliderid']) || $_GET['sliderid'] == NULL) {
    echo "<script>window.location = 'sliderlist.php';</script>";
    //header("Location:catlist.php");
}else{
    $sliderid = $_GET['sliderid'];

    $query = "SELECT * FROM table_slider WHERE id = '$sliderid'";
    $getslider = $db->select($query);
    if ($getslider) {
    	while ($delslider = $getslider->fetch_assoc()) {
    		$dellink = $delslider['image'];
    		unlink($dellink); // delete image from folder.
    	}
    }
    $delquery = "DELETE FROM table_slider WHERE id = '$sliderid'";
    $delslider = $db->delete($delquery);
    if ($delslider) {
    	echo "<script>alert('Slider deleted successfully.')</script>";
    	echo "<script>window.location = 'sliderlist.php';</script>";
    }
    else{
    	echo "<script>alert('Slider Not deleted successfully.')</script>";
    	echo "<script>window.location = 'sliderlist.php';</script>";
    }
}
?>