<?php
/**
 * Kamu memiliki string yang merepresentasikan angka 3943 lalu diberikan sebuah variabel k untuk melakukan replacement karakter sejumlah k pada string agar mendapatkan bentuk palindrom dengan nilai tertinggi.
 *
 * Sampel 1:
 * Input:
 * string: 3943
 * k: 1
 * palindrom:
 * 1. 3943  => 3993
 * 2. 3943 => 3443
 * Output: 3993
 * Penjelasan: Dari bentuk palindrom yang diperoleh maka highest palindrome-nya adalah 3993 dikarenakan 3993 > 3443.
 *
 * Sampel 2:
 * Input:
 * string: 3943
 * k: 1
 * palindrom:
 * 1. 932239  => sudah palindrome
 * 2. Perlu replacement sebanyak k = 2 => 992299
 * Output: 992299
 * Penjelasan: Dari bentuk palindrom yang diperoleh maka highest palindrome-nya adalah 992299 dikarenakan 992299 > 932239.
 *
 * Aturan:
 * 1. Jika dari sebuah string tidak ditemukan bentuk palindrome-nya meski sudah melakukan replacement dan tidak merepresentasikan sebuah angka maka akan mengeluarkan output -1.
 * 2. Tidak boleh menggunakan fungsi bawaan/tools untuk pencarian/filter/sort.
 * 3. Tidak boleh menggunakan looping.
 * 4. Hanya diperkenankan menggunakan rekursif.
 *
 * Soal:
 * Buat fungsi yang digunakan untuk menyelesaikan permasalahan Highest Palindrome!
 */

function makePalindrome(&$newString, &$left, &$right, &$changes, &$k) {
    if ($left >= $right) {
        return;
    }

    if ($newString[$left] != $newString[$right]) {
        if ($k <= 0) {
            return;
        }

        $higherValue = max($newString[$left], $newString[$right]);
        if ($newString[$left] != $higherValue) {
            $newString[$left] = $higherValue;
        }
        if ($newString[$right] != $higherValue) {
            $newString[$right] = $higherValue;
        }
        $changes[$left] = true;
        $k--;
    }

    $left++;
    $right--;
    makePalindrome($newString, $left, $right, $changes, $k);
}

function maximizePalindrome(&$newString, &$left, &$right, &$changes, &$k) {
    if ($left > $right) {
        return;
    }

    if ($newString[$left] != '9') {
        if (isset($changes[$left]) && $changes[$left] && $k >= 1) {
            $newString[$left] = '9';
            $newString[$right] = '9';
            $k--;
        } elseif (!isset($changes[$left]) && $k >= 2) {
            $newString[$left] = '9';
            $newString[$right] = '9';
            $k -= 2;
        }
    }

    $left++;
    $right--;
    maximizePalindrome($newString, $left, $right, $changes, $k);
}

function isPalindrome($newString) {
    $left = 0;
    $right = strlen($newString) - 1;
    return checkPalindrome($newString, $left, $right);
}

function checkPalindrome($newString, $left, $right) {
    if ($left >= $right) {
        return true;
    }
    if ($newString[$left] != $newString[$right]) {
        return false;
    }
    return checkPalindrome($newString, ++$left, --$right);
}

function highestPalindrome($s, $k) {
    $n = strlen($s);
    $left = 0;
    $right = $n - 1;
    $changes = [];
    $newString = str_split($s);

    makePalindrome($newString, $left, $right, $changes, $k);

    $left = 0;
    $right = $n - 1;

    maximizePalindrome($newString, $left, $right, $changes, $k);

    $finalString = implode('', $newString);

    // Cek apakah string akhir adalah palindrome dan k cukup
    if (isPalindrome($finalString)) {
        return $finalString;
    } else {
        return '-1';
    }
}

echo highestPalindrome("3943", 1) . "\n";
echo highestPalindrome("932239", 2) . "\n";