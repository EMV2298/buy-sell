<?php

namespace app\src\service;

use app\src\exeption\ErrorSaveExeption;

class UploadFile
{
    /**
     * Загружает файл в папку web/uploads
     * @param object $file Файл для сохранения
     * @param string $folder имя папки в директории web/uploads без "/\"
     * @return string возвращает имя сохраненого файла
     * @throws ErrorSaveExeption не удалось сохранить файл
     */
    public static function upload(object $file, string $folder): string
    {
        $dir = "./uploads/{$folder}";
        if (!is_dir($dir)) {
            mkdir($dir);
        }

        $name = uniqid() . '.' . $file->getExtension();

        if ($file->saveAs($dir . "/" . $name)) {
            return $name;
        }
        throw new ErrorSaveExeption("Не удалось сохранить файл");
    }

    /**
     * Загружает файлы на сервер
     * @param string $filesUrl Url файла для загрузки
     * @return string Возвращает имя загруженного файла
     */
    public static function uploadUrlAvatar(string $filesUrl): string
    {
        $dir = "./uploads/avatar";
        if (!is_dir($dir)) {
            mkdir($dir);
        }
        $name = uniqid() . '.png';

        return file_put_contents($dir . "/" . $name, file_get_contents($filesUrl)) ? $name : '';
    }

    /**
     * Удаляет файлы
     * @param string $fileName Имя файла
     * @param string $folder Имя папки в директории Uploads
     * @return bool статус выполнения
     */
    public static function deleteFile(string $fileName, string $folder): bool
    {
        return unlink("uploads/{$folder}/{$fileName}");
    }
}
