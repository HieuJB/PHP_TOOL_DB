<?php
    require_once ('config.php');
    /**
     * mã hóa Md5 
     */
    function encodeMd5($pwd) {
        return md5(md5($pwd).MD5_PRIVATE_KEY);
    }
    /**
     * Lấy giá trị GET
     */
    function getGET($key) {
        $value = '';
        if (isset($_GET[$key])) {
            $value = $_GET[$key];
        }
        $value = fixSqlInjection($value);
        return $value;
    }
    /**
     * Lấy giá trị POST
     */
    function getPOST($key) {
        $value = '';
        if (isset($_POST[$key])) {
            $value = $_POST[$key];
        }
        $value = fixSqlInjection($value);
        return $value;
    }
    
    function fixSqlInjection($str) {
        $str = str_replace("\\", "\\\\", $str);
        $str = str_replace("'", "\'", $str);
        return $str;
    }
    /**
     * Su dung cho lenh: insert/update/delete
     */
    function insertOrupdateOrdelete($sql) {
        // Them du lieu vao database
        //B1. Mo ket noi toi database
        $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
        mysqli_set_charset($conn, 'utf8');
    
        //B2. Thuc hien truy van insert
        mysqli_query($conn, $sql);
    
        //B3. Dong ket noi database
        mysqli_close($conn);
    }
    /**
     * Su dung cho lenh: select
     */
    function selectAll($sql) {
        // Them du lieu vao database
        //B1. Mo ket noi toi database
        $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
        mysqli_set_charset($conn, 'utf8');
    
        //B2. Thuc hien truy van insert
        $resultset = mysqli_query($conn, $sql);
        $data      = [];
    
        while (($row = mysqli_fetch_array($resultset, 1)) != null) {
            $data[] = $row;
        }
    
        //B3. Dong ket noi database
        mysqli_close($conn);
    
        return $data;
    }
    function selectSingle($sql) {
        // Them du lieu vao database
        //B1. Mo ket noi toi database
        $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
        mysqli_set_charset($conn, 'utf8');
    
        //B2. Thuc hien truy van insert
        $resultset = mysqli_query($conn, $sql);
        
        $data = $resultset-> fetch_assoc();
    
        //B3. Dong ket noi database
        mysqli_close($conn);
    
        return $data;
    }
?>