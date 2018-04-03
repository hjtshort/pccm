<?php
include './Classes/PHPExcel.php';
include './Classes/PHPExcel/IOFactory.php';
require_once 'db.php';



class xuat_khoahoc{

public $lama = array('I','II','III','IV','V','VI');


function __construct($sttk,$maNganh,$he){
$this->sttk = $sttk;
$this->manganh = $maNganh;
$this->he = $he;
}

function get_hocki()
{

	$db = new db();
	$hks = array();
	$hk = $db->mysql->query("select distinct hocKi from chuongtrinhhoc where sttKhoa = '{$this->sttk}' and maNganh = '{$this->manganh}' and he={$this->he} order by hocKi");
	while ($row= $hk->fetch_assoc()) {
		$hks[] = $row['hocKi'];
	}
	return $hks;
}


function get_dsmon($hocki)
{
	$db = new db();
	
	$dt = $db->mysql->query("select * from chuongtrinhhoc join monhoc on chuongtrinhhoc.maMon = monhoc.maMon where sttKhoa = '{$this->sttk}' and maNganh='{$this->manganh}' and hocKi='{$hocki}' and he='{$this->he}'");
	return $dt;
}


function get_ten_ghanh()
{
	$db = new db();
	
	$ex = $db->mysql->query("select tenNganh from nganh where maNganh='{$this->manganh}'");
	if($value = $ex->fetch_assoc())
	{
		return $value['tenNganh'];
	}
	return '';

}

function get_nienkhoa()
{
	$db = new db();
	$ex = $db->mysql->query("select min(namhoc) as namhoc from chuongtrinhhoc where sttKhoa = '{$this->sttk}' and maNganh='{$this->manganh}' and he='{$this->he}'");
	if($value = $ex->fetch_assoc())
	{
		return '('.$value['namhoc'].' - '.(intval($value['namhoc'])+3).')';
	}
	return '';
}

function get_tenkhoa()
{
	$db = new db();
	$ex = $db->mysql->query("select DISTINCT tenKhoa from nganh INNER join bomon on nganh.maBm=bomon.maBm INNER JOIN  khoa on bomon.maKhoa=khoa.maKhoa where nganh.maNganh={$this->manganh}");
	if($value = $ex->fetch_assoc()){
		return $value['tenKhoa'];
	}
	return '';
}


function xuly(){
	
	$excel = new PHPExcel();

$excel->setActiveSheetIndex(0);

$excel->getDefaultStyle()->getFont()->setName('Times New Roman');
$excel->getDefaultStyle()->getFont()->setSize(13);
$excel->getActiveSheet()->setTitle('Bảng kế hoạch giảng dạy');


$excel->getActiveSheet()->getStyle('A1:J1')->getFont()->setBold(true);
$excel->getActiveSheet()->getStyle('A2:J2')->getFont()->setBold(true);

$excel->setActiveSheetIndex(0)->setCellValue('A1','TRƯỜNG CAO ĐẲNG CẦN THƠ')->setCellValue('F1', 'CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM')->setCellValue('A2',$this->get_tenkhoa())->setCellValue('F2', 'Độc lập - Tự do - Hạnh phúc');

$excel->getActiveSheet()->mergeCells('F2:J2');
$excel->getActiveSheet()->getStyle('F2:J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


$excel->setActiveSheetIndex(0)->setCellValue('A4','KẾ HOẠCH GIẢNG DẠY HỆ CAO ĐẲNG - KHÓA '.$this->sttk.'')->setCellValue('A5','Nghành đào tạo: '.$this->get_ten_ghanh().'    Mã Nghành: '.$this->manganh.'')->setCellValue('A6','Khóa học '.$this->sttk.' '.$this->get_nienkhoa().'');

$excel->getActiveSheet()->mergeCells('A4:J4');
$excel->getActiveSheet()->mergeCells('A5:J5');
$excel->getActiveSheet()->mergeCells('A6:J6');
$excel->getActiveSheet()->getStyle('A4:J4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->getActiveSheet()->getStyle('A5:J5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->getActiveSheet()->getStyle('A6:J6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$excel->getActiveSheet()->getStyle('A4:J4')->getFont()->setBold(true);
$excel->getActiveSheet()->getStyle('A5:J5')->getFont()->setBold(true);
$excel->getActiveSheet()->getStyle('A6:J6')->getFont()->setBold(true);


$working_start_row = "A8";
 $ds = array();

array_push($ds,array('t1'=>'STT','t2'=> 'Mã học phần/ môn học','t3'=>'Tên học phần/ môn học','t4'=>'Số TC/ ĐVHT','t5' => 'Bắt buộc','t6' => 'Tự chọn','t7'=>'Tổng số tiết','t8'=>'Số tiết LT','t9'=>'Số tiết BT/TH','t10' => 'Kiểm tra'));

$dimstart = 8;
$hocki = $this->get_hocki();
$next = 0;
$rows = 0;
if (is_array($hocki) || is_object($hocki))
{
    foreach ($hocki as $hk) {
    $data = $this->get_dsmon($hk);
	$rows = 1;
	// $excel->setActiveSheetIndex(0)->setCellValue('A'.$dimstart -1 ,'KẾ HOẠCH GIẢNG DẠY HỆ CAO ĐẲNG - KHÓA 42')->setCellValue('A5','Nghành đào tạo: Tin học ứng dụng    Mã Nghành: 6480205')->setCellValue('A6','Khóa học 42 (2017-2020)');
	array_unshift($ds, array('t1'=>'HỌC KỲ '.$this->lama[$hk-1].': ………….. TC/ĐVHT (Bắt buộc: ………….TC/ ĐVHT, Tự chọn:…0…… TC/ ĐVHT)'));
	while ($row = $data->fetch_assoc() ) {
		$ds[] = array('STT' => $rows,'mahocphan'=>$row['maMon'],'tenmon'=>$row['tenMon'],'sotc' =>$row['soTc'],'batbuoc'=>$row['batbuoc'],'tuchon'=>$row['tuchon'],'tongsotiet'=>($row['soTietLt']+$row['soTietTh']),'sotietlt'=>$row['soTietLt'],'sot_th' => $row['soTietTh'],'kt'=> '');
		$rows++;
	    
	}

	
	// echo $working_start_row.':J'.($rows+$dimstart);
	// die();
	
	$excel->getActiveSheet()->getStyle($working_start_row.':J'.($rows+$dimstart))->applyFromArray(
    array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => array('rgb' => '000000')
            )
        )
    )
);

	$next = $rows+$dimstart;
	$dimstart = $next+2;
	
	


$excel->getActiveSheet()->fromArray($ds,NULL,$working_start_row);

$working_start_row = "A".($next +=2);
$ds = array();
// array_push($ds,array('t1'=>'HỌC KỲ '.$lama[$hk+1].' : ……23…….. TC/ĐVHT (Bắt buộc: ……23…….TC/ ĐVHT, Tự chọn:…0…… TC/ ĐVHT)'));
$ds[] =  array('t1'=>'STT','t2'=> 'Mã học phần/ môn học','t3'=>'Tên học phần/ môn học','t4'=>'Số TC/ ĐVHT','t5' => 'Bắt buộc','t6' => 'Tự chọn','t7'=>'Tổng số tiết','t8'=>'Số tiết LT','t9'=>'Số tiết BT/TH','t10' => 'Kiểm tra');

}
}





// $rows  = 1;
// while($row = $data->fetch_assoc())
// {

// 	$ds[] = array('STT' => $rows,'mahocphan'=>$row['maMon'],'tenmon'=>$row['tenMon'],'sotc' =>$row['soTc'],'batbuoc'=>'','tuchon'=>'','tongsotiet'=>'','sotietlt'=>$row['soTietLt']);

// 	$rows++;
// }
#$excel->getActiveSheet()->fromArray($ds,NULL,$working_start_row);

header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="'.$this->get_ten_ghanh().$this->get_nienkhoa().'.xls"');
PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');

}





}






?>
