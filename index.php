<?php
// Mulai session
session_start();

// Periksa apakah pengguna belum login
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    // Arahkan pengguna ke halaman login
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directory Listing</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .btn-group {
            display: flex;
        }
        .btn-group form {
            margin-right: 10px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        a {
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
            background-color: #2ed267; /* Warna hijau */
            color: white;
            cursor: pointer;
        }
        .delete-btn {
            background-color: #d22e2e; /* Warna merah */
            color: white;
            cursor: pointer;
        }
        .back-btn {
            background-color: #007bff; /* Warna biru */
            color: white;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Directory /</h2>
        <div class="btn-group">
            <form action="../form_upload.php">
                <input type="submit" value="Upload" />
            </form>
            <form action="../logout.php">
                <input type="submit" value="Logout from this session" />
            </form>
        </div>
    </div>
    <table>
        <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Size (Bytes)</th>
        </tr>
        <?php
        // Get current directory path
        $directory = __DIR__;

        // Open a directory, and read its contents
        if (is_dir($directory)) {
            if ($dh = opendir($directory)) {
                while (($file = readdir($dh)) !== false) {
                    // Exclude current directory (.) and parent directory (..)
                    if ($file != '.' && $file != '..' && $file != 'index.php' && !preg_match('/.*process.*/', $file) && $file != 'login.php' && $file != 'logout.php' && $file != 'form_upload.php' && $file != '.git') {
                        // Determine file type
                        $type = filetype($directory . '/' . $file);
                        // Get file size
                        $size = filesize($directory . '/' . $file);
                        // Output file name as a link
                        echo "<tr>
                                <td><a href=\"$file\">$file</a></td>
                                <td>$type</td>
                                <td>$size</td>
                              </tr>";
                    }
                }
                closedir($dh);
            }
        }
        ?>
    </table>
</body>
</html>
