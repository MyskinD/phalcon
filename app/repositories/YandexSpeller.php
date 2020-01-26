<?php

namespace app\repositories;

use App\Repositories\SpellerInterface;
use InvalidArgumentException;

class YandexSpeller implements SpellerInterface
{
    /** @var string|string  */
    protected $http;

    /**
     * YandexSpeller constructor.
     * @param string $http
     */
    public function __construct(string $http)
    {
        $this->http = $http;
    }

    /**
     * @param string $name
     * @return string
     */
    public function spellByCity(string $name): string
    {
        $format = '%s%s';
        $url = sprintf($format, $this->http, $name);

        return $this->spellChecking($url);
    }

    /**
     * @param string $url
     * @return string
     */
    protected function spellChecking(string $url): string
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = array_shift(json_decode(curl_exec($ch), true));
        curl_close($ch);

        if (!$output) {
            throw new InvalidArgumentException('city not found');
        }

        return array_shift($output['s']);
    }


}