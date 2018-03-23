<?php

		function Them($conn, $address, $maDt, $tenDt, $soTietGiam)
		{			
			// Làm sạch chuổi nhập vào 	
			$maDt = trim($maDt);
			$maDt = strip_tags($maDt);
			$maDt = addslashes($maDt);
			
			$tenDt = trim($tenDt);
			$tenDt = strip_tags($tenDt);
			$tenDt = addslashes($tenDt);

			$soTietGiam = trim($soTietGiam);			
			$soTietGiam = strip_tags($soTietGiam);
			$soTietGiam = addslashes($soTietGiam);
			
			
  			//Kiểm tra nội dung không được rỗng
			   if ( $tenDt == "" ) {
				  	thongBao(" Bạn vui lòng nhập tên cho đối tượng!");
  			   }
			  else if ( $soTietGiam == "" ) {
			  	thongBao(" Bạn vui lòng nhập số tiết giảm cho đối tượng!");
  			   }

		    //kiểm tra là số 
			  else if (!is_numeric( $soTietGiam)) {
				  	thongBao(" Bạn vui lòng nhập số tiết giảm là GIÁ TRỊ SỐ.");
  			  }
			  else{
					//kiem tra trung các Unique và primary		  
					$sql_ten =   "Select count(*) as sl from doituonggiam ".
								" where tenDt =  '".$tenDt."' ";
					$query_ten = mysqli_query($conn,$sql_ten);
					$data_ten = mysqli_fetch_array($query_ten);	
					
					$sql_ms =   "Select count(*) as sl from monhoc ".
								" where maDt =  '".$maDt."' ";
					$query_ms = mysqli_query($conn,$sql_ms);
					$data_ms = mysqli_fetch_array($query_ms);	
					
					
				    if($data_ms["sl"]!=0) {		
						   thongBao("Mã đối tượng đã bị trùng. Bạn vui lòng nhập mã đối tượng mới.");
					}	
					else if($data_ten["sl"]!=0) {		
						   thongBao("Tên đối tượng đã bị trùng. Bạn vui lòng nhập tên mới.");
					}	
					else   
					{   
					   //Tạo mã
						 $sql =   "Select max(maDt) as maDt from doituonggiam ";													
						 $query = mysqli_query($conn,$sql);
						 $data = mysqli_fetch_array($query);	
						 $maDt =  $data["maDt"]+1; 
								  
					   //them vao bang MONHOC
						 $sql = "INSERT INTO doituonggiam( maDt, tenDt, soTietGiam) ".
								" VALUES ('".$maDt."','".$tenDt."',".$soTietGiam.")";												
						mysqli_query($conn,$sql); 
						header('Location: index.php?f='.$address);	
					}									   								
			  }			  
		}	

		function Xoa($conn, $address, $maDt)
		{		
		  //kiem tra co lien ket den k
		 	 $sql 	= "DELETE FROM doituonggiam where maDt = '". $maDt."'" ;
			 $query = mysqli_query($conn,$sql);
			 if (!$query){
    				thongBao("Đối tượng này đã được sử dụng. Không thể xóa !");
			  }		
			  else
			  {			
					header('Location: index.php?f='.$address);	
					exit;
			  }				
		}


	function Sua($conn, $address, $ma_old, $tenDt, $soTietGiam)
		{			
			// Làm sạch chuổi nhập vào 	
			
			$tenDt = trim($tenDt);
			$tenDt = strip_tags($tenDt);
			$tenDt = addslashes($tenDt);
			
			$soTietGiam = trim($soTietGiam);			
			$soTietGiam = strip_tags($soTietGiam);
			$soTietGiam = addslashes($soTietGiam);
			
  			//Kiểm tra nội dung không được rỗng
			 if ( $tenDt == "" ) {
				  	thongBao(" Bạn vui lòng nhập tên đối tượng!");
  			   }
		    //kiểm tra là số 
			  else if (!is_numeric( $soTietGiam)) {
				  	thongBao(" Bạn vui lòng nhập số tiết giảm là GIÁ TRỊ SỐ.");
  			  }
			  else{
					//kiem tra trung các Unique và primary		  
					$sql_ten =   "Select count(*) as sl from doituonggiam ".
								" where tenDt =  '".$tenDt."' and maDt != '".$ma_old ."'";
					$query_ten = mysqli_query($conn,$sql_ten);
					$data_ten = mysqli_fetch_array($query_ten);	
					
					
					
				    if($data_ten["sl"]!=0) {		
						   thongBao("Tên đối tượng đã bị trùng. Bạn vui lòng nhập tên mới.");
					}	
					else   
					{   
					   //sua bang CANBO
						$sql = 	"UPDATE doituonggiam ".
								" SET tenDt 	= '".$tenDt."' ," .
								"	  soTietGiam		= '".$soTietGiam."' " .
								" where maDt = '" .  $ma_old."'";			
								
						$query = mysqli_query($conn,$sql); 
						  if (!$query){
    						thongBao("Đối tượng này không thể sửa mã !");
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