<?php
/* vars for export */
// database record to be exported
// optional where query
$where = 'WHERE 1 ORDER BY 1';
// filename for export
// database variables
$hostname = "localhost";
$user = "root";
$password = "";
// Database connecten voor alle services
//$con = mysqli_connect("localhost", "root", "") OR die('check your connection parameters');
$con = mysqli_connect("localhost", "mdc_user", "mdc_user*123#") OR die('check your connection parameters');
$db_name = "mdc_data_entry";

//mysql_select_db($database)
//or die ('Could not select database ' . mysql_error());
mysqli_select_db($con, $db_name);
// create var to be filled with export data
$csv_export = '';
if (!empty($_REQUEST['district_id'])) {
// query to get data from database
    $district_id = $_REQUEST['district_id'];
    $district_name = $_REQUEST['district_name'];
    $csv_filename = "$district_name" . '_' . date('Y-m-d') . '.csv';
    $query = mysqli_query($con, "SELECT FRMID as 'Serial No',SCHOOL_CODE AS Sch_Code,'' as Sch_Name,case datasample.TESTID when 1 then 'Class 5' when 2 then 'Class 6' when 3 then 'Class 7' when 4 then 'Class 8' when 5 then 'Class 9' when 6 then 'Class 10' when 7 then 'Class 11' when 8 then 'Class 12' when 9 then 'Darpan' when 10 then 'Bhaskar' when 11 then 'Class blank' else '' end as Class, '' as Sec, 'OLD' as Paper_code, UPPER(f103) as Name, UPPER(f104) as F_Name, CASE WHEN LENGTH(f1 ) > 1 THEN '' ELSE f1 END Q1, CASE WHEN LENGTH(f2 ) > 1 THEN '' ELSE f2 END Q2, CASE WHEN LENGTH(f3 ) > 1 THEN '' ELSE f3 END Q3, CASE WHEN LENGTH(f4 ) > 1 THEN '' ELSE f4 END Q4, CASE WHEN LENGTH(f5 ) > 1 THEN '' ELSE f5 END Q5, CASE WHEN LENGTH(f6 ) > 1 THEN '' ELSE f6 END Q6,
CASE WHEN LENGTH(f7 ) > 1 THEN '' ELSE f7 END Q7, CASE WHEN LENGTH(f8 ) > 1 THEN '' ELSE f8 END Q8, CASE WHEN LENGTH(f9 ) > 1 THEN '' ELSE f9 END Q9, CASE WHEN LENGTH(f10 ) > 1 THEN '' ELSE f10 END Q10, CASE WHEN LENGTH(f11 ) > 1 THEN '' ELSE f11 END Q11, CASE WHEN LENGTH(f12 ) > 1 THEN '' ELSE f12 END Q12, CASE WHEN LENGTH(f13 ) > 1 THEN '' ELSE f13 END Q13, CASE WHEN LENGTH(f14 ) > 1 THEN '' ELSE f14 END Q14, CASE WHEN LENGTH(f15 ) > 1 THEN '' ELSE f15 END Q15, CASE WHEN LENGTH(f16 ) > 1 THEN '' ELSE f16 END Q16, CASE WHEN LENGTH(f17 ) > 1 THEN '' ELSE f17 END Q17, CASE WHEN LENGTH(f18 ) > 1 THEN '' ELSE f18 END Q18, CASE WHEN LENGTH(f19 ) > 1 THEN '' ELSE f19 END Q19, CASE WHEN LENGTH(f20 ) > 1 THEN '' ELSE f20 END Q20, CASE WHEN LENGTH(f21 ) > 1 THEN '' ELSE f21 END Q21, CASE WHEN LENGTH(f22 ) > 1 THEN '' ELSE f22 END Q22, CASE WHEN LENGTH(f23 ) > 1 THEN '' ELSE f23 END Q23, CASE WHEN LENGTH(f24 ) > 1 THEN '' ELSE f24 END Q24, CASE WHEN LENGTH(f25 ) > 1 THEN '' ELSE f25 END Q25, CASE WHEN LENGTH(f26 ) > 1 THEN '' ELSE f26 END Q26, CASE WHEN LENGTH(f27 ) > 1 THEN '' ELSE f27 END Q27, CASE WHEN LENGTH(f28 ) > 1 THEN '' ELSE f28 END Q28,CASE WHEN LENGTH(f29 ) > 1 THEN '' ELSE f29 END Q29,
CASE WHEN LENGTH(f30 ) > 1 THEN '' ELSE f30 END Q30,
CASE WHEN LENGTH(f31 ) > 1 THEN '' ELSE f31 END Q31,
CASE WHEN LENGTH(f32 ) > 1 THEN '' ELSE f32 END Q32,
CASE WHEN LENGTH(f33 ) > 1 THEN '' ELSE f33 END Q33,
CASE WHEN LENGTH(f34 ) > 1 THEN '' ELSE f34 END Q34,
CASE WHEN LENGTH(f35 ) > 1 THEN '' ELSE f35 END Q35,
CASE WHEN LENGTH(f36 ) > 1 THEN '' ELSE f36 END Q36,
CASE WHEN LENGTH(f37 ) > 1 THEN '' ELSE f37 END Q37,
CASE WHEN LENGTH(f38 ) > 1 THEN '' ELSE f38 END Q38,
CASE WHEN LENGTH(f39 ) > 1 THEN '' ELSE f39 END Q39,
CASE WHEN LENGTH(f40 ) > 1 THEN '' ELSE f40 END Q40,
CASE WHEN LENGTH(f41 ) > 1 THEN '' ELSE f41 END Q41,
CASE WHEN LENGTH(f42 ) > 1 THEN '' ELSE f42 END Q42,
CASE WHEN LENGTH(f43 ) > 1 THEN '' ELSE f43 END Q43,
CASE WHEN LENGTH(f44 ) > 1 THEN '' ELSE f44 END Q44,
CASE WHEN LENGTH(f45 ) > 1 THEN '' ELSE f45 END Q45,
CASE WHEN LENGTH(f46 ) > 1 THEN '' ELSE f46 END Q46,
CASE WHEN LENGTH(f47 ) > 1 THEN '' ELSE f47 END Q47,
CASE WHEN LENGTH(f48 ) > 1 THEN '' ELSE f48 END Q48,
CASE WHEN LENGTH(f49 ) > 1 THEN '' ELSE f49 END Q49,
CASE WHEN LENGTH(f50 ) > 1 THEN '' ELSE f50 END Q50,
CASE WHEN LENGTH(f51 ) > 1 THEN '' ELSE f51 END Q51,
CASE WHEN LENGTH(f52 ) > 1 THEN '' ELSE f52 END Q52,
CASE WHEN LENGTH(f53 ) > 1 THEN '' ELSE f53 END Q53,
CASE WHEN LENGTH(f54 ) > 1 THEN '' ELSE f54 END Q54,
CASE WHEN LENGTH(f55 ) > 1 THEN '' ELSE f55 END Q55,
CASE WHEN LENGTH(f56 ) > 1 THEN '' ELSE f56 END Q56,
CASE WHEN LENGTH(f57 ) > 1 THEN '' ELSE f57 END Q57,
CASE WHEN LENGTH(f58 ) > 1 THEN '' ELSE f58 END Q58,
CASE WHEN LENGTH(f59 ) > 1 THEN '' ELSE f59 END Q59,
CASE WHEN LENGTH(f60 ) > 1 THEN '' ELSE f60 END Q60,
CASE WHEN LENGTH(f61 ) > 1 THEN '' ELSE f61 END Q61,
CASE WHEN LENGTH(f62 ) > 1 THEN '' ELSE f62 END Q62,
CASE WHEN LENGTH(f63 ) > 1 THEN '' ELSE f63 END Q63,
CASE WHEN LENGTH(f64 ) > 1 THEN '' ELSE f64 END Q64,
CASE WHEN LENGTH(f65 ) > 1 THEN '' ELSE f65 END Q65,
CASE WHEN LENGTH(f66 ) > 1 THEN '' ELSE f66 END Q66,
CASE WHEN LENGTH(f67 ) > 1 THEN '' ELSE f67 END Q67,
CASE WHEN LENGTH(f68 ) > 1 THEN '' ELSE f68 END Q68,
CASE WHEN LENGTH(f69 ) > 1 THEN '' ELSE f69 END Q69,
CASE WHEN LENGTH(f70 ) > 1 THEN '' ELSE f70 END Q70,
CASE WHEN LENGTH(f71 ) > 1 THEN '' ELSE f71 END Q71,
CASE WHEN LENGTH(f72 ) > 1 THEN '' ELSE f72 END Q72,
CASE WHEN LENGTH(f73 ) > 1 THEN '' ELSE f73 END Q73,
CASE WHEN LENGTH(f74 ) > 1 THEN '' ELSE f74 END Q74,
CASE WHEN LENGTH(f75 ) > 1 THEN '' ELSE f75 END Q75,
CASE WHEN LENGTH(f76 ) > 1 THEN '' ELSE f76 END Q76,
CASE WHEN LENGTH(f77 ) > 1 THEN '' ELSE f77 END Q77,
CASE WHEN LENGTH(f78 ) > 1 THEN '' ELSE f78 END Q78,
CASE WHEN LENGTH(f79 ) > 1 THEN '' ELSE f79 END Q79,
CASE WHEN LENGTH(f80 ) > 1 THEN '' ELSE f80 END Q80,
CASE WHEN LENGTH(f81 ) > 1 THEN '' ELSE f81 END Q81,
CASE WHEN LENGTH(f82 ) > 1 THEN '' ELSE f82 END Q82,
CASE WHEN LENGTH(f83 ) > 1 THEN '' ELSE f83 END Q83,
CASE WHEN LENGTH(f84 ) > 1 THEN '' ELSE f84 END Q84,
CASE WHEN LENGTH(f85 ) > 1 THEN '' ELSE f85 END Q85,
CASE WHEN LENGTH(f86 ) > 1 THEN '' ELSE f86 END Q86,
CASE WHEN LENGTH(f87 ) > 1 THEN '' ELSE f87 END Q87,
CASE WHEN LENGTH(f88 ) > 1 THEN '' ELSE f88 END Q88,
CASE WHEN LENGTH(f89 ) > 1 THEN '' ELSE f89 END Q89,
CASE WHEN LENGTH(f90 ) > 1 THEN '' ELSE f90 END Q90,
CASE WHEN LENGTH(f91 ) > 1 THEN '' ELSE f91 END Q91,
CASE WHEN LENGTH(f92 ) > 1 THEN '' ELSE f92 END Q92,
CASE WHEN LENGTH(f93 ) > 1 THEN '' ELSE f93 END Q93,
CASE WHEN LENGTH(f94 ) > 1 THEN '' ELSE f94 END Q94,
CASE WHEN LENGTH(f95 ) > 1 THEN '' ELSE f95 END Q95,
CASE WHEN LENGTH(f96 ) > 1 THEN '' ELSE f96 END Q96,
CASE WHEN LENGTH(f97 ) > 1 THEN '' ELSE f97 END Q97,
CASE WHEN LENGTH(f98 ) > 1 THEN '' ELSE f98 END Q98,
CASE WHEN LENGTH(f99 ) > 1 THEN '' ELSE f99 END Q99,
CASE WHEN LENGTH(f100 ) > 1 THEN '' ELSE f100 END Q100,
IMAGE_PATH as 'Front side Image'   
FROM datasample where DISTRICTID=$district_id");

    $field = mysqli_num_fields($query);
// create line with field names
    for ($i = 0; $i < $field; $i++) {
        $csv_export .= mysqli_fetch_field_direct($query, $i)->name . ',';
    }
// newline (seems to work both on Linux & Windows servers)
    $csv_export .= '
';
    while ($row = mysqli_fetch_array($query)) {
        // create line with field values
        for ($i = 0; $i < $field; $i++) {
            $csv_export .= '"' . $row[mysqli_fetch_field_direct($query, $i)->name] . '",';
        }
        $csv_export .= '
';
    }
// Export the data and prompt a csv file for download
    header("Content-type: text/x-csv");
    header("Content-Disposition: attachment; filename=" . $csv_filename . "");
    echo($csv_export);
}
?>