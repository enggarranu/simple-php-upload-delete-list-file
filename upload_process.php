<?php
// Lokasi direktori untuk menyimpan file yang diunggah
$uploadDirectory = 'uploads/';

// Mengecek apakah ada file yang diunggah
if(isset($_FILES['file'])){
    $file = $_FILES['file'];

    // Mendapatkan nama file
    $fileName = $file['name'];

    // Menyimpan file ke direktori yang ditentukan
    if(move_uploaded_file($file['tmp_name'], $uploadDirectory . $fileName)){
        echo "File berhasil diunggah: " . $fileName;
    }else{
        echo "Gagal mengunggah file.";
    }
}else{
    echo "Tidak ada file yang diunggah.";
}
?>

