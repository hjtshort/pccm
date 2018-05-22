<?php
ob_start();
		function ThemTbg($conn, $address, $maCb, $namHoc, $soTc)
		{			
			// Làm sạch chuổi nhập vào 	
			$maCb = trim($maCb);
			$maCb = strip_tags($maCb);
			$maCb = addslashes($maCb);
			
			$soTc = trim($soTc);
			$soTc = strip_tags($soTc);
			$soTc = addslashes($soTc);

			$namHoc = trim($namHoc);
			$namHoc = strip_tags($namHoc);
			$namHoc = addslashes($namHoc);

			$sql =   "Select count(*) as sl from tapbaigiang".
				" where namHoc='".$namHoc."'".
				" and maCb='".$maCb."'";
						 			
									
						 $query = mysqli_query($conn,$sql);
						 $data = mysqli_fetch_array($query);
						
					   
			
  			//Kiểm tra nội dung không được rỗng
			  if ( $soTc == "" ) {
				  	thongBao(" Bạn vui lòng nhập số tín chỉ!");
  			   }
			   else if (!is_numeric( $soTc)) {
				  	thongBao(" Bạn vui lòng nhập số tín chỉ là GIÁ TRỊ SỐ.");
  			   }
			
				 else if ($data["sl"]!=0) { thongBao(" Cán bộ này đã viết tập bài giảng rồi");}//Kiểm tra có bị trùng
						 	
					//	 $maMon =  $data["maMon"]+1; 
						
				else{
								  
					   //them vao bang chuc vu giang vien
						 $sql = "INSERT INTO tapbaigiang( maCb,  namHoc, soTc) ".
								" VALUES ('".$maCb."','".$namHoc."','".$soTc."')";												
						mysqli_query($conn,$sql); 
						header('Location:index.php?f='.$address);	
						}
														   								
			  		  
		}	

		function XoaTbg($conn, $address, $maCb,$namHoc)
		{		
		  //kiem tra co lien ket den k
		 	 $sql 	= "DELETE FROM tapbaigiang where maCb = '". $maCb."' and namHoc='".$namHoc."'" ;
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


	function Sua($conn, $address, $maCb,$namHoc, $soTc)
		{			
			// Làm sạch chuổi nhập vào 	
			$maCb = trim($maCb);
			$maCb = strip_tags($maCb);
			$maCb = addslashes($maCb);
			
			
							
  			//Kiểm tra nội dung không đượ.c rỗng
			  if ( $maCb == "" ) {
				  	thongBao(" Bạn vui lòng nhập mã cán bộ!");
  			   }
			  else if ( $soTc == "" ) {
				  	thongBao(" Bạn vui lòng nhập số tín chỉ!");
  			   }
			    else if (!is_numeric( $soTc)) {
				  	thongBao(" Bạn vui lòng nhập số tính chỉ là GIÁ TRỊ SỐ.");
  			  }
			  else{
					
					   //sua bang Chucvucanbo
						$sql = 	"UPDATE tapbaigiang ".
								" SET soTc 	= '".$soTc."' " .

								" where maCb = '" .  $maCb."'".
								"and namHoc='".$namHoc."'";			
								
						$query = mysqli_query($conn,$sql); 
						  if (!$query){
    						thongBao("Không thể sửa  !");
						  }		
						  else
						  {			
								header('Location: index.php?f='.$address);		
								exit;
						  }		
														   								
			  }			  
		}	

?>