<?php
$Items = simplexml_load_file('product.xml');

if(isset($_POST['submitSave'])) {

	foreach($Items->Item as $Item){
		if($Item['ean']==$_POST['ean']){
			$Item->name = $_POST['name'];
			$Item->code = $_POST['code'];
			break;
		}
	}
	file_put_contents('product.xml', $Items->asXML());
	header('location:index.php');
}

foreach($Items->Item as $Item){
	if($Item['id']==$_GET['id']){
		$ean = $Item->ean;
		$name = $Item->name;
		$price = $Item->code;
		break;
	}
}

?>

<form method="post">
	<table cellpadding="2" cellspacing="2">
		<tr>
			<td>Id</td>
			<td><input type="text" name="id" value="<?php echo $ean; ?>" readonly="readonly"></td>
		</tr>
		<tr>
			<td>Name</td>
			<td><input type="text" name="name" value="<?php echo $name; ?>"></td>
		</tr>
		<tr>
			<td>price</td>
			<td><input type="text" name="code" value="<?php echo $price; ?>"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" value="Save" name="submitSave"></td>
		</tr>
	</table>
</form>
