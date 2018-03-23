<?php
	require_once("lib/connection.php");
	require_once("lib/UserInfo.php");
	
	include 'Classes/PHPExcel.php';
	include 'Classes/PHPExcel/IOFactory.php';
	
	$objPHPExcel = new PHPExcel();
	
	$objPHPExcel->getDefaultStyle()->getFont()->setName('Times New Roman');

	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(18);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(28);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(11);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(8);
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(8);
	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(8);
	$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(8);
	$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(8);
	$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(8);
	$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(8);
	$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(8);
	$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(8);
	$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(8);	
	$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(8);
	$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(8);
	
	//chieu cao

	
	
	$objPHPExcel->getActiveSheet()->getStyle('F1:R1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('A2:R2')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('A2:R2')->getFont()->setUnderline(true);
	$objPHPExcel->getActiveSheet()->getStyle('A5:R5')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('A6:R6')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('A8:R9')->getFont()->setBold(true);
	
	$objPHPExcel->getActiveSheet()->getStyle('A4:Q4')->getFont()->setItalic(true);

	$objPHPExcel->getActiveSheet()->getStyle('B:F')->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('B')->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('K')->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('D8:Q9')->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('R')->getAlignment()->setWrapText(true);
	
	//Cho phép cột ghi chú xuống hàng
	$objPHPExcel->getActiveSheet()->getStyle('Q:Q')->getAlignment()->setWrapText(true);

	$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->getAlignment()
				->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('A2:Q2')->getAlignment()
				->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('A5:Q6')->getAlignment()
				->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				
	$objPHPExcel->getActiveSheet()->getStyle('F:Q')->getAlignment()
				->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				
	$objPHPExcel->getActiveSheet()->getStyle('A:B')->getAlignment()
				->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);			

	$objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()
				->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);			

	$objPHPExcel->getActiveSheet()->getStyle('H4:Q4')->getAlignment()
				->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);			
				
	$objPHPExcel->getActiveSheet()->getStyle('A8:Q9')->getAlignment()
				->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		//Canh giữa theo chiều đứng của ô cột ghi chú
	$objPHPExcel->getActiveSheet()->getStyle('Q:Q')->getAlignment()
				->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);		

	$objPHPExcel->getActiveSheet()->getStyle('H4:Q4')->getAlignment()
				->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);		
	$objPHPExcel->getActiveSheet()->getStyle('A:B')->getAlignment()
				->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);		

	$objPHPExcel->getActiveSheet()->getStyle('A8:R9')->getAlignment()
				->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				
	$objPHPExcel->getActiveSheet()->getStyle('A8:R9')->getAlignment()
				->setVertical(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
			
			

	$objPHPExcel->getActiveSheet()->mergeCells('A1:D1'); // for example, mergeCells('A1:F1')
	$objPHPExcel->getActiveSheet()->mergeCells('F1'  . ':' . 'Q1'); // for example, mergeCells('A1:F1')
	$objPHPExcel->getActiveSheet()->mergeCells('A2:D2'); // for example, mergeCells('A1:F1')
	$objPHPExcel->getActiveSheet()->mergeCells('F2'  . ':' . 'Q2'); // for example, mergeCells('A1:F1')
	$objPHPExcel->getActiveSheet()->mergeCells('H4:Q4'); // for example, mergeCells('A1:F1')
	$objPHPExcel->getActiveSheet()->mergeCells('A5:Q5'); // for example, mergeCells('A1:F1')
	$objPHPExcel->getActiveSheet()->mergeCells('A6:Q6'); // for example, mergeCells('A1:F1')
	$objPHPExcel->getActiveSheet()->mergeCells('A8:A9'); // for example, mergeCells('A1:F1')
	$objPHPExcel->getActiveSheet()->mergeCells('B8:B9'); // for example, mergeCells('A1:F1')\
	$objPHPExcel->getActiveSheet()->mergeCells('C8:C9'); // for example, mergeCells('A1:F1')
	$objPHPExcel->getActiveSheet()->mergeCells('D8:D9'); // for example, mergeCells('A1:F1')
	$objPHPExcel->getActiveSheet()->mergeCells('E8:E9'); // for example, mergeCells('A1:F1')
	$objPHPExcel->getActiveSheet()->mergeCells('F8:F9'); // for example, mergeCells('A1:F1')
	$objPHPExcel->getActiveSheet()->mergeCells('G8:H8'); // for example, mergeCells('A1:F1')
	
	$objPHPExcel->getActiveSheet()->mergeCells('I8:J8'); // for example, mergeCells('A1:F1')
	$objPHPExcel->getActiveSheet()->mergeCells('K8:K9'); // for example, mergeCells('A1:F1')
	$objPHPExcel->getActiveSheet()->mergeCells('L8:L9'); // for example, mergeCells('A1:F1')
	$objPHPExcel->getActiveSheet()->mergeCells('M8:M9'); // for example, mergeCells('A1:F1')
	$objPHPExcel->getActiveSheet()->mergeCells('N8:N9'); // for example, mergeCells('A1:F1')
	$objPHPExcel->getActiveSheet()->mergeCells('O8:O9'); // for example, mergeCells('A1:F1')
	$objPHPExcel->getActiveSheet()->mergeCells('P8:P9'); // for example, mergeCells('A1:F1')
	$objPHPExcel->getActiveSheet()->mergeCells('Q8:Q9'); // for example, mergeCells('A1:F1')
	$objPHPExcel->getActiveSheet()->mergeCells('R8:R9'); // for example, mergeCells('A1:F1')
	




	$now = getdate();
	$ngay=$now["mday"];
	$nam=$now["year"];
	$thang=$now["mon"];

	$chuoi	= $_SESSION['idMau'];
	$ma =explode(" ",$chuoi);//Tach các cot
	$maBm=$ma[0]; 
	$namHoc=$ma[1];
	$namHoc1=$namHoc+1;
	
	$sql_Bm="select * from bomon where maBm='".$maBm."'";
	$query_Bm = mysqli_query($conn,$sql_Bm);
	$data_Bm = mysqli_fetch_array($query_Bm);
	
	$sql_Khoa="select * from khoa where maKhoa='".$data_Bm["maKhoa"]."'";
	$query_Khoa = mysqli_query($conn,$sql_Khoa);
	$data_Khoa = mysqli_fetch_array($query_Khoa);
	


	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A1', strtoupper($data_Khoa["tenKhoa"]))
				->setCellValue('F1', 'CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM')
				->setCellValue('A2', 'BỘ MÔN '.strtoupper($data_Bm["tenBm"]))
				->setCellValue('F2', 'Độc lập - Tự do - Hạnh phúc')
				->setCellValue('H4', 'Cần Thơ, ngày '.$ngay. ' tháng '.$thang. ' năm '. $nam)
				->setCellValue('A5', 'PHÂN CÔNG CHUYÊN MÔN VÀ CÔNG TÁC')
				->setCellValue('A6', 'NĂM HỌC: '.$namHoc.' -'. $namHoc1)	;
				
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A8', 'TT')
				->setCellValue('B8', 'Họ và tên')
				->setCellValue('C8', 'Môn dạy/Công tác')
				->setCellValue('D8', 'Số lượng HSSV')
				->setCellValue('E8', 'Lớp/Địa điểm')
				->setCellValue('F8', 'Số TC/ ĐVHT')
				->setCellValue('G8', 'Phân bổ')
				->setCellValue('G9', 'HKI')
				->setCellValue('H9', 'HKII')
				->setCellValue('I8', 'Số tiết thực dạy')
				->setCellValue('I9', 'LT')
				->setCellValue('J9', 'TH,TT')

				->setCellValue('K8', 'NCKH')
				->setCellValue('L8', 'TTGV (Th.te của GV')
				->setCellValue('M8', 'CVHT/GVCN')
				->setCellValue('N8', 'Đoàn thể')
				->setCellValue('O8', 'Chức vụ')
				->setCellValue('P8', 'Hoạt động khác')
				->setCellValue('Q8', 'Tổng sau qui đổi')
				->setCellValue('R8', 'Ghi chú')
				
				;
				
	
			
$objPHPExcel->getActiveSheet()->getStyle('A8:R9')
->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

	
	$sql_hienThi= "SELECT * FROM canbo ".
				" where maBm='".$maBm."'".
				" order by tenCb";
	$query_hienThi = mysqli_query($conn,$sql_hienThi);	

	
	$i=10;
	$stt=0;
	while($row=mysqli_fetch_array($query_hienThi)) {
		$i1=$i;
		$tongTiet=0;
		$stt++;
		$sql_DtGiam="SELECT * FROM canbogiam a, doituonggiam b".
								" where a.maCb='".$row['maCb']."'".
								"and a.namHoc='".$namHoc."'".
								"and a.maDt=b.maDt";			
		$chuoiGiam='';						
		$query_DtGiam = mysqli_query($conn,$sql_DtGiam);
		$num_DtGiam = mysqli_num_rows($query_DtGiam);	
			if ($num_DtGiam>0){
					$row_DtGiam = mysqli_fetch_array($query_DtGiam);
					$chuoiGiam= $row_DtGiam["tenDt"];
			}

		$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$i, $stt)
				->setCellValue('R'.$i, $chuoiGiam)
				->setCellValue('B'.$i, $row['hoCb']." ".$row['tenCb']);


		
		
				
				
		//NCKH		
		$sql_nckh="SELECT * FROM nckh nc".
					" where nc.maCb='".$row['maCb']."'".
					"and nc.namHoc='".$namHoc."'";			
								
		$query_nckh = mysqli_query($conn,$sql_nckh);
		$num_nckh = mysqli_num_rows($query_nckh);	
		$nc='';				
		if ($num_nckh>0) $nc='NCKH';//có nckh thì bật biến nc=1		
		
		///TBG
		$sql_tbg="SELECT * FROM tapbaigiang tbg".
				" where tbg.maCb='".$row['maCb']."'".
				"and tbg.namHoc='".$namHoc."'";			
					
		$query_tbg = mysqli_query($conn,$sql_tbg);
		$num_tbg = mysqli_num_rows($query_tbg);	
		if ($num_tbg>0) $nc.=' TBG';
		
				$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('K'.$i,$nc);
		
				
				
		//Day
		$sql_hienThi= "SELECT * FROM pcday d, lop l, monhoc mh".
								" where d.maLop=l.malop".
								" and d.maCb='".$row['maCb']."'".
								" and d.namHoc='".$namHoc."'".
								" and d.maMon=mh.maMon";
		$query = mysqli_query($conn,$sql_hienThi);		
		
		$sc= mysqli_num_rows($query);	

		$j=$i1+$sc-1;
		

		
		
		


		while ($row_sl = mysqli_fetch_array($query)){
			
				$tongtam=0;
						  		if ($row_sl["he"]==2) $tongtam=($row_sl["soTietLt"]+$row_sl["soTietTh"])*0.7;
								else {
										if ($row_sl["siSo"]<=50) $tongtam=($row_sl["soTietLt"]+$row_sl["soTietTh"]);
										else if ($row_sl["siSo"]<=80)
											 $tongtam=($row_sl["soTietLt"]*1.1+$row_sl["soTietTh"]);												
										else 	 $tongtam=($row_sl["soTietLt"]*1.2+$row_sl["soTietTh"]);
									}	
								$tongTiet+=$tongtam;		//tong qui đổi
					if ($row_sl["he"]==1) $he="CĐ"; else $he="TC";

		
			
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('C'.$i,$row_sl['tenMon'])
					->setCellValue('D'.$i,$row_sl['siSo'])
					->setCellValue('E'.$i,$he." ".$row_sl['tenLop'].' K '.$row_sl['sttKhoa'])			
					->setCellValue('F'.$i,$row_sl['soTc'])
					->setCellValue('I'.$i,$row_sl['soTietLt'])
					->setCellValue('J'.$i,$row_sl['soTietTh'])
					->setCellValue('Q'.$i,$tongtam);
					
		$tong=$row_sl['soTietLt']+$row_sl['soTietTh'];			
		if ($row_sl["hocKi"]==1){ 
				$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('G'.$i,$tong);
		}
		if ($row_sl["hocKi"]==2){ 
				$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('H'.$i,$tong);
		}
			
			
					
		$i=$i+1;
		}//end while $row_sl
		//chu nhiem
		 /////CVHT
					$sql_Covan="SELECT * FROM cvht, lop".
								" where maCb='".$row['maCb']."'".
								"and namHoc='".$namHoc."'".
								"and cvht.maLop=lop.maLop";
								
					$query_Covan = mysqli_query($conn,$sql_Covan);				
					
		while ($row_Covan = mysqli_fetch_array($query_Covan)){
				if ($row_Covan["he"]==1) $chuoi="Cao đẳng"; else $chuoi="Trung cấp";
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('M'.$i,$chuoi." ".$row_Covan["tenLop"]."-K".$row_Covan["sttKhoa"])
						->setCellValue('Q'.$i,'62.4');
						
			$tongTiet+=62.4;			
			$i=$i+1;
		}//end while co van
		 /////Chuc vu
		$sql_ChucVu="SELECT * FROM chucvugiangvien a, chucvu b".
					" where a.maCb='".$row['maCb']."'".
					"and b.maCv=a.maCv";
								
		$query_ChucVu = mysqli_query($conn,$sql_ChucVu);				
		while ($row_ChucVu = mysqli_fetch_array($query_ChucVu)){
			
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('M'.$i,$row_ChucVu["tenCv"])
						->setCellValue('Q'.$i,$row_ChucVu["soTiet"]);
						
									$tongTiet+=$row_ChucVu["soTiet"];			
						$i=$i+1;
						
		//Đối tượng giảm

			 				
						
						
		}//end while chuc vu	
		//Tổng tiết nghĩa vụ
		$sql_DtGiam="SELECT * FROM canbogiam a, doituonggiam b".
								" where a.maCb='".$row["maCb"]."'".
								"and a.namHoc='".$namHoc."'".
								"and a.maDt=b.maDt";			
								
		$query_DtGiam = mysqli_query($conn,$sql_DtGiam);
		$num_DtGiam = mysqli_num_rows($query_DtGiam);	
		$row_DtGiam = mysqli_fetch_array($query_DtGiam);
			
					//Tính tiết nghĩa vụ
		$tc=520;

					
		if ($num_DtGiam>0) $tc-=$row_DtGiam["soTietGiam"];		

				$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('C'.$i,"Tiết nghĩa vụ")
						->setCellValue('D'.$i,$tc)
						->setCellValue('N'.$i,"Tổng số")
						->setCellValue('Q'.$i,$tongTiet);
				$objPHPExcel->getActiveSheet()->getStyle('C'.$i.':Q'.$i)->getFont()->setBold(true);
		$j1=$i;
		$objPHPExcel->getActiveSheet()->mergeCells('B' . (string)($i1) . ':' . 'B' . (string)($j1)); // for example, mergeCells('A1:F1')				
		$objPHPExcel->getActiveSheet()->mergeCells('A' . (string)($i1) . ':' . 'A' . (string)($j1)); // for example, mergeCells('A1:F1')				


		

$BStyle = array(
  'borders' => array(
    'allborders' => array(
      'style' => PHPExcel_Style_Border::BORDER_THIN
    )
  )
);
$objPHPExcel->getActiveSheet()->getStyle('A8:R9')->applyFromArray($BStyle);
$objPHPExcel->getActiveSheet()->getStyle('A' . (string)($i1) . ':' . 'R' . (string)($j1))->applyFromArray($BStyle);

		///thiết lập trang in
		$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);



		
		$i=$i+1;

				$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A'.$i,"");

		$i=$i+1;
	}//endwhile
	 $i=$i+1;
	 $objPHPExcel->getActiveSheet()->mergeCells('A' . (string)($i) . ':' . 'B' . (string)($i)); // for example, mergeCells('A1:F1')				
 	 $objPHPExcel->getActiveSheet()->mergeCells('F' . (string)($i) . ':' . 'M' . (string)($i)); // for example, mergeCells('A1:F1')				
  	 $objPHPExcel->getActiveSheet()->mergeCells('N' . (string)($i) . ':' . 'Q' . (string)($i)); // for example, mergeCells('A1:F1')				
	 
	 $objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A'.$i,"PHÓ HIỆU TRƯỞNG")
						->setCellValue('E'.$i,"PHÒNG QL.ĐÀO TẠO")
						->setCellValue('F'.$i, strtoupper($data_Khoa["tenKhoa"]))
						->setCellValue('N'.$i,'BỘ MÔN '.strtoupper($data_Bm["tenBm"]));
	$objPHPExcel->getActiveSheet()->getStyle('A'.$i.':Q'.$i)->getFont()->setBold(true);
	 $i=$i+1;

	$chuoi="Phân công chuyên môn ngày"." ".$ngay." tháng ".$thang. " năm ".$nam.".xlsx";
	
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename='.$chuoi);
	header('Cache-Control: max-age=0');
	 
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
?>