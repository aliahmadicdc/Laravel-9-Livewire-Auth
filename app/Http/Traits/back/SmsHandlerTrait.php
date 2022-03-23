<?php

namespace App\Http\Traits\back;

trait SmsHandlerTrait
{
    private string $phone_number, $text;
    private string $verifyPatternCode = "";
    private string $generalPatternCode = "";

    public function sendText($phone_number, $text, $mode = "verify"): bool|string
    {
        $this->phone_number = $phone_number;
        $this->text = $text;

        if ($mode == "verify")
            return $this->sendByPattern($this->verifyPatternCode);
        else
            return $this->sendByPattern($this->generalPatternCode);
    }

    private function sendByPattern($pattern_code): bool|string
    {
        $username = '';
        $password = '';
        $from = '';
        $to = array($this->phone_number);
        $input_data = array('text' => $this->text);

        $url = 'https://ippanel.com/patterns/pattern' .
            '?username=' . $username .
            '&password=' . urlencode($password) .
            '&from=' . $from .
            '&to=' . json_encode($to) .
            '&input_data=' . urlencode(json_encode($input_data)) .
            '&pattern_code=' . $pattern_code;

        $handler = curl_init($url);
        curl_setopt($handler, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($handler, CURLOPT_POSTFIELDS, $input_data);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);

        return curl_exec($handler);
    }
}
