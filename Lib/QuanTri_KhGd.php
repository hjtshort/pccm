<?php

		function ThemKhGd($conn, $address,$maNganh, $maMon,$he ,$sttKhoa, $hocKi, $namHoc)
		{			
			// Làm sạch chuổi nhập vào 	
			$maNganh = trim($maNganh);
			$maNganh = strip_tags($maNganh);
			$maNganh = addslashes($maNganh);

			$maMon = trim($maMon);
			$maMon = strip_tags($maMon);
			$maMon = addslashes($maMon);
			
			$e = trim($he);			
			$he = strip_tags($he);
			$he = addslashes($he);

			$sttKhoa = trim($sttKhoa);
			$sttKhoa = strip_tags($sttKhoa);
			$sttKhoa = addslashes($sttKhoa);

			$hocKi = trim($hocKi);			
			$hocKi = strip_tags($hocKi);
			$hocKi = addslashes($hocKi);
			
			$namHoc = trim($namHoc);						
			$namHoc = strip_tags($namHoc);
			$namHoc = addslashes($namHoc);

			
  			//Kiểm tra nội dung không được rỗng
			  if ( $maMon == "" ) {
				  	thongBao(" Bạn vui lòng nhập mã môn học!");
  			   }
			  else if ( $maNganh == "" ) {
				  	thongBao(" Bạn vui lòng chọn ngành!");
  			   }
		    //kiểm tra là số 
			  else if (!is_numeric( $sttKhoa)) {
				  	thongBao(" Bạn vui lòng nhập khóa là GIÁ TRỊ SỐ.");
  			  }
			  else if (!is_numeric( $hocKi)) {
				  	thongBao(" Bạn vui lòng nhập học kỳ là GIÁ TRỊ SỐ.");
  			  }
			  else if (!is_numeric( $namHoc)) {
				  	thongBao(" Bạn vui lòng nhập năm học là GIÁ TRỊ SỐ.");
  			  }			  
			  else{
					//kiem tra trung các Unique và primary		  
					$sql_ten =   "Select count(*) as sl from chuongtrinhhoc ".
								" where maNganh =  '".$maNganh."' ".
								" and he='".$he."'".
								" and maMon =  '".$maMon."' ".
								" and sttKhoa =  '".$sttKhoa."' ".
								" and hocKi =  '".$hocKi."' ".
								" and namHoc =  '".$namHoc."' ";								
					$query_ten = mysqli_query($conn,$sql_ten);
					$data_ten = mysqli_fetch_array($query_ten);	
					
/*					$sql_ms =   "Select count(*) as sl from monhoc ".
								" where maMon =  '".$maMon."' ";
					$query_ms = mysqli_query($conn,$sql_ms);
					$data_ms = mysqli_fetch_array($query_ms);	
					
					
				    if($data_ms["sl"]!=0) {		
						   thongBao("Mã môn học đã bị trùng. Bạn vui lòng nhập mã môn mới.");
					}	
					else */
					if($data_ten["sl"]!=0) {		
						   thongBao("Môn học này đã có rồi Bạn vui lòng nhập mon học mới.");
					}	
					else   
					{   
					   //Tạo mã
					//	 $sql =   "Select max(maMon) as maMon from monhoc ";													
					//	 $query = mysqli_query($conn,$sql);
					//	 $data = mysqli_fetch_array($query);	
					//	 $maMon =  $data["maMon"]+1; 
								  
					   //them vao bang MONHOC
						 $sql = "INSERT INTO chuongtrinhhoc( maNganh,maMon,he, sttKhoa, hocKi, namHoc) ".
								" VALUES ('".$maNganh."','".$maMon."',".$he.",".$sttKhoa.",".$hocKi.",".$namHoc.")";												
						mysqli_query($conn,$sql); 
						header('Location: index.php?f='.$address);	
					}									   								
			  }			  
		}	

		function XoaMon($conn, $address, $maNganh,$maMon,$he,$sttKhoa,$hocKi,$namHoc)
		{		
		  //kiem tra co lien ket den k
		 	 $sql 	= "DELETE FROM chuongtrinhhoc where maNganh = '". $maNganh."'".
			 			"and maMon='".$maMon."'".
						"and he='".$he."'".
						"and sttKhoa='".$sttKhoa."'".
						"and hocKi='".$hocKi."'".
						"and namHoc='".$namHoc."'";
			 $query = mysqli_query($conn,$sql);
			 if (!$query){
    				thongBao("Không thể xóa !");
			  }		
			  else
			  {			
					header('Location: index.php?f='.$address);	
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