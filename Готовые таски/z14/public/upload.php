<?php
$directories = [
    'images' => ['jpg', 'jpeg', 'png', 'gif'],
    'videos' => ['mp4', 'avi', 'mov', 'wmv'],
    'documents' => ['docx', 'pdf', 'xls', 'xlsx'],
    'audio' => ['mp3', 'wav', 'ogg'],
    'fonts' => ['ttf', 'otf', 'woff', 'woff2']
];

// Проверяем, была ли загружена форма
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    // Проверяем на ошибки
    if ($file['error'] !== UPLOAD_ERR_OK) {
        die("Ошибка загрузки файла.");
    }
    // Получаем расширение файла
    $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $fileExtension = strtolower($fileExtension); // Приводим к нижнему регистру

    // Определяем папку для сохранения файла
    $targetDirectory = 'uploads/'; // Основная папка для загрузки
    $targetFolder = '';

    // Определяем тип файла и соответствующую папку
    foreach ($directories as $folder => $extensions) {
        if (in_array($fileExtension, $extensions)) {
            $targetFolder = $folder;
            break;
        }
    }
    // Если папка не найдена, выводим сообщение
    if (empty($targetFolder)) {
        die("Неподдерживаемый тип файла.");
    }
    // Формируем новое имя файла
    $dateTime = date('Y_m_d_H_i');
    $newFileName = $dateTime . '.' . $fileExtension;

    // Перемещаем загруженный файл в соответствующую папку
    $targetPath = $targetDirectory . $targetFolder . '/' . $newFileName;

    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        echo "Файл успешно загружен: " . htmlspecialchars($newFileName);
    } else {
        echo "Ошибка при перемещении загруженного файла.";
    }
} else {
    echo "Нет файла для загрузки.";
}

?>