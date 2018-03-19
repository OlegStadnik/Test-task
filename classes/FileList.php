<?php

class FileList
{

    public function readFiles()
    {
        $fileList = [];
        $fileNames = scandir(FileUploader::FILE_DIR);
        foreach ($fileNames as $key => $fileName) {
            // Scandir returns . and .. link current folder and parent folder,
            // so we need to skip it.
            if ($fileName == '.' || $fileName == '..') {
                continue;
            }
            $size = filesize(FileUploader::FILE_DIR . $fileName);
            $fileDate = filemtime(FileUploader::FILE_DIR . $fileName);
            $fileList[$key]['name'] = $fileName;
            $fileList[$key]['size'] = $size . " bytes";
            $fileList[$key]['date'] = $fileDate;
        }

        return $fileList;

    }

    public function listFiles()
    {
        $list = $this->readFiles();
        $table = '';
        foreach ($list as $item) {
            $name = $item['name'];
            $size = $item['size'];
            $fileDate = date('d M Y H:i:s', $item['date']);
            $table .= "
            <tr>
            <form action='' method='post'>
            <td>$name</td>
            <td>$size</td>
            <td>$fileDate</td>
            <td><input type='submit' name='download' value='Download'><input type='hidden' name='download_file' value='$name'></td>
            <td><input type='submit' name='delete' value='Delete'><input type='hidden' name='delete_file' value='$name'></td>
            </form>
            </tr>";
        }
        return $table;
    }
}