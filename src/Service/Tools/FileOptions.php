<?php

namespace App\Service\Tools;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormInterface;

class FileOptions
{

    public function loadFile($filename)
    {
        return fopen('../files/' . $filename, 'rb');
    }

    public function getAllLines($file_handle): \Generator
    {
        while (!feof($file_handle)) {
            yield str_replace(PHP_EOL, '', fgets($file_handle));
        }
    }

    public function getDayInput(Form $form, int $day): array
    {
        if (!$form->isSubmitted() || !$form->isValid()) {
            return [];
        }
        $formData = $form->getData();

        if ($formData['input_type'] !== 'preview') {
            $rows = preg_split("/\r\n|\n|\r/", $formData['input'] ?? '');
        } else {
            $part = $formData['day_part'] === 1 ? 1 : 2;
            $file = $this->loadFile('Day' . $day . '/' . $part . '.txt');
            $rows = $this->getAllLines($file);
        }

        return $rows;
    }
}
