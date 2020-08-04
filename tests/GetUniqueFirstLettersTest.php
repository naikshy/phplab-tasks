<?php

use PHPUnit\Framework\TestCase;

class GetUniqueFirstLettersTest extends TestCase
{
    /**
     * @dataProvider airportsCasesProvider 
     */
    public function testPositive(array $expect, array $airports) {
        $this->assertEquals($expect, getUniqueFirstLetters($airports));
    }

    public function airportsCasesProvider() {
        return [
            [
                ['A','B','C'],
                [
                    ['name' => 'BuTerbrod Stuttgart'],
                    ['name' => 'Aurbu Ooyu'],
                    ['name' => 'Corn Ostrava']
                ]
            ],
            [
                ['А','Б','Ц'],
                [
                    ['name' => 'Борисполь Киев'],
                    ['name' => 'Арубис Альбукерке'],
                    ['name' => 'Церн Вольшпек']
                ] 
            ]
        ];
    }
}

?>