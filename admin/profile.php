<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php 

$userid = session::get('userid');
$userrole = session::get('userRole');


?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Profile</h2>

                <?php 

                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $name     = $_POST['name'];
                $username = $_POST['username'];
                $email    = $_POST['email'];
                $details  = $_POST['details'];

                $name     = mysqli_real_escape_string($db->link,$name);
                $username = mysqli_real_escape_string($db->link,$username);
                $email    = mysqli_real_escape_string($db->link,$email);
                $details  = mysqli_real_escape_string($db->link,$details);
                
                $query = "UPDATE table_user
                    SET
                    name = '$name',
                    username = '$username',
                    email = '$email',
                    details = '$details'
                    WHERE id = '$userid'";

                    $updated_rows = $db->update($query);
                    if ($updated_rows) {
                     echo "<span class='success'>User Data updated Successfully.
                     </span>";
                    }else {
                     echo "<span class='error'>User Data Not updated !</span>";
                    }
                }
                ?>
                <div class="block">
                <?php 

                $query = "SELECT * FROM table_user WHERE id = '$userid' AND role = '$userrole'";

                $getuser = $db->select($query);
                if ($getuser) {
                while ($result = $getuser->fetch_assoc()) {

                ?>               
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $result['name']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>UserName</label>
                            </td>
                            <td>
                                <input type="text" name="username" value="<?php echo $result['username']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" name="email" value="<?php echo $result['email']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Details</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="details">
                                    <?php echo $result['details']; ?>
                                </textarea>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php } } ?>
                </div>
            </div>
        </div>
<!-- Load TinyMCE -->
<!-- This script is for editor -->
    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>
<?php include 'inc/footer.php'; ?>
