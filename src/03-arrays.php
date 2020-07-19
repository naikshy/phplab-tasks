<?php
/**
 * The $input variable contains an array of digits
 * Return an array which will contain the same digits but repetitive by its value
 * without changing the order.
 * Example: [1,3,2] => [1,3,3,3,2,2]
 *
 * @param  array  $input
 * @return array
 */
function repeatArrayValues(array $input) : array
{
    $result = [];

    foreach($input as $digit) {
        
        for ($i = 0; $i < $digit; $i++) {
            array_push($result, $digit);
        }
    }

    return $result;
}

/**
 * The $input variable contains an array of digits
 * Return the lowest unique value or 0 if there is no unique values or array is empty.
 * Example: [1, 2, 3, 2, 1, 5, 6] => 3
 *
 * @param  array  $input
 * @return int
 */
function getUniqueValue(array $input) : int
{
    //ATTENTION: a lot of offsets here, be careful ;)

    if ( empty($input) ) {
        return 0;
    }

    //sort in order to avoid full array scan
    sort($input, SORT_NUMERIC);
    
    //check if first elem is uniq
    if ($input[0] !== $input[1]) {
        return $input[0];
    }

    for ($i = 1, $count = count($input) - 1; $i < $count; $i++) {
        
        if ( $input[$i] !== $input[$i - 1] && $input[$i] !== $input[$i + 1]) {
            
            return $input[$i];
        } 
    }
    
    //check if last elem is uniq 
    if ( $input[count($input) - 1] !== $input[count($input) - 2] ) {
        return $input[count($input) - 1];
    }
    
    return 0;
}

/**
 * The $input variable contains an array of arrays
 * Each sub array has keys: name (contains strings), tags (contains array of strings)
 * Return the list of names grouped by tags
 * !!! The 'names' in returned array must be sorted ascending.
 *
 * Example:
 * [
 *  ['name' => 'potato', 'tags' => ['vegetable', 'yellow']],
 *  ['name' => 'apple', 'tags' => ['fruit', 'green']],
 *  ['name' => 'orange', 'tags' => ['fruit', 'yellow']],
 * ]
 *
 * Should be transformed into:
 * [
 *  'fruit' => ['apple', 'orange'],
 *  'green' => ['apple'],
 *  'vegetable' => ['potato'],
 *  'yellow' => ['orange', 'potato'],
 * ]
 *
 * @param  array  $input
 * @return array
 */
function groupByTag(array $input) : array
{
    $result = [];

    foreach ($input as $name) {
        
        foreach ($name['tags'] as $tag) {
            
            if ( !array_key_exists($tag, $result)) {
                $result[$tag] = [];
            }
            
            array_push($result[$tag], $name['name']);   
        }
    }

    foreach ($result as $tag => $namesArr) {
        sort($result[$tag], SORT_STRING);
    }

    return $result;
}