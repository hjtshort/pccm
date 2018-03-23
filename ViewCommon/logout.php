<?php	
	if (!defined('IN_SITE')) die('The request not found'); 
	
	// Xóa session login
 	set_logout();
	
	// Xóa session idMau
	if (isset($_SESSION['idMau'])){
        unset($_SESSION['idMau']);
    }
	
 	header('Location: index.php')	;	
?>