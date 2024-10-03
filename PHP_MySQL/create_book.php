<?php
    $image_fieldname = "image_file";
            isset($_FILES[$image_fieldname]) or die("No data to insert into bookstore database");
            $imgFile = $_FILES[$image_fieldname];
            $mysqli = new mysqli("127.0.0.1", "root", "", "bookstore");
            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            }
            $mysqli->select_db("bookstore");
            // Check image file
            check_upload_img_file($imgFile);
            // Save book to table 'books'
            if(isset($_POST["title"]) && isset($_POST["introduction"])) { 
                insert_book($_POST["title"], $_POST["introduction"], $mysqli);
            }else{
                echo "Books information is required";
                exit();
            }
            // Inserted image file into DB
            insert_image_to_db($imgFile, $mysqli);
            function insert_book($title, $intro, $mysqli){
                $stm = $mysqli->prepare("INSERT INTO books (title, introduction) values(?,?)");
                $stm->bind_param("ss", $title, $intro);
                if($stm->execute()) {
                echo "The book was inserted! with id=".$mysqli->insert_id;
                }else{
                echo "Error: ".$stm->error;
                }
                $stm->close();
                }
                function check_upload_img_file($imgFile) {
                $php_errors = array (UPLOAD_ERR_INI_SIZE=>'Maximum file size in php.ini exceeded',
                                    UPLOAD_ERR_FORM_SIZE=>'Maximum file size in HTML form exceeded',
                                    UPLOAD_ERR_PARTIAL=> 'Only part of the file was uploaded',
                                    UPLOAD_ERR_NO_FILE=> 'No image file selected for the book');
                ($imgFile['error']==0) or die("the server couldn't upload the image you selected due to: "
                                                .$php_errors [$imgFile['error']]);
                $imgFileTmpName = $imgFile['tmp_name'];
                $image_data = file_get_contents($imgFileTmpName);
                // Check whether the file was uploaded via HTTP POST
                is_uploaded_file($imgFileTmpName) or die("Possible file upload attack: ".$imgFileTmpName);
                // Check whether the file is an image
                getimagesize($imgFileTmpName) or die("The selected file is not an image file: ".$imgFileTmpName);
            }
            function insert_image_to_db($imgFile, $mysqli) {
                $image_data = file_get_contents($imgFile['tmp_name']) or die("File doesn't exist: ".$imgFile['tmp_name']); $book_id = $mysqli->insert_id;
                $stm = $mysqli->prepare("INSERT INTO images (book_id, filename, mine_type, file_size, image_data) ".
                "VALUES(?,?,?,?,?)");
            }
?>
