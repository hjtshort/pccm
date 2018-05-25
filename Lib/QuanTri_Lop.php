<?php
ob_start();
		function ThemLop($conn, $address,$maLop, $tenLop, $siSo,$maNganh, $sttKhoa,$he)
		{			
			// Làm sạch chuổi nhập vào 	
			// echo $address."/".$maLop."/". $tenLop."/". $siSo."/".$maNganh."/".$sttKhoa."/".$he;

			// die();
			$tenLop = trim($tenLop);
			$tenLop = strip_tags($tenLop);
			$tenLop = addslashes($tenLop);
			
			$siSo = trim($siSo);
			$siSo = strip_tags($siSo);
			$siSo = addslashes($siSo);



			$sttKhoa = trim($sttKhoa);
			$sttKhoa = strip_tags($sttKhoa);
			$sttKhoa = addslashes($sttKhoa);
			
			$he = trim($he);
			$he = strip_tags($he);
			$he = addslashes($he);
						
  			//Kiểm tra nội dung không được rỗng
			  if ( $tenLop == "" ) {
				  	thongBao(" Bạn vui lòng nhập tên cho lớp học!");
  			   }
			  else if ( $sttKhoa == ""  ) {
				  	thongBao(" Bạn vui lòng nhập khóa học!");
  			   }	

			  else if ( $siSo == ""  ) {
				  	thongBao(" Bạn vui lòng nhập số lượng!");
  			   }	
			//kiểm tra là số 
			  else if (!is_numeric( $sttKhoa)) {
				  	thongBao(" Bạn vui lòng nhập khóa học là GIÁ TRỊ SỐ.");
  			  }	   

			  else if (!is_numeric( $siSo)) {
				  	thongBao(" Bạn vui lòng nhập số lượng là GIÁ TRỊ SỐ.");
  			  }	   
			  else{
					//kiem tra trung các Unique và primary		  
					
					
					$sql =   "Select count(*) as sl from lop".
								" where tenLop =  '".$tenLop."' and sttKhoa = ".$sttKhoa;
					$query = mysqli_query($conn,$sql);
					$data = mysqli_fetch_array($query);	
									
					
				    if($data["sl"]!=0) {		
						   thongBao("Lớp ".$tenLop." khóa ".$sttKhoa." đã bị trùng. Bạn vui lòng kiểm tra lại thông tin.");
					}	
					else   
					{   		  
					    	
								    
					   //them vao bang 
												
								try{
									mysqli_query($conn,"insert into lop values('$maLop','$tenLop',$siSo,'$maNganh',$sttKhoa,$he)"); 
								}	
								catch(Exception $e)		
								{
									echo "erorrrrr ".$e;
								}						
						
						header('Location: index.php?f='.$address);	
					}									   								
			  }			  
		}	

		function XoaLop($conn, $address, $maLop)
		{		
		  //kiem tra co lien ket den k
		 	 $sql 	= "DELETE FROM lop where maLop = '". $maLop."'" ;
			 $query = mysqli_query($conn,$sql);
			 if (!$query){
    				thongBao("Lớp này đã có sinh viên. Không thể xóa !");
			  }		
			  else
			  {			
					header('Location: index.php?f='.$address);	
					exit;
			  }				
		}


		function SuaLop($conn, $address, $ma_old,$maLop ,$tenLop,$siSo, $maNganh, $sttKhoa,$he)
		{			
			// Làm sạch chuổi nhập vào 	
			
			$ma_old = trim($ma_old);
			$ma_old = strip_tags($ma_old);
			$ma_old = addslashes($ma_old);
			
			$maLop = trim($maLop);
			$maLop = strip_tags($maLop);
			$maLop = addslashes($maLop);
			
			$tenLop = trim($tenLop);
			$tenLop = strip_tags($tenLop);
			$tenLop = addslashes($tenLop);


			$siSo = trim($siSo);
			$siSo = strip_tags($siSo);
			$siSo = addslashes($siSo);

			$maNganh = trim($maNganh);
			$maNganh = strip_tags($maNganh);
			$maNganh = addslashes($maNganh);


			$sttKhoa = trim($sttKhoa);
			$sttKhoa = strip_tags($sttKhoa);
			$sttKhoa = addslashes($sttKhoa);
			
			$he = trim($he);
			$he = strip_tags($he);
			$he = addslashes($he);
						
  			//Kiểm tra nội dung không được rỗng
			 if ( $tenLop == "" ) {
				  	thongBao(" Bạn vui lòng nhập tên cho lớp học!");
  			   }
			  else if ( $sttKhoa == ""  ) {
				  	thongBao(" Bạn vui lòng nhập khóa học!");
  			   }	
			  else if ( $siSo == ""  ) {
				  	thongBao(" Bạn vui lòng nhập khóa học!");
  			   }	
			//kiểm tra là số 
			  else if (!is_numeric( $sttKhoa)) {
				  	thongBao(" Bạn vui lòng nhập khóa học là GIÁ TRỊ SỐ.");
  			  }	   

			  else if (!is_numeric( $siSo)) {
				  	thongBao(" Bạn vui lòng nhập khóa học là GIÁ TRỊ SỐ.");
  			  }	   
			  else{
					//kiem tra trung các Unique và primary		  
					
					
					$sql =   "Select count(*) as sl from lop".
								" where tenLop =  '".$tenLop."' and sttKhoa = ".$sttKhoa." and maLop != '".$ma_old ."'";
					$query = mysqli_query($conn,$sql);
					$data = mysqli_fetch_array($query);	
									
					
				    if($data["sl"]!=0) {		
						   thongBao("Lớp ".$tenLop." khóa ".$sttKhoa." đã bị trùng. Bạn vui lòng kiểm tra lại thông tin.");
					}	
					else   
					{   		  
					   
					  //sua bang CANBO
						$sql = 	"UPDATE lop ".
								" SET tenLop  = '".$tenLop."' ," .
								"	  siSo  = '".$siSo."' ," .
								"	  maNganh = '".$maNganh."' ," .
								"	  sttKhoa = '".$sttKhoa."'" .		
								//"	  he = '".$he."'" .																																
								" where maLop = '".$maLop."'";			

						$query = mysqli_query($conn,$sql); 
						if (!$query){
    						thongBao("Lớp này không thể sửa mã !");
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