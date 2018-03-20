<?php


class FileActions
{
    /**
     * метод для уделения файла
     */
    public function deleteFile($fileName)
    {
        /**
         * проверка наличия файла, затем удаление
         */
        if (is_file(FileUploader::FILE_DIR . $fileName))
        {
        unlink(FileUploader::FILE_DIR . $fileName);
        }
    }

    /**
     * метод скачивания файла
     */
    public function downloadFile($fileName)
    {
        /**
         * проверка наличия файла, затем скачивание
         */
        if (is_file(FileUploader::FILE_DIR . $fileName))
        {
            header('Content-Description: File Transfer');
            header('Content-Type:application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename(FileUploader::FILE_DIR . $fileName) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize(FileUploader::FILE_DIR . $fileName));
            readfile(FileUploader::FILE_DIR . $fileName);
            exit;
        }


    }


}