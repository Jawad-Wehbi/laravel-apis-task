<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class testController extends Controller
{
    function sorting(Request $str)
    {
        $n = strlen($str);
        $str_lower = array();
        $str_upper = array();
        $numbers = array();
        $sorted = array();

        $i = 0;
        for ($i = 0; $i < $n; $i++) {
            if ($str[$i] >= 'a' && $str[$i] <= 'z')
                array_push($str_lower, $str[$i]);

            if ($str[$i] >= 'A' && $str[$i] <= 'Z')
                array_push($str_upper, $str[$i]);

            if ($str[$i] >= '0' && $str[$i] <= '9')
                array_push($numbers, $str[$i]);
        }

        sort($numbers);
        $tempArray = array();

        for ($j = 0; $j < count($str_lower); $j++) {
            $tempArray[$str_lower[$j]] = ord($str_lower[$j]) - 33;
        }
        for ($k = 0; $k < count($str_upper); $k++) {
            $tempArray[$str_upper[$k]] = ord($str_upper[$k]);
        }
        asort($tempArray);

        $result = '';
        foreach ($tempArray as $index => $value) {
            $result = $result . $index;
        }
        $result = $result . implode($numbers);

        echo  $result;

        return response()->json([
            "response" => "success",
            "result" => $result
        ]);
    }

    function numtoAraay(Request $num)
    {
        $num = intval($num);
        $new_array = array();

        if ($num > 0)  $length = strlen($num);
        else $length = strlen($num) - 1; // to remove - sign

        $i = 1;
        $abs = abs($num);
        while ($i <= $length) {
            $value = 10 ** ($length - $i);
            $new_number = floor($abs / $value);
            $new_number = $new_number * $value;

            if ($num > 0) array_push($new_array, $new_number);
            else array_push($new_array, -$new_number);

            $abs = $abs - $new_number;
            $i++;
        };

        return response()->json([
            "status" => "Success",
            "message" => $new_array
        ]);
    }

    function translateToBinary(Request $req) {
        $str = $req->str;
        preg_match_all('!\d+!', $str, $numbers);
        $result = $str;
        // Replaces all numbers found by their binary value using decbin function
        foreach ($numbers[0] as $item) {
            $result = str_replace($item, "" . decbin($item), $result);
        }
        return response()->json([
            "response"=> "success",
            "result"=> $result
        ]);
    }

    function sayHi($name = "Laravel")
    {
        $message = "HI " . $name;

        return response()->json([
            "status" => "Success",
            "message" => $message
        ]);
    }

    function addUser(Request $request)
    {
        $name = $request->name;
        $age = $request->age;

        return response()->json([
            "status" => "Success",
            "message" => $age
        ]);
    }
}
