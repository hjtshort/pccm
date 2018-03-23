<?php

		function ThemNganh($conn, $address, $tenNganh, $maBm)
		{			
			// Làm sạch chuổi nhập vào 	
			$tenNganh = trim($tenNganh);
			$tenNganh = strip_tags($tenNganh);
			$tenNganh = addslashes($tenNganh);
					
  			//Kiểm tra nội dung không được rỗng
			  if ( $tenNganh == "" ) {
				  	thongBao(" Bạn vui lòng nhập tên Ngành!");
  			   }
			  else{
					//kiem tra trung các Unique và primary		  
					$sql_ms =   "Select count(*) as sl from nganh".
								" where tenNganh = '".$tenNganh."'";
					$query_ms = mysqli_query($conn,$sql_ms);
					$data_ms = mysqli_fetch_array($query_ms);	
									
					
				    if($data_ms["sl"]!=0) {		
						   thongBao("Ngành ".$tenNganh." đã bị trùng tên. Bạn vui lòng nhập tên Ngành khác.");
					}	
					else   
					{   		
					
					 //Tạo mã
						 $sql =   "Select max(maNganh) as maNganh from nganh ";													
						 $query = mysqli_query($conn,$sql);
						 $data = mysqli_fetch_array($query);	
						 $maNganh =  $data["maNganh"]+1; 
								    
					   //them vao bang NGANH
						 $sql = "INSERT INTO nganh( maNganh, tenNganh, maBm) ".
								" VALUES ('".$maNganh."','".$tenNganh."','".$maBm."')";												
						mysqli_query($conn,$sql); 
						header('Location: index.php?f='.$address);	
					}									   								
			  }			  
		}	

		function XoaNganh($conn, $address, $maNganh)
		{		
		  //kiem tra co lien ket den k
		 	 $sql 	= "DELETE FROM nganh where maNganh = '". $maNganh."'" ;
			 $query = mysqli_query($conn,$sql);
			 if (!$query){
    				thongBao("Ngành này không thể xóa !");
			  }		
			  else
			  {			
					header('Location: index.php?f='.$address);	
					exit;
			  }				
		}


	function SuaNganh($conn, $address, $ma_old,  $tenNganh, $maBm)
		{			
			// Làm sạch chuổi nhập vào 	
			$tenNganh = trim($tenNganh);
			$tenNganh = strip_tags($tenNganh);
			$tenNganh = addslashes($tenNganh);
					
  			//Kiểm tra nội dung không được rỗng
			  if ( $tenNganh == "" ) {
				  	thongBao(" Bạn vui lòng nhập ten Ngành!");
  			   }
			  else{
					//kiem tra trung các Unique và primary		  
					$sql_ms =   "Select count(*) as sl from nganh".
								" where tenNganh = '".$tenNganh."' and maNganh !=".$ma_old;
					$query_ms = mysqli_query($conn,$sql_ms);
					$data_ms = mysqli_fetch_array($query_ms);	
									
					
				    if($data_ms["sl"]!=0) {		
						   thongBao("Ngành ".$tenNganh." đã bị trùng tên. Bạn vui lòng nhập tên Ngành khác.");
					}	
					else   
					{   						
					 //sua bang CANBO
						$sql = 	"UPDATE nganh".
								" SET tenNganh= '".$tenNganh."' ," .
								"	  maBm 	  = '".$maBm."'" .							
								" where maNganh = '" .  $ma_old."'";			
								
						$query = mysqli_query($conn,$sql); 
						  if (!$query){
    						thongBao("Nganh này không thể sửa !");
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