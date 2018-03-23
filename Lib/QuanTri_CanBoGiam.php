<?php

		function ThemCbG($conn, $address, $maCb, $maDt,$namHoc)
		{			
			// Làm sạch chuổi nhập vào 	
			$maCb = trim($maCb);
			$maCb = strip_tags($maCb);
			$maCb = addslashes($maCb);
			
			$maDt = trim($maDt);
			$maDt = strip_tags($maDt);
			$maDt = addslashes($maDt);

			$namHoc = trim($namHoc);
			$namHoc = strip_tags($namHoc);
			$namHoc = addslashes($namHoc);

			$sql =   "Select count(*) as sl from canbogiam".
				" where namHoc='".$namHoc."'".
				" and maCb='".$maCb."'";
						 			
									
						 $query = mysqli_query($conn,$sql);
						 $data = mysqli_fetch_array($query);
						
					   
			
  			//Kiểm tra nội dung không được rỗng
			 if ($data["sl"]!=0) { thongBao(" Cán bộ này đã được giảm rồi");}//Kiểm tra có bị trùng
						 	
					//	 $maMon =  $data["maMon"]+1; 
						
				else{
								  
					   //them vao bang chuc vu giang vien
						 $sql = "INSERT INTO canbogiam( maCb, maDt, namHoc) ".
								" VALUES ('".$maCb."','".$maDt."','".$namHoc."')";												
						mysqli_query($conn,$sql); 
						header('Location: index.php?f='.$address);	
						}
														   								
			  		  
		}	

		function XoaCbG($conn, $address, $maCb,$maDt,$namHoc)
		{		
		  //kiem tra co lien ket den k
		 	 $sql 	= "DELETE FROM canbogiam where maCb = '". $maCb."' and maDt='".$maDt."' and namHoc='".$namHoc."'" ;
			 $query = mysqli_query($conn,$sql);
			 if (!$query){
    				thongBao(" Không thể xóa !");
			  }		
			  else
			  {			
					header('Location: index.php?f='.$address);	
					exit;
			  }				
		}


		function Sua($conn, $address, $maCb, $maDt,$namHoc)
		{			
			// Làm sạch chuổi nhập vào 	
			$maCb = trim($maCb);
			$maCb = strip_tags($maCb);
			$maCb = addslashes($maCb);
			
			$maDt = trim($maDt);
			$maDt = strip_tags($maDt);
			$maDt = addslashes($maDt);
			
							
  			//Kiểm tra nội dung không đượ.c rỗng
			 
			   
					   //sua bang Chucvucanbo
						$sql = 	"UPDATE canbogiam ".
								" SET maDt 	= '".$maDt."' " .
								" where maCb = '".$maCb."'".
								" and namHoc='".$namHoc."'";

								
						$query = mysqli_query($conn,$sql); 
						  if (!$query){
    						thongBao("Cán bộ này không thể sửa Đối tượng !");
						  }		
						  else
						  {			
								header('Location: index.php?f='.$address);	
								exit;
						  }		
					}
	

?>