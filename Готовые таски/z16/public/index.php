<?php
// Устанавливаем текущую дату или получаем дату из параметров URL
if (isset($_GET['month']) && isset($_GET['year'])) {
    $currentMonth = (int)$_GET['month'];
    $currentYear = (int)$_GET['year'];
} else {
    $currentMonth = date('n'); // Текущий месяц
    $currentYear = date('Y'); // Текущий год
}

// Функция для получения количества дней в месяце
function getDaysInMonth($month, $year) {
    return cal_days_in_month(CAL_GREGORIAN, $month, $year);
}

// Функция для получения первого дня месяца
function getFirstDayOfMonth($month, $year) {
    return date('w', strtotime("$year-$month-01"));
}

// Получаем количество дней и первый день месяца
$daysInMonth = getDaysInMonth($currentMonth, $currentYear);
$firstDay = getFirstDayOfMonth($currentMonth, $currentYear);

// Массив с названиями дней
$daysOfWeek = ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'];

// Определяем предыдущий и следующий месяц
$prevMonth = $currentMonth - 1;
$prevYear = $currentYear;
if ($prevMonth < 1) {
    $prevMonth = 12;
    $prevYear--;
}

$nextMonth = $currentMonth + 1;
$nextYear = $currentYear;
if ($nextMonth > 12) {
    $nextMonth = 1;
    $nextYear++;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Календарь</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .calendar {
            width: 300px;
            margin: 0 auto;
            border: 1px solid #ccc;
            border-radius: 5px;
            overflow: hidden;
        }
        .header {
            background-color: #f2f2f2;
            text-align: center;
            padding: 10px;
        }
        .header h2 {
            margin: 0;
        }
        .days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            text-align: center;
        }
        .day {
            padding: 10px;
            border: 1px solid #eee;
        }
        .today {
            background-color: #ffeb3b;
        }
        .button {
            cursor: pointer;
            padding: 5px 10px;
            margin: 5px;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="calendar">
    <div class="header">
        <button class="button" onclick="location.href='index.php?month=<?= $prevMonth ?>&year=<?= $prevYear ?>'">←</button>
        <h2><?= date('F Y', strtotime("$currentYear-$currentMonth-01")) ?></h2>
        <button class="button" onclick="location.href='index.php?month=<?= $nextMonth ?>&year=<?= $nextYear ?>'">→</button>
    </div>
    <div class="days">
        <?php foreach ($daysOfWeek as $day): ?>
            <div class="day"><?= $day ?></div>
        <?php endforeach; ?>
        <?php for ($i = 0; $i < $firstDay; $i++): ?>
            <div class="day"></div>
        <?php endfor; ?>
        <?php for ($day = 1; $day <= $daysInMonth; $day++): ?>
            <div class="day <?= ($day == date('j') && $currentMonth == date('n') && $currentYear == date('Y')) ? 'today' : '' ?>">
                <?= $day ?>
            </div>
        <?php endfor; ?>
    </div>
</div>

</body>
</html>