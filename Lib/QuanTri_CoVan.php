<?php 

ob_start();

		function ThemCv($conn, $address, $maCb, $maLop,$namHoc)
		{			
			// Làm sạch chuổi nhập vào 	
			$maCb = trim($maCb);
			$maCb = strip_tags($maCb);
			$maCb = addslashes($maCb);
			
			$maCv = trim($maLop);
			$maCv = strip_tags($maLop);
			$maCv = addslashes($maLop);

			$namHoc = trim($namHoc);
			$namHoc = strip_tags($namHoc);
			$namHoc = addslashes($namHoc);

			
  			//Kiểm tra nội dung không được rỗng
			  if ( $maCb == "" ) {
				  	thongBao(" Bạn vui lòng nhập mã cán bộ!");
  			   }
			  else if ( $maLop == "" ) {
				  	thongBao(" Bạn vui lòng nhập mã Lớp!");
  			   }
			else   
					{   
					   //Kiểm tra có bị trùng
						 $sql1 =   "Select count(*) as sl from cvht".
						 			"where maCb='".$maCb."' and maLop=' ".$maLop."'".
									"and namHoc='".$namHoc."'";
						 $query1 = mysqli_query($conn,$sql1);
						 if($query1){
						  $data1 = mysqli_fetch_array($query1);	
						 }
						 
						
						 if(isset($data1["sl"])!=0){ 
						 		thongBao("Đã phân công rồi");
						}
						 else{
					//	 $maMon =  $data["maMon"]+1; 
								  
					   //them vao bang chuc vu giang vien
						 $sql = "INSERT INTO cvht( maCb, maLop, namHoc) ".
								" VALUES ('".$maCb."','".$maLop."','".$namHoc."')";												
						mysqli_query($conn,$sql); 
						echo '<script>window.location = "index.php?f='.$address.'"</script>';
						//exit(header('Location: index.php?f='.$address));	
						}
					}									   								
			  		  
		}	

		function XoaCvGv($conn, $address, $maCb,$maLop,$namHoc)
		{		
		  //kiem tra co lien ket den k
		 	 $sql 	= "DELETE FROM cvht where maCb = '". $maCb."' and maLop='".$maLop."' and namHoc='".$namHoc."'" ;
			 $query = mysqli_query($conn,$sql);
			 if (!$query){
    				thongBao("Lớp đã được phân công chủ nhiệm. Không thể xóa !");
			  }		
			  else
			  {			
			  		echo '<script>window.location = "index.php?f='.$address.'"</script>';
					//exit(header('Location: index.php?f='.$address));	
					
			  }				
		}


	function Sua($conn, $address, $ma_Cbold,$ma_Cvold, $maCb, $maCv)
		{			
			// Làm sạch chuổi nhập vào 	
			$maMon = trim($maCb);
			$maMon = strip_tags($maCb);
			$maMon = addslashes($maCb);
			
			$tenMon = trim($maCv);
			$tenMon = strip_tags($maCv);
			$tenMon = addslashes($maCv);
			
							
  			//Kiểm tra nội dung không đượ.c rỗng
			  if ( $maCb == "" ) {
				  	thongBao(" Bạn vui lòng nhập mã cán bộ!");
  			   }
			  else if ( $maCv == "" ) {
				  	thongBao(" Bạn vui lòng nhập chức vụ!");
  			   }
			  else{
					//Kiểm tra xem có phân công chưa
					$sql =   "Select count(*) as sl from chucvugiangvien".
						 			"where maCb='".$maCb."' and maCv=' ".$maCv."'";
						 $query = mysqli_query($conn,$sql);
						 $data = mysqli_fetch_array($query);	
						 if ($data["sl"]!=0) thongBao("Đã phân công rồi".$data["sl"]);
					else   
					{   
					   //sua bang Chucvucanbo
						$sql = 	"UPDATE chucvugiangvien ".
								" SET maCb 	= '".$maCb."' ," .
								"	  maCv 	= '".$maCv."' " .
								" where maCb = '" .  $ma_Cbold."'".
								"and maCv='".$ma_Cvold."'";			
								
						$query = mysqli_query($conn,$sql); 
						  if (!$query){
    						thongBao("Cán bộ này không thể sửa mã !");
						  }		
						  else
						  {			
								header('Location: index.php?f='.$address);	
								exit;
						  }		
					}									   								
			  }			  
		}	
		
ob_end_flush();

?>