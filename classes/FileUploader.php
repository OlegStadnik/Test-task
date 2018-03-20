<?php


class FileUploader
{
    /**
     * константа FILE_DIR = папка для работы с файлами
     */
    const FILE_DIR = "upload/";


    public function fileUpload($fileName, $tmpFileName)
    {
        /**
         * если переменной ничего не присвоено: выход из функции
         */
        if (empty($fileName)) {
            return;
        }
        /**
         * проверка существования папки, если нет: создать её с полным доступом для всех
         */
        if (!is_dir(static::FILE_DIR))
        {
            mkdir(static::FILE_DIR, 0777);
        }
        /**
         * создание перепенной пути к файлу для использования в следующем условии
         */
        $uploadfile = static::FILE_DIR . $fileName;

        /**
         *  условие записи файла в папку
         */

        if (move_uploaded_file($tmpFileName, $uploadfile))
        {
            $result= "file uploaded";
        }
        else
            {
                $result= "file not uploaded";
            }

    return $result;
    }


}