<?php
function getCommonElements(array $array1, array $array2): array {
    // Используем array_intersect для получения общих элементов
    return array_intersect($array1, $array2);
}

// Пример использования
$array1 = ['apple', 'banana', 'orange', 'grape'];
$array2 = ['banana', 'kiwi', 'orange', 'melon'];

$commonElements = getCommonElements($array1, $array2);

print_r($commonElements);
?>