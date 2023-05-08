<?php
//Практическое задание. Урок 9.
//1. Создать массив на миллион элементов и отсортировать его различными способами. Сравнить скорости.

//создаем массив на $count элементов
$count = 30000;
$arr = [];
for ($i=0; $i<$count; $i++) {
    $arr[] = rand(0,10000);
}
//print_r($arr);


//Замеряем скорость сортировки пузырьком
$start = microtime(true);
$arr = bubbleSort($arr);
echo "Сортировка пузырьком: " . (microtime(true) - $start) . PHP_EOL;
//print_r($arr);

//Замеряем скорость шейкерной сортировки
$start = microtime(true);
$arr = shakerSort($arr);
echo "Шейкерная сортировка: " . (microtime(true) - $start) . PHP_EOL;
//print_r($arr);3

//Замеряем скорость быстрой сортировки
$start = microtime(true);
$arr = quickSort($arr, 0, count($arr) - 1);
echo "Быстрая сортировка: " . (microtime(true) - $start) . PHP_EOL;
//print_r($arr);

//Пузырьковая сортировка
function bubbleSort($array){
    for($i=0; $i<count($array); $i++){
        $count = count($array);
        for($j=$i+1; $j<$count; $j++){
            if($array[$i]>$array[$j]){
                $temp = $array[$j];
                $array[$j] = $array[$i];
                $array[$i] = $temp;
            }
        }
    }
    return $array;
}

//Шейкерная сортировка
function shakerSort ($array)
{
    $n = count($array);
    $left = 0;
    $right = $n - 1;
    do {
        for ($i = $left; $i < $right; $i++) {
            if ($array[$i] > $array[$i + 1]) {
                list($array[$i], $array[$i + 1]) = array($array[$i + 1],
                    $array[$i]);
            }
        }
        $right -= 1;
        for ($i = $right; $i > $left; $i--) {
            if ($array[$i] < $array[$i - 1]) {
                list($array[$i], $array[$i - 1]) = array($array[$i - 1],
                    $array[$i]);
            }
        }
        $left += 1;
    } while ($left <= $right);
    return $array;
}

//Быстрая сортировка
function quickSort(&$arr, $low, $high) {
    $i = $low;
    $j = $high;
    $middle = $arr[ floor(( $low + $high ) / 2) ]; // middle – опорный элемент; в нашей реализации он находится посередине между low и high
do {
    while($arr[$i] < $middle) ++$i; // Ищем элементы для правой части
    while($arr[$j] > $middle) --$j; // Ищем элементы для левой части
if($i <= $j){
// Перебрасываем элементы
    $temp = $arr[$i];
    $arr[$i] = $arr[$j];
    $arr[$j] = $temp;
// Следующая итерация
    $i++; $j--;
}
}
while($i < $j);
if($low < $j){
// Рекурсивно вызываем сортировку для левой части
    quickSort($arr, $low, $j);
}
if($i < $high){
// Рекурсивно вызываем сортировку для правой части
    quickSort($arr, $i, $high);
}
return $arr;
}

