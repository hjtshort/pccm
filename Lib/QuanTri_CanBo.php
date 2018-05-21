<?php
ob_start();
		function ThemCanBo($conn, $address, $maCb, $hoCb, $tenCb, $maBm, $matKhau)
		{			
			// Làm sạch chuổi nhập vào 	
			$maCb = trim($maCb);			
			$maCb = strip_tags($maCb);
			$maCb = addslashes($maCb);

			$hoCb = trim($hoCb);		
			$hoCb = strip_tags($hoCb);
			$hoCb = addslashes($hoCb);

			$tenCb = trim($tenCb);					
			$tenCb = strip_tags($tenCb);
			$tenCb = addslashes($tenCb);

			$matKhau = trim($matKhau);					
			$matKhau = strip_tags($matKhau);
			$matKhau = addslashes($matKhau);
					
  			//Kiểm tra nội dung không được rỗng
			  if ( $maCb == "" ) {
				  	thongBao(" Bạn vui lòng nhập mã cán bộ!");
  			   }
			  else if ( $hoCb == "" || $tenCb == "" ) {
				  	thongBao(" Bạn vui lòng nhập đầy đủ họ và tên cho cán bộ!");
  			   }		   
			  else{
					//kiem tra trung các Unique và primary		  
					$sql_ms =   "Select count(*) as sl from canbo".
								" where maCb =  '".$maCb."' ";
					$query_ms = mysqli_query($conn,$sql_ms);
					$data_ms = mysqli_fetch_array($query_ms);	
									
					
				    if($data_ms["sl"]!=0) {		
						   thongBao("Mã cán bộ đã bị trùng. Bạn vui lòng nhập mã cán bộ khác.");
					}	
					else   
					{   		  
					   //them vao bang CANBO
						 $sql = "INSERT INTO canbo( maCb, hoCb, tenCb, maBm, matKhau) ".
								" VALUES ('".$maCb."','".$hoCb."','".$tenCb."','".$maBm."',md5('".$matKhau."'))";												
						mysqli_query($conn,$sql); 
						header('Location: index.php?f='.$address);	
					}									   								
			  }			  
		}	

		function XoaCanBo($conn, $address, $maCb)
		{		
		  //kiem tra co lien ket den k
		 	 $sql 	= "DELETE FROM canbo where maCb = '". $maCb."'" ;
			 $query = mysqli_query($conn,$sql);
			 if (!$query){
    				thongBao("Cán Bộ này đã được phân công giảng dạy. Không thể xóa !");
			  }		
			  else
			  {			
					header('Location: index.php?f='.$address);	
					exit;
			  }				
		}


	
		function Sua($conn, $address, $ma_old, $maCb, $hoCb, $tenCb, $maBm, $matKhau)
		{			
			// Làm sạch chuổi nhập vào 	
			$maCb = trim($maCb);			
			$maCb = strip_tags($maCb);
			$maCb = addslashes($maCb);

			$hoCb = trim($hoCb);		
			$hoCb = strip_tags($hoCb);
			$hoCb = addslashes($hoCb);

			$tenCb = trim($tenCb);					
			$tenCb = strip_tags($tenCb);
			$tenCb = addslashes($tenCb);

			$matKhau = trim($matKhau);					
			$matKhau = strip_tags($matKhau);
			$matKhau = addslashes($matKhau);
					
  			//Kiểm tra nội dung không được rỗng
			  if ( $maCb == "" ) {
				  	thongBao(" Bạn vui lòng nhập mã cán bộ!");
  			   }
			  else if ( $hoCb == "" || $tenCb == "" ) {
				  	thongBao(" Bạn vui lòng nhập đầy đủ họ và tên cho cán bộ!");
  			   }		   
			  else{
					//kiem tra trung các Unique và primary		  
					$sql_ms =   "Select count(*) as sl from canbo".
								" where maCb =  '".$maCb."' and maCb != '".$ma_old ."'";
					$query_ms = mysqli_query($conn,$sql_ms);
					$data_ms = mysqli_fetch_array($query_ms);	
									
					
				    if($data_ms["sl"]!=0) {		
						   thongBao("Mã ".$ma_old." đã bị trùng với cán bộ khác. Bạn vui lòng nhập mã cán bộ khác.");
					}	
					else   
					{   		  
					   //sua bang CANBO
						$sql = 	"UPDATE canbo ".
								" SET maCb 	  = '".$maCb."' ," .
								"	  hoCb 	  = '".$hoCb."' ," .
								"	  tenCb   = '".$tenCb."' ," .
								"	  maBm 	  = '".$maBm."' ," .
								"	  matKhau = md5('".$matKhau."')".																								
								" where maCb = '" .  $ma_old."'";			
								
						$query = mysqli_query($conn,$sql); 
						  if (!$query){
    						thongBao("Cán Bộ này đã được phân công giảng dạy. Không thể sửa mã !");
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