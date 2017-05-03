		<div class="sidebar clear">
			<div class="samesidebar clear">
				<h2>Categories</h2>
					<ul>
					<!-- query for sidebar category -->
					<?php 

					$query = "SELECT * FROM table_category";
					$category = $db->select($query);
		 			if ($category) {
		 			while($result = $category->fetch_assoc()){
					?>
						<li><a href="posts.php?category=<?php echo $result['id'] ?>"><?php echo $result['name']; ?></a></li>	
						<?php } } else{ ?>

						<li>NO Category Created.</li>

						<?php } ?>			
					</ul>
			</div>
			
			<div class="samesidebar clear">
				<h2>Latest articles</h2>
				<!-- query for latest posts. -->
				<?php 
				$query = "SELECT * FROM table_post LIMIT 5";
				$post = $db->select($query);
		 		if ($post) {
		 		while($result = $post->fetch_assoc()){
				?>
					<div class="popular clear">
						<h3><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h3>
						<a href="post.php?id=<?php echo $result['id']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt="post image"/></a>
						<?php echo $format->textShorten($result['body'], 125); ?>
					</div>	
				<?php } } else { header("Location:404.php"); }?>
			</div>
			
		</div>