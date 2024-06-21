<?php
require 'vendor/autoload.php';

use PhpOffice\PhpPresentation\PhpPresentation;
use PhpOffice\PhpPresentation\IOFactory;
use PhpOffice\PhpPresentation\Style\Color;
use PhpOffice\PhpPresentation\Style\Alignment;
use PhpOffice\PhpPresentation\Shape\Drawing;
use PhpOffice\PhpPresentation\Slide\Background\Color as BgColor;

function generateRandomString($length = 10) {
    $characters = 'abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomString;
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config.php';

$chapter_title = "Электромагнетизм";
$chapter_id = $_GET['chapter_id'];

$stmt = $db->prepare("SELECT * FROM tasks WHERE chapter_id = ? ORDER BY id ASC");
$stmt->bind_param("i", $chapter_id);
$stmt->execute();
$result = $stmt->get_result();
$tasks = $result->fetch_all(MYSQLI_ASSOC);

// Создание нового объекта презентации
$presentation = new PhpPresentation();

// Установка цвета фона презентации
$background = new BgColor();
$background->setColor(new Color('FFF1DF'));
$presentation->getActiveSlide()->setBackground($background);

$currentSlide = $presentation->getActiveSlide();
$currentSlide->setName('Заголовок');

// Добавление заголовка с автовыравниванием
$shape = $currentSlide->createRichTextShape()
    ->setHeight(100)
    ->setWidth(1280) // Установка ширины по всей ширине слайда для автовыравнивания
    ->setOffsetX(-160) // Начало от нуля по оси X
    ->setOffsetY(310); // Центрирование по Y (720 / 2 - 100 / 2)
$shape->getActiveParagraph()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$shape->getActiveParagraph()->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

$textRun = $shape->createTextRun('Решение задач на тему "' . $chapter_title . '"');
$textRun->getFont()->setBold(true)
                  ->setSize(60)
                  ->setColor(new Color('88633D'));

foreach ($tasks as $task) {
    // Создание нового слайда
    $slide = $presentation->createSlide();

    $slide->setBackground($background);

    // Добавление текста в левый верхний угол
    $shape = $slide->createRichTextShape()
        ->setHeight(100)
        ->setWidth(900) // Установка ширины во всю ширину слайда
        ->setOffsetX(10) // Левый верхний угол по оси X
        ->setOffsetY(10); // Левый верхний угол по оси Y
    $shape->getActiveParagraph()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
    $shape->getActiveParagraph()->getAlignment()->setVertical(Alignment::VERTICAL_TOP);

    $textRun = $shape->createTextRun($task['content']);
    $textRun->getFont()
        ->setSize(14)
        ->setColor(new Color('88633D')); // Цвет текста: #88633d

    if (isset($task['file_name'])) {
        // Добавление изображения в левый нижний угол
        $imagePath = "public" . "/" . $task['file_name'];
        if (file_exists($imagePath)) {
            $image = new Drawing\File();
            $image->setPath($imagePath)
                ->setHeight(200) // Высота изображения
                ->setOffsetX(10) // Левый нижний угол по оси X
                ->setOffsetY(510); // Левый верхний угол по оси Y
            $slide->addShape($image);
        } else {
            // echo "Image not found: $imagePath\n";
        }
    }
}

$filename = generateRandomString() . '.pptx';

// Сохранение презентации
$oWriterPPTX = IOFactory::createWriter($presentation, 'PowerPoint2007');
$oWriterPPTX->save(__DIR__ . '/' . $filename);

if (file_exists($filename)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($filename));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filename));
    ob_clean();
    flush();
    readfile($filename);
    unlink($filename);
    exit;
}
unlink($filename);
?>
