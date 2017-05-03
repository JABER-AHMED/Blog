<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Inbox</h2>
        <div class="block">  
        <?php 

        if (isset($_GET['seenid'])) {
        	$seenid = $_GET['seenid'];

        	$query = "UPDATE table_contact
            SET
            status = '1'
            WHERE id = '$seenid'";
            $updated_row = $db->update($query);
            if ($updated_row) {
                echo "<span class = 'success'>Message send to the seen box !!.</span>";
            }else{
                echo "<span class = 'error'>Something wend Wrong !!.</span>";
            }
        }
        ?>    
        <?php 

        if (isset($_GET['unseenid'])) {
        	$unseenid = $_GET['unseenid'];

        	$query = "UPDATE table_contact
            SET
            status = '0'
            WHERE id = '$unseenid'";
            $updated_row = $db->update($query);
            if ($updated_row) {
                echo "<span class = 'success'>Message move to the seen box !!.</span>";
            }else{
                echo "<span class = 'error'>Something wend Wrong !!.</span>";
            }
        }
        ?>        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Name</th>
					<th>Email</th>
					<th>Message</th>
					<th>Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php 

			$query = "SELECT * FROM table_contact WHERE status = '0' ORDER BY id DESC";
			$msg = $db->select($query);
			if ($msg) {
				$i = 0;
				while($result = $msg->fetch_assoc()){
					$i++;
			?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['firstname'].' '.$result['lastname'] ?></td>
					<td><?php echo $result['email']; ?></td>
					<td><?php echo $format->textShorten($result['body'], 30); ?></td>
					<td><?php echo $format->formatDate($result['date']); ?></td>
					<td>
					<a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">View</a> ||
					<a href="replymsg.php?msgid=<?php echo $result['id']; ?>">Reply</a> ||
					<a onclick="return confirm('Are you sure to sent it to the seen box.')"; href="?seenid=<?php echo $result['id']; ?>">Seen</a>
					</td>
				</tr>
				<?php } } ?>
			</tbody>
		</table>
       </div>
    </div>
        <div class="box round first grid">
        <h2>Seen Message</h2>
          <?php 

                if (isset($_GET['delid'])) {
                	$delid = $_GET['delid'];

                	$query = "DELETE FROM table_contact WHERE id = '$delid'";
                	$deldata = $db->delete($query);

                	if($deldata){
                		echo "<span class = 'success'>Message deleted successfully!!</span>";
                	}else{
                		echo "<span class = 'error'>Message Not deleted.</span>";
                	}
                }

                ?> 
        <div class="block">        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Name</th>
					<th>Email</th>
					<th>Message</th>
					<th>Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php 

			$query = "SELECT * FROM table_contact WHERE status = '1' ORDER BY id DESC";
			$msg = $db->select($query);
			if ($msg) {
				$i = 0;
				while($result = $msg->fetch_assoc()){
					$i++;
			?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['firstname'].' '.$result['lastname'] ?></td>
					<td><?php echo $result['email']; ?></td>
					<td><?php echo $format->textShorten($result['body'], 30); ?></td>
					<td><?php echo $format->formatDate($result['date']); ?></td>
					<td>
					<a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">View</a> ||
					<a onclick="return confirm('Are you sure to delete it')"; href="?delid=<?php echo $result['id']; ?>">Delete</a> ||
					<a href="?unseenid=<?php echo $result['id']; ?>">Unseen</a>
					</td>
				</tr>
				<?php } } ?>
			</tbody>
		</table>
       </div>
    </div>
</div>
<script type="text/javascript">

  $(document).ready(function () {
    setupLeftMenu();

    $('.datatable').dataTable();
    setSidebarHeight();
 });
</script>
<?php include 'inc/footer.php'; ?>