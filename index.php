<?php
/**
 *  Включение классов:
 */

include_once "classes/FileUploader.php";
include_once "classes/FileList.php";
include_once "classes/FileActions.php";
/**
 *  Проверка на наличие значений в массиве $_POST получаемых методом POST
 */
if (!empty($_POST['download']))
{
    /**
     *  Создание объекта fileAction и использование метода downloadFile
     */
    $fileAction = new FileActions();
    $fileAction->downloadFile($_POST['download_file']);

}

if (!empty($_POST['delete']))
{
    $fileAction = new FileActions();
    $fileAction->deleteFile($_POST['delete_file']);
}

/**
 *  Создание объекта fileUploader и присвоение переменной uploadresult результата метода fileupload
 */

if (!empty($_FILES['userfile']))
{
$fileUploader = new FileUploader();
$result = $fileUploader->fileupload(basename($_FILES['userfile']['name']), $_FILES['userfile']['tmp_name']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test Task</title>
</head>

<body>
<h1>MY FIRST SITE :)</h1>

<!--Проверка наличия файлов в папке, если нет то таблица не будет отображена -->
<?php
if (count(scandir(FileUploader::FILE_DIR))!= 2)
    /**
     *  Scandir возвращает . и .. , если папка пуста, то результатом данного условия будет 2
     */
    {
    ?>
        <!--Создание таблицы -->
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
            /**
             *  Использование метода listFiles для построения строк таблицы
             */
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

<!--Форма для загрузки выбора и загрузки файла -->
<form action="" method="POST" enctype="multipart/form-data">
    <label> Choose file:</label>
    <input type="hidden" name="MAX_FILE_SIZE" value="1000000000"/>
    <input type="file" name="userfile"/>
    <input type="submit" value="Send File"/>

</form>
<br/>
<br/>
<?php
/**
  * вывод результата загрузки файла
  */
if (!empty($result))
{
    echo $result;
}
?>

</body>
