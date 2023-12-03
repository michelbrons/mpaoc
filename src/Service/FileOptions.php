<?php

namespace App\Service;

class FileOptions
{

    public function loadFile($filename)
    {
        $fileHandle = fopen('../files/' . $filename, 'rb');
        return $fileHandle;
    }

    public function getAllLines($file_handle) {
        while (!feof($file_handle)) {
            yield str_replace(PHP_EOL, '', fgets($file_handle));
        }
    }

    public function getDayInput($formData, int $day) {
        if ($formData['input_type'] !== 'preview') {
            $rows = preg_split("/\r\n|\n|\r/", $formData['input'] ?? '');
        } else {
            $part = $formData['day_part'] === 1 ? 1 : 2;
            $file = $this->loadFile('Day' . $day . '-' . $part . '-preview.txt');
            $rows = $this->getAllLines($file);
        }

        return $rows;
    }
}