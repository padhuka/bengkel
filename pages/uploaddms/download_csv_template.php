<?php

// Bersihkan seluruh output buffer
if (ob_get_length()) ob_end_clean();
ob_clean();

header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=\"Template_Upload_DMS_" . date("Y-m-d") . ".csv\"");
header("Cache-Control: no-cache, must-revalidate");

$output = fopen("php://output", "w");

// Write simple CSV without quotes
$headers = ["NOPKB", "Tgl PKB", "Unit", "Nopol", "Jml Panel", "Harga Panel" ];

// Write header without quotes
fwrite($output, implode(",", $headers) . "\n");

// Sample data without quotes (with examples showing NOPKB transformation)
$sampleData = [
    ["BR.030125.008206", "01/01/2024", "Honda BRIO", "B 1234 ABC", 2, 500000],
    ["BR.030126.009207", "02/01/2024", "Toyota Veloz", "B 5678 XYZ", 1.5, 750000],
    ["PKB_BR.030127.010308", "03/01/2024", "Suzuki Ertiga", "B 9012 DEF", 2.75, 450000]
];

foreach ($sampleData as $row) {
    // Write row without quotes
    fwrite($output, implode(",", $row) . "\n");
}

fclose($output);
exit();
?>