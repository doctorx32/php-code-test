<?php

declare(strict_types=1);

namespace App\Output;

final class OutputStrategy
{
    public const TYPE_JSON = 'json';
    public const TYPE_XML = 'xml';

    public function resolve(string $type, $output)
    {
        switch ($type) {
            case self::TYPE_JSON:
                $jsonOutput = new JsonOutput();
                $result = $jsonOutput->parse($output);
                break;
            case self::TYPE_XML:
                $xmlOutput = new XmlOutput();
                $result = $xmlOutput->parse($output);
                break;
            default:
                throw new \Exception("wrong type passed");
        }

        return $result;
    }
}
