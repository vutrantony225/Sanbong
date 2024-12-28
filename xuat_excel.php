<?php
require 'vendor/autoload.php'; // Thư viện PhpSpreadsheet
require 'config.php'; // Kết nối cơ sở dữ liệu

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Tạo một Spreadsheet mới
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Thiết lập tiêu đề cột
$sheet->setCellValue('A1', 'Mã đặt');
$sheet->setCellValue('B1', 'Tên sân');
$sheet->setCellValue('C1', 'Tên khách hàng');
$sheet->setCellValue('D1', 'Giờ đặt');
$sheet->setCellValue('E1', 'Giờ trả');
$sheet->setCellValue('F1', 'Trạng thái');
$sheet->setCellValue('G1', 'Thành tiền');

// Lấy dữ liệu từ cơ sở dữ liệu
$sql = "SELECT sanbong.TenSan, datsan.* 
        FROM datsan INNER JOIN sanbong 
        ON sanbong.ID = datsan.IDSan";
$result = mysqli_query($conn, $sql);

$rowIndex = 2; // Bắt đầu từ hàng thứ 2 để ghi dữ liệu
while ($row = mysqli_fetch_assoc($result)) {
    // Lấy tên khách hàng
    $tenkh = $row['TenTK'];
    $sql2 = "SELECT khachhang.TenKH 
             FROM khachhang INNER JOIN taikhoan
             ON khachhang.Email = taikhoan.Email
             WHERE TenTK = '$tenkh'";
    $result2 = $conn->query($sql2);
    $tenKH = ($result2 && $row2 = $result2->fetch_assoc()) ? $row2['TenKH'] : 'Không có thông tin';

    // Xác định trạng thái thanh toán
    $trangThai = ($row['DaThanhToan'] == 1) ? 'Đã thanh toán' : 'Chờ xác nhận';

    // Ghi dữ liệu vào Excel
    $sheet->setCellValue('A' . $rowIndex, $row['MaDat']);
    $sheet->setCellValue('B' . $rowIndex, $row['TenSan']);
    $sheet->setCellValue('C' . $rowIndex, $tenKH);
    $sheet->setCellValue('D' . $rowIndex, $row['GioDat']);
    $sheet->setCellValue('E' . $rowIndex, $row['GioTra']);
    $sheet->setCellValue('F' . $rowIndex, $trangThai);
    $sheet->setCellValue('G' . $rowIndex, $row['ThanhTien']);
    $rowIndex++;
}

// Định dạng cột ngày, giờ
foreach (range('A', 'G') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Xuất tệp Excel
$filename = "ThongKe_DatSan_" . date('Ymd_His') . ".xlsx";
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"$filename\"");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit();
?>
