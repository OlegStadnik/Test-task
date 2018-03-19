<?php
include_once "classes/FileUploader.php";
include_once "classes/FileList.php";
include_once "classes/FileActions.php";

if (!empty($_POST['download'])){
    $fileAction = new FileActions();
    $fileAction->downloadFile($_POST['download_file']);
}

if (!empty($_POST['delete'])) {
    $fileAction = new FileActions();
    $fileAction->deleteFile($_POST['delete_file']);
}

$fileUploader = new FileUploader();
$fileUploader->fileUpload(basename($_FILES['userfile']['name']), $_FILES['userfile']['tmp_name']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test TASK</title>
</head>

<body>
<h1> ПРИВЕТ </h1>

<?php
if (count(scandir(FileUploader::FILE_DIR))!= 2)
    {
    ?>
    <div class="info-table">
        <table style="width: 40%" border="1">
            <tr>
                <th>Name</th>
                <th>Size</th>
                <th>Date</th>
                <th>Download</th>
                <th>Delete</th>
            </tr>
            <?php
            $draw = new FileList();
            echo $draw->listFiles();
            ?>
        </table>
    </div>
    <?php
    }
?>
<br/>
<br/>
<br/>


<form action="" method="post" enctype="multipart/form-data">
    <label> Choose file:</label>
    <input type="hidden" name="MAX_FILE_SIZE" value="1000000000"/>
    <input type="file" name="userfile"/>
    <input type="submit" value="Send File"/>

</form>

</body>
