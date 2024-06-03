<?php
function sort_array_of_arrays_by_key(&$array, $key, $sort_ascending = true, $sort_flags = SORT_REGULAR) {
    if (empty($array) || !is_array($array)) return;
    if (!isset($array[0][$key])) return;

    usort($array, function($a, $b) use ($key, $sort_ascending, $sort_flags) {
        $cmp = strnatcmp($a[$key], $b[$key]);
        return $sort_ascending ? $cmp : -$cmp;
    });
}
$people = array(
    array('name' => 'Kiril', 'age' => 24),
    array('name' => 'Ivan', 'age' => 30),
    array('name' => 'Aleks', 'age' => 22),
    array('name' => 'Hristo', 'age' => 28)
);
sort_array_of_arrays_by_key($people, 'name');
print_r($people);
sort_array_of_arrays_by_key($people, 'age', false);
print_r($people);
?>


