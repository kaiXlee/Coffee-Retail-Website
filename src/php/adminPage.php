<?php
session_start();
?>
<!DOCTYPE html>
<?php include 'header.php'; ?>

<html lang = "en">
<head>
  <title>ADMIN PAGE</title>
  <link rel="stylesheet" href="../css/mainPage.css" />
  <link rel="stylesheet" href="../css/header.css"/>
  <link rel="stylesheet" href="../css/footer.css"/>
  <table>

  <tr>
  <td> <a href = "admin_insert_update.php" id="admin"> <font size = 10, color = white> Update/Insert Items</font> </a> </td>
</tr>
<tr>
<td> <a href = "admin_delete.php" id="admin"> <font size = 10, color = white>Delete Items</font> </a> </td>
</tr>
<tr>
  <td> <a href = "admin_manage_customer.php" id="admin"> <font size = 30, color = white>Search Customer </font></a></td>
</tr>
<tr>
  <td> <a href = "admin_update_customer.php" id="admin"> <font size = 30, color = white>Add/Update Customer </font></a></td>
</tr>
<tr>
  <td> <a href = "admin_order.php" id="admin"> <font size = 30, color = white>ALL Orders </font></a></td>
</tr>
<tr>
  <td> <a href = "inventory.php" id="admin"> <font size = 30, color = white>Inventory </font></a></td>
</tr>
  </table>
</head>

<?php include 'footer.php'; ?>
