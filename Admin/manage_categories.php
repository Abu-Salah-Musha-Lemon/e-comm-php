<?php include_once 'top.inc.php';
include_once 'connection.inc.php';
$categories = '';
$msg = '';

if (isset($_GET['id']) && $_GET['id'] != '') {
	$id = get_safe_value($conn, $_GET['id']);
	$result = mysqli_query($conn, "SELECT * FROM  categories where id = '$id'");
	$check = mysqli_num_rows($result);
	if ($check > 0) {
		$row = mysqli_fetch_assoc($result);
		$categories = $row['categories'];
	} else {
		header('location:categories.php');
		die();
	}
}
if (isset($_POST['submit'])) {
	$categories = get_safe_value($conn, $_POST['categories']);
	$result = mysqli_query($conn, "SELECT * FROM  categories where categories = '$categories'");
	$check = mysqli_num_rows($result);
	if ($check > 0) {
		if (isset($_GET['id']) && $_GET['id'] != '') {
			$getData = mysqli_fetch_assoc($result);
			if ($id == $getData['id']) {
			} else {
				$msg = "categories already exist";
			}
		} else {
			$msg = "categories already exist";
		}
		if ($msg == '') {
			if (isset($_GET['id']) && $_GET['id'] != '') {
				mysqli_query($conn, "UPDATE categories set categories = '$categories' Where id ='$id'");
			} else {
				mysqli_query($conn, "INSERT INTO categories(categories, status) VALUES ('$categories','1')");
			}
			header('location:categories.php');
			die();
		}
	}
}




?>

<div class="content pb-0">
	<div class="animated fadeIn">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header"><strong>Categories</strong><small> Form</small></div>
					<form action="" method="post">
						<div class="card-body card-block">
							<div class="form-group">
								<label for="categories" class=" form-control-label">Categories</label>
								<input type="text" name="categories" placeholder="Enter your Categories name" class="form-control" value="<?php echo $categories ?>">
							</div>
							<button id="payment-button" type="submit" name="submit" class="btn btn-lg btn-info btn-block">
								<span id="payment-button-amount">Submit</span>
							</button>
							<div style="color: red;"><?php echo $msg ?></div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include_once 'footer.inc.php'; ?>