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
    <title>File Upload</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        #progress {
            width: 500px;
            border: 1px solid #ddd;
            padding: 5px;
            margin-top: 20px;
            display: none;
        }
        #bar {
            width: 0%;
            height: 20px;
            background-color: #4caf50;
            text-align: center;
            line-height: 20px;
            color: white;
        }
    </style>
</head>
<body>
    <h2>File Upload</h2>
    <form id="uploadForm" enctype="multipart/form-data">
        <input type="file" name="file" id="file">
        <button type="submit">Upload</button>
    </form>
    <div id="progress">
        <div id="bar"></div>
    </div>

    <script>
        $(document).ready(function(){
            $('#uploadForm').submit(function(event){
                event.preventDefault();
                var formData = new FormData($(this)[0]);
                
                $.ajax({
                    url: 'upload_process.php', // File PHP yang menangani proses upload
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function(e) {
                            if (e.lengthComputable) {
                                var percent = Math.round((e.loaded / e.total) * 100);
                                $('#progress').show();
                                $('#bar').css('width', percent + '%').html(percent + '%');
                            }
                        });
                        return xhr;
                    },
                    success: function(data){
                        // Proses upload selesai
                        $('#progress').hide();
                        alert(data); // Pesan dari server setelah upload selesai
			window.location.href = "uploads/";
                    }
                });
            });
        });
    </script>
</body>
</html>

