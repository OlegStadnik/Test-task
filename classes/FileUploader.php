<?php


class FileUploader
{
    const FILE_DIR = "upload/";

    public function fileUpload($fileName, $tmpFileName)
    {
        if (empty($fileName)) {
            return;
        }

        if (!is_dir(static::FILE_DIR))
        {
            mkdir(static::FILE_DIR, 0777);
        }

        $uploadfile = static::FILE_DIR . $fileName;


        if (move_uploaded_file($tmpFileName, $uploadfile))
        {
            echo "Файл загружен.\n";
        }
        else
            {
            echo "Не удалось загрузить\n";
            }

    }


}