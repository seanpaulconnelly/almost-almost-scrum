<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sorting Items on the fly using jQuery UI, PHP & MySQL</title>
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.7.1.custom.min.js"></script>
<script>
$(document).ready(
function() {
$("#sortme").sortable({
update : function () {
serial = $('#sortme').sortable('serialize');
$.ajax({
url: "sort_menu.php",
type: "post",
data: serial,
error: function(){
alert("theres an error with AJAX");
}
});
}
});
}
);
</script>
</head>
<body>
<h1>Menu List</h1>

<ul id="sortme">
<?php
// Connecting to Database
mysql_connect($hostname, $user_name, $password) or die ('Cant Connceto to MySQL');

// Selecting Database
mysql_select_db($db_name) or die ('Cant select Database');

// Getting menu items from DB
$result = mysql_query("SELECT * FROM `menu` ORDER BY `sort` ASC") or die(mysql_error());
while($row = mysql_fetch_array($result)) {
echo '<li id="menu_' . $row['id'] . '">' . $row['title_en'] . "</li>\n";
}
?>
</ul>
</body>
</html>