<?php
if(isset($_GET['action'])) {
	$Items = simplexml_load_file('product.xml');
	$id = $_GET['id'];
	$index = 0;
	$i = 0;
	foreach($Items->Item as $Item){
		if($Item['id']==$id){
			$index = $i;
			break;
		}
		$i++;
	}
	unset($Items->Item[$index]);
	file_put_contents('product.xml', $Items->asXML());
}
$Items = simplexml_load_file('product.xml');
echo 'Number of products: '.count($Items);
echo '<br>List Product Information';
?>
<br>
<a href="add.php">Add new product</a>
<br>
<table cellpadding="2" cellspacing="2" border="1">
	<tr>
		<th>ean</th>
		<th>Code</th>
		<th>Price</th>
    <th>Stock</th>
		<th>Option</th>
	</tr>
	<?php foreach($Items->Item as $Item) { ?>
	<tr>
		<td><?php echo $Item->ean; ?></td>
		<td><?php echo $Item->name; ?></td>
		<td><?php echo $Item->code; ?></td>
    <td><?php echo $Item->stock; ?></td>
		<td><a href="edit.php?ean=<?php echo $Item->ean; ?>">Edit</a> |
			<a href="index.php?action=delete&ean=<?php echo $Item->ean; ?>" onclick="return confirm('Are you sure?')">Delete</a></td>
	</tr>
	<?php } ?>
</table>