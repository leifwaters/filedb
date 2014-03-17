<div id="pagetitle">
    	<div class="wrapper">
			<h1>User List</h1>
		</div>
	</div>
	<!-- End of Page title -->
	
	<!-- Page content -->
	<div id="page">
		<!-- Wrapper -->
		<div class="wrapper">
				<!-- Left column/section -->
				<section class="column width8 first">
					
					<table class="display stylized" id="paths">
						<thead>
							<tr>
                            	<th>User ID</th>
                                <th>Full Name</th>
								<th>Notes</th>
								<th>User Type</th>
                                <th>Edit</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>
                        	<?php
							$dbh = new PDO('mysql:host=localhost;dbname=filedb', 'root', '');
                         	$sql = 'SELECT id, uid, fullName, notes, level FROM users ORDER BY id';
                         	try {
                            	$stmt = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                            	$stmt->execute();
                            	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
								
								if($row['uid'] != 'God') :
								?>
                            	<tr id="<?php echo $row['id']; ?>">
									<td><?php echo $row['uid']; ?></td>
									<td><?php echo $row['fullName']; ?></td>
									<td><?php echo $row['notes']; ?></td>
									<td><?php if($row['level'] == 1) { echo 'McClellan'; } elseif($row['level'] == 2) { echo 'General User'; } elseif($row['level'] == 9) { echo 'Master'; } else { echo 'Admin'; } ?></td>
                                    <td><a href="/user-settings/edit-user.php?uid=<?php echo $row['uid']; ?>">Edit</a></td>
                                	<td><a class="delete" id="<?php echo $row['id']; ?>">Delete</a></td>
								</tr>
                                <?php    
                            	endif;
								}
                            	$stmt = null;
                          	}
                          	catch (PDOException $e) {
                            	print $e->getMessage();
                          	}
                            ?>
							
						</tbody>
						<tfoot>
							<tr>
								<th>User ID</th>
                                <th>Full Name</th>
								<th>Notes</th>
								<th>User Type</th>
                                <th>Edit</th>
								<th>Delete</th>
							</tr>
						</tfoot>
					</table>
					
					<div class="clear">&nbsp;</div>
					
				</section>
				<!-- End of Left column/section -->
		</div>
		<!-- End of Wrapper -->
	</div>
	<!-- End of Page content -->