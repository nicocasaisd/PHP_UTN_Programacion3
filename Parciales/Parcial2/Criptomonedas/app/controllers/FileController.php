<?php

class FileController
{
    public static function SaveImage($file, $dirPath, $filename)
    {
        if (!empty($file)) {
            if (!is_dir($dirPath)) {
                mkdir($dirPath, 0777, true);
            }
            $newPath = $dirPath . '/' . $filename . '.jpg';
            $file['image']->moveTo($newPath);

            return $newPath;
        }

    }
}