<?php
ob_start();
		function ThemBoMon($conn, $address, $tenBm, $maKhoa)
		{			
			// Làm sạch chuổi nhập vào 	
			$tenBm = trim($tenBm);
			$tenBm = strip_tags($tenBm);
			$tenBm = addslashes($tenBm);
						
  			//Kiểm tra nội dung không được rỗng
			  if ( $tenBm == "" ) {
				  	thongBao(" Bạn vui lòng nhập tên cho bộ môn!");
  			   }
			  else{
					//kiem tra trung các Unique và primary		  
					$sql_ms =   "Select count(*) as sl from bomon".
								" where tenBm =  '".$tenBm."'";
					$query_ms = mysqli_query($conn,$sql_ms);
					$data_ms = mysqli_fetch_array($query_ms);	
									
					
				    if($data_ms["sl"]!=0) {		
						   thongBao("Bộ môn ".$tenBm. " đã bị trùng. Bạn vui lòng kiểm tra lại thông tin.");
					}	
					else   
					{   		  
					   //Tạo mã
						 $sql =   "Select max(maBm) as maBm from bomon ";													
						 $query = mysqli_query($conn,$sql);
						 $data = mysqli_fetch_array($query);	
						 $maBm =  $data["maBm"]+1; 
								  
					   //them vao bang BOMON
						 $sql = "INSERT INTO bomon( maBm, tenBm, maKhoa) ".
								" VALUES ('".$maBm."','".$tenBm."','".$maKhoa."')";																
						mysqli_query($conn,$sql); 
						header('Location: index.php?f='.$address);	
						exit;
					}									   								
			  }			  
		}	

		function XoaBoMon($conn, $address, $maBm)
		{		
		  //kiem tra co lien ket den k
		 	 $sql 	= "DELETE FROM bomon where maBm = '". $maBm."'" ;
			 $query = mysqli_query($conn,$sql);
			 if (!$query){
    				thongBao("Bộ môn này đã có cán bộ trực thuộc. Không thể xóa !");
			  }		
			  else
			  {			
				    ob_start();
					ob_end_clean();
					header('Location: index.php?f='.$address);	
					exit;
			  }				
		}


	function Sua($conn, $address, $ma_old, $tenBm, $maKhoa)
	{			
			// Làm sạch chuổi nhập vào 	
			$tenBm = trim($tenBm);			
			$tenBm = strip_tags($tenBm);
			$tenBm = addslashes($tenBm);
						
  			//Kiểm tra nội dung không được rỗng
			  if ( $tenBm == "" ) {
				  	thongBao(" Bạn vui lòng nhập tên cho bộ môn!");
  			   }
			  else{
					//kiem tra trung các Unique và primary		  
					$sql_ms =   "Select count(*) as sl from bomon".
								" where tenBm =  '".$tenBm."' and maBm != '".$ma_old ."'";
					$query_ms = mysqli_query($conn,$sql_ms);
					$data_ms = mysqli_fetch_array($query_ms);	
									
					
				    if($data_ms["sl"]!=0) {		
						   thongBao("Bộ môn ".$tenBm. " đã bị trùng. Bạn vui lòng kiểm tra lại thông tin.");
					}	
					else   
					{   		  
					   //sua bang BO MON
						$sql = 	"UPDATE bomon ".
								" SET tenBm	  = '".$tenBm."' ," .
								"	  maKhoa  = '".$maKhoa."' " .																												
								" where maBm = '" .  $ma_old."'";			

						$query = mysqli_query($conn,$sql); 
						  if (!$query){
    						thongBao("Bộ môn này không thể sửa!");
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