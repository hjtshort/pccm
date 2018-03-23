<?php

		function ThemPccm($conn, $address,$maCb,$maLop,$maMon,$hocKi,$namHoc)
		{			
			// Làm sạch chuổi nhập vào 	
			$maCb = trim($maCb);
			$maCb = strip_tags($maCb);
			$maCb = addslashes($maCb);
			
			$maLop = trim($maLop);
			$maLop = strip_tags($maLop);
			$maLop = addslashes($maLop);


			$maMon = trim($maMon);
			$maMon = strip_tags($maMon);
			$maMon = addslashes($maMon);
			
			$hocKi = trim($hocKi);			
			$hocKi = strip_tags($hocKi);
			$hocKi = addslashes($hocKi);
			
			$namHoc = trim($namHoc);						
			$namHoc = strip_tags($namHoc);
			$namHoc = addslashes($namHoc);

			
					   //them vao bang PCDAY
						 $sql = "INSERT INTO pcday(maCb,maLop,maMon,hocKi,namHoc) ".
								" VALUES ('".$maCb."','".$maLop."','".$maMon."','".$hocKi."','".$namHoc."')";												
						 $query=mysqli_query($conn,$sql); 
					 if (!$query){
    				thongBao("Không thể thêm !");
			  }		
			  else
			  {			
					header('Location: index.php?f='.$address.'&idMau='.$maCb." ".$namHoc." ".$maLop);						

					exit;
			  }			
													   								
			  			  
		}	

		function XoaPccm($conn, $address, $maCb,$maLop,$maMon,$hocKi,$namHoc)
		{		
		  //kiem tra co lien ket den k
		 	 $sql 	= "DELETE FROM pcday where maCb = '". $maCb."'".
			 			"and maLop='".$maLop."'".
			 			"and maMon='".$maMon."'".
						"and hocKi='".$hocKi."'".
						"and namHoc='".$namHoc."'";
			 $query = mysqli_query($conn,$sql);
			 if (!$query){
    				thongBao("Không thể xóa !");
			  }		
			  else
			  {			
					header('Location: index.php?f='.$address.'&idMau='.$maCb." ".$namHoc." ".$maLop);						

					exit;
			  }				
		}


	function Sua($conn, $address, $ma_old, $maMon, $tenMon, $soTC, $LT, $TH)
		{			
			// Làm sạch chuổi nhập vào 	
			$maMon = trim($maMon);
			$maMon = strip_tags($maMon);
			$maMon = addslashes($maMon);
			
			$tenMon = trim($tenMon);
			$tenMon = strip_tags($tenMon);
			$tenMon = addslashes($tenMon);
			
			$soTC = trim($soTC);			
			$soTC = strip_tags($soTC);
			$soTC = addslashes($soTC);
			
			$LT = trim($LT);						
			$LT = strip_tags($LT);
			$LT = addslashes($LT);

			$TH = trim($TH);						
			$TH = strip_tags($TH);
			$TH = addslashes($TH);
			
  			//Kiểm tra nội dung không được rỗng
			  if ( $maMon == "" ) {
				  	thongBao(" Bạn vui lòng nhập mã môn học!");
  			   }
			  else if ( $tenMon == "" ) {
				  	thongBao(" Bạn vui lòng nhập tên cho môn học!");
  			   }
		    //kiểm tra là số 
			  else if (!is_numeric( $soTC)) {
				  	thongBao(" Bạn vui lòng nhập số tính chỉ là GIÁ TRỊ SỐ.");
  			  }
			  else if (!is_numeric( $LT)) {
				  	thongBao(" Bạn vui lòng nhập số tiết lý thuyết là GIÁ TRỊ SỐ.");
  			  }
			  else if (!is_numeric( $TH)) {
				  	thongBao(" Bạn vui lòng nhập số tiết thực hành là GIÁ TRỊ SỐ.");
  			  }			  
			  else{
					//kiem tra trung các Unique và primary		  
					$sql_ten =   "Select count(*) as sl from monhoc ".
								" where tenMon =  '".$tenMon."' and maMon != '".$ma_old ."'";
					$query_ten = mysqli_query($conn,$sql_ten);
					$data_ten = mysqli_fetch_array($query_ten);	
					
					$sql_ms =   "Select count(*) as sl from monhoc ".
								" where maMon =  '".$maMon."' and maMon != '".$ma_old ."'";
					$query_ms = mysqli_query($conn,$sql_ms);
					$data_ms = mysqli_fetch_array($query_ms);	
					
					
				    if($data_ms["sl"]!=0) {		
						   thongBao("Mã môn học đã bị trùng. Bạn vui lòng nhập mã môn mới.");
					}	
					else if($data_ten["sl"]!=0) {		
						   thongBao("Tên môn học đã bị trùng. Bạn vui lòng nhập tên mới.");
					}	
					else   
					{   
					   //sua bang CANBO
						$sql = 	"UPDATE monhoc ".
								" SET maMon 	= '".$maMon."' ," .
								"	  tenMon 	= '".$tenMon."' ," .
								"	  soTc		= '".$soTC."' ," .
								"	  soTietLt  = '".$LT."' ," .
								"	  soTietTh  = '".$TH."'" .																								
								" where maMon = '" .  $ma_old."'";			
								
						$query = mysqli_query($conn,$sql); 
						  if (!$query){
    						thongBao("Môn học này không thể sửa mã !");
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