<?php include_once 'top.inc.php';
include_once 'connection.inc.php';
// header('refresh:2');
$product = '';
$msg = '';
$name = '';
$image = '';
$mrp = '';
$price = '';
$qty = '';
$short_desc = '';
$desc = '';
$meta_title = '';
$meta_desc = '';
$meta_keyword = '';


if (isset($_GET['id']) && $_GET['id'] != '') {
	$id = get_safe_value($conn, $_GET['id']);
	$result = mysqli_query($conn, "SELECT * FROM  product where id = '$id'");
	$check = mysqli_num_rows($result);
	if ($check > 0) {
		$row = mysqli_fetch_assoc($result);
		$name = $row['name'];
		$mrp = $row['mrp'];
		$price = $row['price'];
		$qty = $row['qty'];
		$short_desc = $row['short_desc'];
		$desc = $row['decription'];
		$meta_title = $row['meta_title'];
		$meta_desc = $row['meta_desc'];
		$meta_keyword = $row['meta_keyword'];
	} else {
		header('location:product.php');
		die();
	}
}
// echo $result =  mysqli_query($conn,"SELECT*FROM product Where name = '$name'");
// $check = mysqli_num_rows($result);
if (isset($_POST['submit'])) {
	$name = get_safe_value($conn, $_POST['name']);
	$mrp = get_safe_value($conn, $_POST['mrp']);
	$price = get_safe_value($conn, $_POST['price']);
	$qty = get_safe_value($conn, $_POST['qty']);
	$short_desc = get_safe_value($conn, $_POST['short_desc']);
	$desc = get_safe_value($conn, $_POST['desc']);
	$meta_title = get_safe_value($conn, $_POST['meta_title']);
	$meta_desc = get_safe_value($conn, $_POST['meta_desc']);
	$meta_keyword = get_safe_value($conn, $_POST['meta_keyword']);

	$sql = "SELECT * FROM product Where `name` = '$name'";
	echo $result =  mysqli_query($conn,$sql );
	$check =  mysqli_fetch_assoc($result);
	if ($check > 0) {
		if (isset($_GET['id']) && $_GET['id'] != '') {
			$getData = mysqli_fetch_assoc($result);
			if ($id == $getData['id']) {
			} else {
				$msg = "product already exist";
			}
		} else {
			$msg = "product already exist";
		}
		if ($msg == '') {
			if (isset($_GET['id']) && $_GET['id'] != '') {
				echo mysqli_query($conn, "UPDATE `product` SET `categories_id`='$categories_id',`name`='$name',`mrp`='$mrp',`price`='$price',`qty`='$qty',`short_desc`='$short_desc',`decription`='$desc',`meta_title`='$meta_title',`meta_desc`='$meta_desc',`meta_keyword`='$meta_keyword' WHERE id = '$id'");
				die();
			} else {
				mysqli_query($conn, "INSERT INTO `product`( `categories_id`, `name`, `mrp`, `price`, `qty`, `short_desc`, `decription`, `meta_title`, `meta_desc`, `meta_keyword`, `status`) VALUES ('$categories_id','$name','$mrp','$qty','$short_desc','$desc','$meta_title','$meta_desc','$meta_keyword')");
			}
		}
		header('location:product.php');
		die();
	}
}




?>

<div class="content pb-0">
	<div class="animated fadeIn">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header"><strong>product</strong><small> Form</small></div>

					<form action="" method="post">
						<div class="card-body card-block">
							<div class="form-group">
								<label for="product" class=" form-control-label">Categories</label>
								<select name="categories_id" class="form-group">
									<option value="">Select Categories</option>
									<?php
									$result = mysqli_query($conn, "SELECT id,categories FROM categories order by categories desc ");
									while ($row = mysqli_fetch_assoc($result)) {
										echo '<option value="">' . $row["categories"] . '</option>';
									}
									?>
								</select>
								<div class="form-group">
									<label class=" form-control-label">Name</label>
									<input type="text" name="name" placeholder="Enter name" class="form-control" value="<?php echo $name ?>">
								</div>
								<?php ?>
								<div class="form-group">
									<label class=" form-control-label">Image</label>
									<input type="file" name="image" placeholder="Enter name" class="form-control" value="<?php echo $image ?>">
								</div>


								<div class="form-group">
									<label for="categories" class=" form-control-label">MRP</label>
									<input type="text" name="mrp" class="form-control" value="<?php echo $mrp ?>">
								</div>


								<div class="form-group">
									<label for="categories" class=" form-control-label">Price</label>
									<input type="text" name="price" class="form-control" value="<?php echo $price ?>">
								</div>


								<div class="form-group">
									<label for="categories" class=" form-control-label">qty</label>
									<input type="text" name="qty" class="form-control" value="<?php echo $qty ?>">
								</div>
								<div class="form-group">
									<label class=" form-control-label">Short Desc</label>
									<input type="text" name="short_desc" class="form-control" value="<?php echo $short_desc ?>">
								</div>

								<div class="form-group">
									<label class=" form-control-label">Desc</label>
									<input type="text" name="desc" class="form-control" value="<?php echo $desc ?>">
								</div>

								<div class="form-group">
									<label class=" form-control-label">Meta Title</label>
									<input type="text" name="meta_title" class="form-control" value="<?php echo $meta_title ?>">
								</div>

								<div class="form-group">
									<label class=" form-control-label">Meta Desc</label>
									<input type="text" name="meta_desc" class="form-control" value="<?php echo $meta_desc ?>">
								</div>

								<div class="form-group">
									<label class=" form-control-label">Meta keyword</label>
									<input type="text" name="meta_keyword" class="form-control" value="<?php echo $meta_keyword ?>">
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