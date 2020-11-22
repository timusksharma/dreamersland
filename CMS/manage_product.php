<html>
<head>
<title></title>
<link rel="stylesheet" href="../bootstrap/css/bootstrap3.min.css">
<script src="../bootstrap/js/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap3.min.js"></script>
<link rel="stylesheet" href="./css/style.css">
<script src="./js/manage.js"></script>
</head>
<body>
<?php
include_once("./templates/header.php");
?>
<br/><br/>

<div class="container-fluid">
<table class="table table-hover table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Product</th>
      <th scope="col">Category</th>
	  <th scope="col">Brand</th>
	  <th scope="col">Price</th>
	  <th scope="col">Stock</th>
	  <th scope="col">Added Date</th>
	  <th scope="col">Status</th>
	  <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody id="get_product">
   <!-- <tr>
      <th scope="row">1</th>
      <td>Electronics</td>
      <td>Root</td>
	  <td><a href="#" class="btn btn-success btn-sm">Active</a>
	  </td>
	  <td><a href="#" class="btn btn-info btn-sm">Edit</a>
	  <a href="#" class="btn btn-danger btn-sm">Delete</a>
	  </td>
    </tr>-->
  </tbody>
</table>
 </div>



<?php
include_once("./templates/update_products.php");
?>

</body>

</html>