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
        $cityName = $this->spellChecking($url);

        if (!$cityName) {
            return $name;
        }

        return $cityName;
    }

    /**
     * @param string $url
     * @return mixed
     */
    protected function spellChecking(string $url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = array_shift(json_decode(curl_exec($ch), true));
        curl_close($ch);

        return array_shift($output['s']);
    }
}