<?php

class FileList
{
    /**
     * метод получения массива с атрибутами файлов в папке
     */
    public function readFiles()
    {
        /**
         * создание
         */
        $fileList = [];
        $fileNames = scandir(FileUploader::FILE_DIR);
        foreach ($fileNames as $key => $fileName)
        {
            /**
             *  Scandir возвращает . и .., их нужно пропустить
             */
            if ($fileName == '.' || $fileName == '..')
            {
                continue;
                /**
                 * создание многомерного массива с атрибутами файлов в папке
                 */
            }
            $size = filesize(FileUploader::FILE_DIR . $fileName);
            $fileDate = filemtime(FileUploader::FILE_DIR . $fileName);
            $fileList[$key]['name'] = $fileName;
            $fileList[$key]['size'] = $size . " bytes";
            $fileList[$key]['date'] = $fileDate;
        }

        return $fileList;

    }

    /**
     * метод для построения строк в таблице файлов, находящихся в папке
     */
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
            <form action='' method='POST'>
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