public function outexcel(){

    @set_time_limit(0);
    @ini_set("memory_limit",'-1');//是否内存限制654309
    header('Content-Type: application/vnd.ms-execl');
    header('Content-Disposition: attachment;filename="1024.csv"');

    //打开php标准输出流
    //以写入追加的方式打开
    $fp = fopen('php://output', 'a');

    for($s = 1; $s <= 100; ++$s) {
        $start = ($s - 1) * 10000;
        $result = select();
        if ($result) {
            foreach ($result as $k => $row) {
                foreach ($row as $key => $item) {
                    //这里必须转码，不然会乱码
                    $row[$key] = iconv('UTF-8', 'GBK', $item);
                }
                fputcsv($fp, $row);
            }
            ob_flush();
            flush();
        }
    }
}