<?php

namespace App\Service\Days;

class Day7
{
    public function generatePart1($rows): string
    {
        $handsPlayed = [
            'Five of a kind' => [],
            'Four of a kind' => [],
            'Full house' => [],
            'Three of a kind' => [],
            'Two pair' => [],
            'One pair' => [],
            'High card' => []
        ];
        $totalHands = 0;

        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if (empty($row)) {
                break;
            }
            $totalHands++;
            [$hand, $value] = explode(' ', $row);
            $handCards = str_split($hand);

            $handResult = [];
            foreach ($handCards as $card) {
                if (!isset($handResult[$card])) {
                    $handResult[$card] = 1;
                    continue;
                }
                $handResult[$card]++;
            }
            $hand = '|' . $hand;

            $handValue = array_count_values($handResult);

            if (isset($handValue[5])) {
                $handsPlayed['Five of a kind'][$hand] = $value;
                continue;
            }
            if (isset($handValue[4])) {
                $handsPlayed['Four of a kind'][$hand] = $value;
                continue;
            }
            if (isset($handValue[3], $handValue[2])) {
                $handsPlayed['Full house'][$hand] = $value;
                continue;
            }
            if (isset($handValue[3])) {
                $handsPlayed['Three of a kind'][$hand] = $value;
                continue;
            }
            if (isset($handValue[2]) && $handValue[2] === 2) {
                $handsPlayed['Two pair'][$hand] = $value;
                continue;
            }
            if (isset($handValue[2])) {
                $handsPlayed['One pair'][$hand] = $value;
                continue;
            }
            $handsPlayed['High card'][$hand] = $value;
        }

        $score = 0;
        foreach ($handsPlayed as $hands) {
            $order = ['A', 'K', 'Q', 'J', 'T', '9', '8', '7', '6', '5', '4', '3', '2'];
            $handsPlayedOrderd = $this->camelCardsSord($hands, $order);
            foreach ($handsPlayedOrderd as $handValue) {
                $score += $handValue * $totalHands;
                $totalHands--;
            }
        }

        return $score;
    }

    private function camelCardsSord(array $cardsArray, array $order): array
    {
        uksort($cardsArray, static function ($a, $b) use ($order) {
            $i=0;

            $aString = str_split($a);
            $bString = str_split($b);
            $valueAToCompare = '';
            $valueBToCompare = '';

            while ($i<6) {
                if ($aString[$i] !== $bString[$i]) {
                    $valueAToCompare = $aString[$i];
                    $valueBToCompare = $bString[$i];
                    break;
                }
                $i++;
            }
            if ($i === 6) {
                dd('SameValue');
            }
            if ('' === $valueAToCompare || '' === $valueBToCompare) {
                dd('values not correct');
            }

            $a = array_search($valueAToCompare, $order, true);
            $b = array_search($valueBToCompare, $order, true);
            if ($a === false && $b === false) {
                return 0;
            }

            if ($a === false) {
                return -1;
            }

            if ($b === false) {
                return 1;
            }

            return $a - $b;
        });

        return $cardsArray;
    }

    public function generatePart2($rows): string
    {
        $handsPlayed = [
            'Five of a kind' => [],
            'Four of a kind' => [],
            'Full house' => [],
            'Three of a kind' => [],
            'Two pair' => [],
            'One pair' => [],
            'High card' => []
        ];
        $totalHands = 0;

        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if (empty($row)) {
                break;
            }
            $totalHands++;
            [$hand, $value] = explode(' ', $row);
            $handCards = str_split($hand);

            $handResult = [];
            foreach ($handCards as $card) {
                if (!isset($handResult[$card])) {
                    $handResult[$card] = 1;
                    continue;
                }
                $handResult[$card]++;
            }
            $hand = '|' . $hand;
            $jokerValue = 0;
            if (isset($handResult['J'])) {
                $jokerValue = $handResult['J'];
                unset($handResult['J']);
            }
            $handValue = array_count_values($handResult);

            if ($jokerValue > 0) {
                if (empty($handValue)) {
                    $newNrOfCards = min($jokerValue, 5);
                } else {
                    $highestNrOfHandCards = max(array_keys($handValue));
                    if ($handValue[$highestNrOfHandCards] === 1) {
                        $newNrOfCards = min($highestNrOfHandCards + $jokerValue, 5);
                        unset($handValue[$highestNrOfHandCards]);
                    } else {
                        $handValue[$highestNrOfHandCards]--;
                        $newNrOfCards = min($highestNrOfHandCards + $jokerValue, 5);
                    }
                }
                $handValue[$newNrOfCards] = 1;
            }

            if (isset($handValue[5])) {
                $handsPlayed['Five of a kind'][$hand] = $value;
                continue;
            }
            if (isset($handValue[4])) {
                $handsPlayed['Four of a kind'][$hand] = $value;
                continue;
            }
            if (isset($handValue[3], $handValue[2])) {
                $handsPlayed['Full house'][$hand] = $value;
                continue;
            }
            if (isset($handValue[3])) {
                $handsPlayed['Three of a kind'][$hand] = $value;
                continue;
            }
            if (isset($handValue[2]) && $handValue[2] === 2) {
                $handsPlayed['Two pair'][$hand] = $value;
                continue;
            }
            if (isset($handValue[2])) {
                $handsPlayed['One pair'][$hand] = $value;
                continue;
            }
            $handsPlayed['High card'][$hand] = $value;
        }

        $score = 0;
        foreach ($handsPlayed as $hands) {
            $order = ['A', 'K', 'Q', 'T', '9', '8', '7', '6', '5', '4', '3', '2', 'J'];
            $handsPlayedOrderd = $this->camelCardsSord($hands, $order);
            foreach ($handsPlayedOrderd as $handValue) {
                $score += $handValue * $totalHands;
                $totalHands--;
            }
        }

        return $score;
    }
}
