<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Themes</h2>
               <div class="block copyblock"> 
               <?php 
               if(isset($_POST['submit'])){
                $theme = $_POST['theme'];
                $theme = mysqli_real_escape_string($db->link,$theme);
                    $query = "UPDATE table_theme
                    SET
                    theme = '$theme'
                    WHERE id = '1'";
                    $updated_row = $db->update($query);
                    if ($updated_row) {
                        echo "<span class = 'success'>Theme updated successfully !!.</span>";
                    }else{
                        echo "<span class = 'error'>Theme not updated !!.</span>";
                    }
                }

        ?>
        <?php 
        $query = "SELECT * FROM table_theme WHERE id = '1'";
        $themes = $db->select($query);
        while ($result = $themes->fetch_assoc()) {
        ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input <?php if ($result['theme'] == 'default') {echo "Checked";} ?> type="radio" name="theme" value="default" />Default
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input <?php if ($result['theme'] == 'purple') {echo "Checked";} ?> type="radio" name="theme" value="purple" />Purple
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input <?php if ($result['theme'] == 'green') {echo "Checked";} ?> type="radio" name="theme" value="green" />Green
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input <?php if ($result['theme'] == 'red') {echo "Checked";} ?> type="radio" name="theme" value="red" />Red
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Change" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php } ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php'; ?>