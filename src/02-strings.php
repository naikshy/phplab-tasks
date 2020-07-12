<?php
/**
 * The $input variable contains text in snake case (i.e. hello_world or this_is_home_task)
 * Transform it into camel cased string and return (i.e. helloWorld or thisIsHomeTask)
 * @see http://xahlee.info/comp/camelCase_vs_snake_case.html
 *
 * @param  string  $input
 * @return string
 */
function snakeCaseToCamelCase(string $input) : string
{
    $pattern = '/(_)(.)/';
    $result = preg_replace_callback($pattern, function(array $matches) {
        return strtoupper($matches[2]);
    }, $input);
    return $result;
}

/**
 * The $input variable contains multibyte text like 'ФЫВА олдж'
 * Mirror each word individually and return transformed text (i.e. 'АВЫФ ждло')
 * !!! do not change words order
 *
 * @param  string  $input
 * @return string
 */
function mirrorMultibyteString(string $input) : string
{
    //should be param in function
    $encodingBytesLengh = 2;
    
    $pattern = '/[а-яА-Я]+/u';
    preg_match_all($pattern, $input, $result);
    //Devide words to array consists of mb letters
    foreach ($result[0] as $index => $word) {
        //wanted to use mb_str_split -> but it not available in 7.3 
        $result[$index] = str_split($word, $encodingBytesLengh);
    }
    //Reverse letters
    foreach ($result as $index => $splitedWord) {
        $result[$index] = array_reverse($splitedWord);
    }
    //Build the words back
    foreach ($result as $index => $splitedWord) {
        $result[$index] = implode($result[$index]);
    }
    //Build the sentence
    $result = implode(' ', $result);

    return $result;
}

/**
 * My friend wants a new band name for her band.
 * She likes bands that use the formula: 'The' + a noun with first letter capitalized.
 * However, when a noun STARTS and ENDS with the same letter,
 * she likes to repeat the noun twice and connect them together with the first and last letter,
 * combined into one word like so (WITHOUT a 'The' in front):
 * dolphin -> The Dolphin
 * alaska -> Alaskalaska
 * europe -> Europeurope
 * Implement this logic.
 *
 * @param  string  $noun
 * @return string
 */
function getBrandName(string $noun) : string
{
    //compare first and last letter in the same case
    if (strtoupper($noun)[0] === strtoupper($noun)[strlen($noun) - 1]) {
        $result = ucfirst($noun) . substr($noun, 1);
    } else {
        $result = 'The ' . ucfirst($noun);
    }

    return $result;
}