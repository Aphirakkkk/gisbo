<?php

namespace App\Services;

use Illuminate\Support\Str;

class CheckSpecialCharacter
{
    public static function CheckCharacter($specialChar)
    {
        $contains = Str::contains($specialChar, [
                    '|', '!','#','$','%','&','/',':',
                    '(',')','=','?','»','«','£','฿',
                    '§','€','{','}',';','@','<','>',
                    '[',']',',','.','*','+','-','"',"'",'^'
            ]);
        return $contains;
    }

    public static function CheckCharacterEmail($specialChar)
    {
        $contains = Str::contains($specialChar, [
                    '|', '!','#','$','%','&','/',':',
                    '(',')','=','?','»','«','£','฿',
                    '§','€','{','}',';','<','>',
                    '[',']',',','*','+','"',"'",'^'
            ]);
        return $contains;
    }

    public static function CheckCharacterAdd($specialChar)
    {
        $contains = Str::contains($specialChar, [
                    '|', '!','#','$','%','&',':',
                    '(',')','=','?','»','«','£','฿',
                    '§','€','{','}',';','@','<','>',
                    '[',']',',','*','+','"',"'",'^'
            ]);
        return $contains;
    }
}
