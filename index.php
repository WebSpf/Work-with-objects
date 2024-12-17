<?php
declare(strict_types = 1);

function workSchedule(int $year, int $month): void
{
    $startOfMonth = DateTime::createFromFormat('d-m-Y', "01-$month-$year");
    $endOfMonth = (clone $startOfMonth)->modify('last day of this month');

    $shiftCounter = 0;

    while ($startOfMonth <= $endOfMonth) {
        $formattedDate = $startOfMonth->format('d-m-Y');
        $dayOfWeek = $startOfMonth->format('N');

        if ($dayOfWeek >= 6) {
            echo "Выходной день: \033[30m {$formattedDate} \033[0m" . PHP_EOL;
            $shiftCounter = 0;
        } else {
            if ($shiftCounter === 0) {
                echo "Рабочий день: \033[31m {$formattedDate} \033[0m" . PHP_EOL;
            } else {
                echo "Нерабочий день: \033[32m {$formattedDate} \033[0m" . PHP_EOL;
            }
            $shiftCounter = ($shiftCounter + 1) % 3;
        }

        $startOfMonth->modify('+1 day');
    }
}


$year = 2024;
$month = 06;
$monthRU = [
	1  => 'январь',
	2  => 'февраль',
	3  => 'март',
	4  => 'апрель',
	5  => 'май', 
	6  => 'июнь',
	7  => 'июль',
	8  => 'август',
	9  => 'сентябрь',
	10 => 'октябрь',
	11 => 'ноябрь',
	12 => 'декабрь'
];

 echo 'Месяц: ' . $monthRU[$month] . ' ' . $year . PHP_EOL;

 workSchedule($year, $month);