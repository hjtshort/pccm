<?php
ob_start();
		function Them($conn, $address, $maCb, $namHoc,$soTiet)
		{			
			// Làm sạch chuổi nhập vào 	
			$maCb = trim($maCb);
			$maCb = strip_tags($maCb);
			$maCb = addslashes($maCb);
			

			$namHoc = trim($namHoc);
			$namHoc = strip_tags($namHoc);
			$namHoc = addslashes($namHoc);
			
			
			$soTiet = trim($soTiet);
			$soTiet = strip_tags($soTiet);
			$soTiet = addslashes($soTiet);

			$sql =   "Select count(*) as sl from nckh".
				" where namHoc='".$namHoc."'".
				" and maCb='".$maCb."'";
						 			
									
						 $query = mysqli_query($conn,$sql);
						 $data = mysqli_fetch_array($query);
						
					   
			
  			//Kiểm tra nội dung không được rỗng
				 if ($data["sl"]!=0) { thongBao(" Cán bộ này đã được ghi nhận rồi");}//Kiểm tra có bị trùng
						 	
					//	 $maMon =  $data["maMon"]+1; 
						
				else{
								  
					   //them vao bang chuc vu giang vien
						 $sql = "INSERT INTO nckh( maCb,  namHoc, soTiet) ".
								" VALUES ('".$maCb."','".$namHoc."','".$soTiet."')";												
						mysqli_query($conn,$sql); 
						header('Location: index.php?f='.$address);	
						}
														   								
			  		  
		}	

		function Xoa($conn, $address, $maCb,$namHoc)
		{		
		  //kiem tra co lien ket den k
		 	 $sql 	= "DELETE FROM nckh where maCb = '". $maCb."' and namHoc='".$namHoc."'" ;
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

function Sua($conn, $address, $maCb,$namHoc, $soTiet)
		{			
			// Làm sạch chuổi nhập vào 	
			$maCb = trim($maCb);
			$maCb = strip_tags($maCb);
			$maCb = addslashes($maCb);
			
			
							
  			//Kiểm tra nội dung không đượ.c rỗng
			  if ( $maCb == "" ) {
				  	thongBao(" Bạn vui lòng nhập mã cán bộ!");
  			   }
			  else if ( $soTiet == "" ) {
				  	thongBao(" Bạn vui lòng nhập số tiết!");
  			   }
			    else if (!is_numeric( $soTiet)) {
				  	thongBao(" Bạn vui lòng nhập số tiết là GIÁ TRỊ SỐ.");
  			  }
			  else{
					
					   //sua bang Chucvucanbo
						$sql = 	"UPDATE nckh ".
								" SET soTiet 	= '".$soTiet."' " .

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