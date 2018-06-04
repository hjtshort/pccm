<?php
ob_start();

		function ThemMon($conn, $address, $maMon, $tenMon, $soTC, $LT, $BT,$TH,$KT)
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

			$BT = trim($BT);						
			$BT = strip_tags($BT);
			$BT = addslashes($BT);
			
			$TH = trim($TH);						
			$TH = strip_tags($TH);
			$TH = addslashes($TH);
			
			$KT = trim($KT);						
			$KT = strip_tags($KT);
			$KT = addslashes($KT);
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
  			  else if (!is_numeric( $BT)) {
				  	thongBao(" Bạn vui lòng nhập số tiết bài tập là GIÁ TRỊ SỐ.");
  			  }

			  else if (!is_numeric( $TH)) {
				  	thongBao(" Bạn vui lòng nhập số tiết thực hành là GIÁ TRỊ SỐ.");
  			  }			  
			  else if (!is_numeric( $KT)) {
				  	thongBao(" Bạn vui lòng nhập số tiết kiểm tra là GIÁ TRỊ SỐ.");
  			  }			  

			  else{
					//kiem tra trung các Unique và primary		  
					$sql_ten =   "Select count(*) as sl from monhoc ".
								" where tenMon =  '".$tenMon."' ";
					$query_ten = mysqli_query($conn,$sql_ten);
					$data_ten = mysqli_fetch_array($query_ten);	
					
					$sql_ms =   "Select count(*) as sl from monhoc ".
								" where maMon =  '".$maMon."' ";
					$query_ms = mysqli_query($conn,$sql_ms);
					$data_ms = mysqli_fetch_array($query_ms);	
					
					
				    if($data_ms["sl"]!=0) {		
						   thongBao("Mã môn học đã bị trùng. Bạn vui lòng nhập mã môn mới.");
					}	
					else   
					{   
					   //Tạo mã
					//	 $sql =   "Select max(maMon) as maMon from monhoc ";													
					//	 $query = mysqli_query($conn,$sql);
					//	 $data = mysqli_fetch_array($query);	
					//	 $maMon =  $data["maMon"]+1; 
								  
					   //them vao bang MONHOC
						 $sql = "INSERT INTO monhoc( maMon, tenMon, soTc, soTietLt, soTietBt,soTietTh, soTietKt) ".
								" VALUES ('".$maMon."','".$tenMon."',".$soTC.",".$LT.",".$BT.",".$TH.",".$KT.")";												
						mysqli_query($conn,$sql); 
						header('Location: index.php?f='.$address);	
					}									   								
			  }			  
		}	

		function XoaMon($conn, $address, $maMon)
		{		
		  //kiem tra co lien ket den k
		 	 $sql 	= "DELETE FROM monhoc where maMon = '". $maMon."'" ;
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


	function Sua($conn, $address, $ma_old, $maMon, $tenMon, $soTC, $LT, $BT,$TH, $KT)
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

			$BT = trim($BT);						
			$BT = strip_tags($BT);
			$BT = addslashes($BT);
			
			$TH = trim($TH);						
			$TH = strip_tags($TH);
			$TH = addslashes($TH);
			
			$KT = trim($KT);						
			$KT = strip_tags($KT);
			$KT = addslashes($KT);
  			//Kiểm tra nội dung không được rỗng
			  if ( $maMon == "" ) {
				  	thongBao(" Bạn vui lòng nhập mã môn học!");
  			   }
			  else if ( $tenMon == "" ) {
				  	thongBao(" Bạn vui lòng nhập tên cho môn học!");
  			   }
		    //kiểm tra là số 
			  else if (!is_numeric( $soTC)) {
				  	thongBao(" Bạn vui lòng nhập số tín chỉ là GIÁ TRỊ SỐ.");
  			  }
			  else if (!is_numeric( $LT)) {
				  	thongBao(" Bạn vui lòng nhập số tiết lý thuyết là GIÁ TRỊ SỐ.");
  			  }

			  else if (!is_numeric( $BT)) {
				  	thongBao(" Bạn vui lòng nhập số tiết bài tập là GIÁ TRỊ SỐ.");
  			  }
			  else if (!is_numeric( $TH)) {
				  	thongBao(" Bạn vui lòng nhập số tiết thực hành là GIÁ TRỊ SỐ.");
  			  }			  

			  else if (!is_numeric( $KT)) {
				  	thongBao(" Bạn vui lòng nhập số tiết kiểm tra là GIÁ TRỊ SỐ.");
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
								"	  soTc		= ".$soTC." ," .
								"	  soTietLt  = ".$LT." ," .
								"	  soTietBt  = ".$BT." ," .
								"	  soTietTh  = ".$TH." ," .																								
								"	  soTietKt  = ".$KT." " .																								
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