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
    $name = uniqid() . '.' . $file->getExtension();

    if ($file->saveAs("@webroot/uploads/{$folder}/" . $name))
    {
      return $name;
    }
    throw new ErrorSaveExeption("Не удалось сохранить файл");

  }
}