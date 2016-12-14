<?php
/*
 * e107 website system - Bulgarian Translation
 *
 * Copyright (C) 2005-2011 e107 Bulgaria e107.bg
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * $Id$
*/
if(!defined('e_HTTP')){ die("Неоторизиран Достъп");}
if (!getperms("2")) {
	header("location:".e_BASE."index.php");
	 exit;
}
global $sql;
if(isset($_POST['reset'])){
		for($mc=1;$mc<=5;$mc++){
			$sql -> db_Select("menus","*", "menu_location='".$mc."' ORDER BY menu_order");
			$count = 1;
			$sql2 = new db;
			while(list($menu_id, $menu_name, $menu_location, $menu_order) = $sql-> db_Fetch()){
				$sql2 -> db_Update("menus", "menu_order='$count' WHERE menu_id='$menu_id' ");
				$count++;
			}
			$text = "<b>Менюто е нулирано в базата данни</b><br /><br />";
		}
}else{
	unset($text);
}
$text .= "
Можете да правите настройки на менютата си от тук и да определяте реда им. 
Използвайте падащото меню за да местите менютата нагоре и надолу.
<br />
<br />
Ако намерите меню което не се е обновило правилно кликнете на бутона Опресни.
<br />
<form method='post' id='menurefresh' action='".$_SERVER['PHP_SELF']."'>
<div><input type='submit' class='button' name='reset' value='Опресни' /></div>
</form>
<br />
<div class='indent'><span style='color:red'>*</span> промените по менютата ще бъдат актуализирани</div>";
$ns -> tablerender("Менюта - Помощ", $text);