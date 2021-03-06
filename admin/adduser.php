<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php 
    if (session::get('userRole') != '0') { 

         echo "<script>window.location = 'index.php';</script>";
    }
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New User</h2>
               <div class="block copyblock"> 
               <?php 
               if(isset($_POST['submit'])){
                $username = $format->validation($_POST['username']);
                $userpassword = $format->validation(md5($_POST['userpassword']));
                $email     = $format->validation($_POST['email']);
                $role     = $format->validation($_POST['role']);

                $username = mysqli_real_escape_string($db->link,$username);
                $userpassword = mysqli_real_escape_string($db->link,$userpassword);
                $email     = mysqli_real_escape_string($db->link,$email);
                $role     = mysqli_real_escape_string($db->link,$role);

                if (empty($username) || empty($userpassword) || empty($role) || empty($email)) {
                   echo "<span class = 'error'>Field must not be empty !!.</span>";
                }else{

                $mailquery = "SELECT * FROM table_user WHERE email ='$email' LIMIT 1";
                $mailcheck = $db->select($mailquery);

                if ($mailcheck != false) {
                    echo "<span class = 'error'>Email Already Exists!!</span>";
                }

                else{

                    $query = "INSERT INTO table_user(username,userpassword,email,role) VALUES('$username','$userpassword','$email','$role')";
                    $userinsert = $db->insert($query);
                    if ($userinsert) {
                        echo "<span class = 'success'>User Created successfully !!.</span>";
                    }else{
                        echo "<span class = 'error'>User not Created !!.</span>";
                    }
                }
            }
        }

        ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                        <td>
                            <label>Username</label>
                        </td>
                            <td>
                                <input type="text" name="username" placeholder="Enter UserName..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                        <td>
                            <label>Password</label>
                        </td>
                            <td>
                                <input type="password" name="userpassword" placeholder="Enter Password..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                        <td>
                            <label>Email</label>
                        </td>
                            <td>
                                <input type="email" name="email" placeholder="Enter valid email..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                        <td>
                            <label>User Role</label>
                        </td>
                            <td>
                                <select id="select" name="role">
                                    <option>Select User Role</option>
                                    <option value="0">Admin</option>
                                    <option value="1">Author</option>
                                    <option value="2">Editor</option>
                                </select>
                            </td>
                        </tr>
						<tr> 
                        <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Create" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php'; ?>