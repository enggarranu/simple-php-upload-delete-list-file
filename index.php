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
        form {
            width: 300px;
            margin-top: 20px;
            margin-right: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        body {
            font-family: Arial, sans-serif;
            justify-content: flex-end; /* Memindahkan elemen ke kanan */
            align-items: flex-start; /* Menyusun elemen di bagian atas */
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
        }
        input[type="submit"] {
            background-color: #d22e2e;
            color: white;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>Directory Listing</h2>
    <form action="logout.php">
        <input type="submit" value="Logout from this session" />
    </form>
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
                    if ($file != '.' && $file != '..' && $file != 'index.php' && !preg_match('/.*process.*/', $file) && $file != 'login.php' && $file != 'logout.php') {
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
