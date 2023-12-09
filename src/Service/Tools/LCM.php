<?php

/** https://www.skillpundit.com/php/php-find-lcm-n-numbers.php */

namespace App\Service\Tools;

class LCM
{

    private function gcd($a, $b)
    {
        if ($b === 0)
            return $a;
        return $this->gcd($b, $a % $b);
    }
//To find LCM of array element
    public function lcmofn($arr, $n)
    {
// Initialize result
        $ans = $arr[0];
// Ans contains LCM of arr[0], ..arr[i] after i'th iteration.
        for ($i = 1; $i < $n; $i++)
            $ans = ((($arr[$i] * $ans)) / ($this->gcd($arr[$i], $ans)));
        return $ans;
    }
}
