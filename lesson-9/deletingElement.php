<?php
//2. Реализовать удаление элемента массива по его значению. Обратите внимание на возможные
//дубликаты!

//создаем массив из $count элементов
$count = 30;
$arr = [];
for ($i=0; $i<$count; $i++) {
    $arr[] = rand(0,30);
}
$arrSorted = quickSort($arr, 0, count($arr) - 1);
print_r($arrSorted);
$searchValue = binarySearch($arrSorted, 5);
echo $searchValue . PHP_EOL;
deletingElement($arrSorted, $searchValue);

function deletingElement ($array, $value) {
    if ($value) {
        unset($array[$value]);
        print_r($array);
    } else {
        echo "Element with this value is not found";
    }
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

function binarySearch ($myArray, $num) {
//определяем границы массива
    $left = 0;
    $right = count($myArray) - 1;
    while ($left <= $right) {
//находим центральный элемент с округлением индекса в меньшую сторону
        $middle = floor(($right + $left)/2);
//если центральный элемент и есть искомый
        if ($myArray[$middle] == $num) {
            return $middle;
        }
        elseif ($myArray[$middle] > $num) {
//сдвигаем границы массива до диапазона от left до middle-1
            $right = $middle - 1;
        }
        elseif ($myArray[$middle] < $num) {
            $left = $middle + 1;
        }
    }
    return null;
}

//3. Подсчитать практически количество шагов при поиске описанными в методичке алгоритмами.
//
//4. * Выписав первые шесть простых чисел, получим 2, 3, 5, 7, 11 и 13. Очевидно, что 6-е простое
//число — 13. Какое число является 10001-м простым числом?