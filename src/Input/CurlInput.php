<?php
declare(strict_types=1);

namespace App\Input;


final class CurlInput implements InputInterface
{
    public function fetch($url): array
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        $output = curl_exec($curl);
        curl_close($curl);

        return $output;
    }
}