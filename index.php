<?php
include "contact.class.php";

session_start();
$contact = new Contact();
$contact_list = $contact->read();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Contact Book</title>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
		<script src="https://code.jquery.com/jquery-1.12.4.min.js"
			  integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
			  crossorigin="anonymous"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
	</head>
	<body>
		<h3>Contact details</h3>
		<?php 
		if($_POST && !empty($_POST)){
			$name = htmlspecialchars($_POST['name']);
			$email = htmlspecialchars($_POST['email']);
			$tel_no = htmlspecialchars($_POST['tel_no']);
			$_SESSION['msg'] = $contact->create($name, $email, $tel_no);
			header("Location:index.php");
		} 
		if(isset($_SESSION['msg'])){
			echo '<pre>'.print_r($_SESSION['msg'], true).'</pre>';
		}
		?>
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
			Name: <input type="text" name="name"><br>
			Email: <input type="text" name="email"><br>
			Tel. no: <input type="text" name="tel_no"><br>
			<input type="submit" value="Submit">
		</form>
		<br>
		<table id="contacts" class="display" width="100" cellspacing="0">
			<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Tel. no.</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($contact_list as $detail) {
					echo '<tr>';
					echo '<td>'.$detail['name'].'</td>';
					echo '<td>'.$detail['email'].'</td>';
					echo '<td>'.$detail['tel_no'].'</td>';
					echo '</td>';
				}
				?>
			</tbody>
		</table>
	</body>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#contacts').DataTable();
		});
	</script>
</html>