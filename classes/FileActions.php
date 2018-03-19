<?php


class FileActions
{

    public function deleteFile($fileName)
    {   if (is_file(FileUploader::FILE_DIR . $fileName))
        {
        unlink(FileUploader::FILE_DIR . $fileName);
        }
    }

    public function downloadFile($fileName)
    {

        if (is_file(FileUploader::FILE_DIR . $fileName))
        {
            header('Content-Description: File Transfer');
            header('Content-Type:application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename(FileUploader::FILE_DIR . $fileName) . '"');
            header('Expires: 0');
            header('Cache-Control: must revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize(FileUploader::FILE_DIR . $fileName));
            readfile(FileUploader::FILE_DIR . $fileName);
            exit;
        }


    }


}