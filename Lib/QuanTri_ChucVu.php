<?php

		function ThemCv($conn, $address, $maCb, $maCv)
		{			
			// Làm sạch chuổi nhập vào 	
			$maCb = trim($maCb);
			$maCb = strip_tags($maCb);
			$maCb = addslashes($maCb);
			
			$maCv = trim($maCv);
			$maCv = strip_tags($maCv);
			$maCv = addslashes($maCv);

			
  			//Kiểm tra nội dung không được rỗng
			  if ( $maCb == "" ) {
				  	thongBao(" Bạn vui lòng nhập mã cán bộ!");
  			   }
			  else if ( $maCv == "" ) {
				  	thongBao(" Bạn vui lòng nhập mã chức vụ!");
  			   }
			else   
					{   
					   //Kiểm tra có bị trùng
						 $sql1 =   "Select count(*) as sl from chucvugiangvien".
						 			"where maCb='".$maCb."' and maCv=' ".$maCv."'";
						 $query1 = mysqli_query($conn,$sql1);
						 $data1 = mysqli_fetch_array($query1);	
						 if($data1["sl"]!=0){ 
						 		thongBao("Đã phân công rồi");
						}
						 else{
					//	 $maMon =  $data["maMon"]+1; 
								  
					   //them vao bang chuc vu giang vien
						 $sql = "INSERT INTO chucvugiangvien( maCb, maCv) ".
								" VALUES ('".$maCb."','".$maCv."')";												
						mysqli_query($conn,$sql); 
						header('Location: index.php?f='.$address);	
						}
					}									   								
			  		  
		}	

		function XoaCvGv($conn, $address, $maCb,$maCv)
		{		
		  //kiem tra co lien ket den k
		 	 $sql 	= "DELETE FROM chucvugiangvien where maCb = '". $maCb."' and maCv='".$maCv."'" ;
			 $query = mysqli_query($conn,$sql);
			 if (!$query){
    				thongBao("Môn học đã được phân công giảng dạy. Không thể xóa !");
			  }		
			  else
			  {			
					header('Location: index.php?f='.$address);	
					exit;
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

?>