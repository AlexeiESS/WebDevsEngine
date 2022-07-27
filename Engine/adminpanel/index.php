<?php
require_once("../adminsql/adminsfunctions.php");
if(isset($_SESSION['admin']))
	{
?>

<!---Редактирование шаблона--->
<form method="POST" name="templates_options">
	<select name="templates">
	<?php
	select_template();
	?>
	</select>
	<button name="change_template" type="submit">
		Изменить шаблон
	</button>
</form>



<?php
	}else
	{
		header("Location: ..../index.php");
	}
?>