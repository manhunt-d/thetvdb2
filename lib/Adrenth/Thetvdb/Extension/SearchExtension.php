<?php

namespace Adrenth\Thetvdb\Extension;

use Adrenth\Thetvdb\ClientExtension;
use Adrenth\Thetvdb\Exception\InvalidArgumentException;
use Adrenth\Thetvdb\Exception\InvalidJsonInResponseException;
use Adrenth\Thetvdb\Exception\RequestFailedException;
use Adrenth\Thetvdb\Exception\UnauthorizedException;
use Adrenth\Thetvdb\Model\SeriesData;
use Adrenth\Thetvdb\ResponseHandler;

/**
 * Class SearchExtension
 *
 * @category Thetvdb
 * @package  Adrenth\Thetvdb\Extension
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/thetvdb2
 */
class SearchExtension extends ClientExtension
{
    const PARAMETER_NAME = 'name';
    const PARAMETER_IMDB_ID = 'imdbId';
    const PARAMETER_ZAP2IT_ID = 'zap2itId';

    /**
     * Search for a series based on name.
     *
     * @param string $name
     * @return SeriesData
     * @throws RequestFailedException
     * @throws UnauthorizedException
     * @throws InvalidArgumentException
     * @throws InvalidJsonInResponseException
     */
    public function seriesByName(string $name): SeriesData
    {
        return $this->search(static::PARAMETER_NAME, $name);
    }

    /**
     * Search for a series based on IMDb ID.
     *
     * @param string $imdbId
     * @return SeriesData
     * @throws RequestFailedException
     * @throws UnauthorizedException
     * @throws InvalidArgumentException
     * @throws InvalidJsonInResponseException
     */
    public function seriesByImdbId(string $imdbId): SeriesData
    {
        return $this->search(static::PARAMETER_IMDB_ID, $imdbId);
    }

    /**
     * Search for a series based on ZAP2IT ID.
     *
     * @param string $zap2itId
     * @return SeriesData
     * @throws RequestFailedException
     * @throws UnauthorizedException
     * @throws InvalidArgumentException
     * @throws InvalidJsonInResponseException
     */
    public function seriesByZap2itId(string $zap2itId): SeriesData
    {
        return $this->search(static::PARAMETER_ZAP2IT_ID, $zap2itId);
    }

    /**
     * Search for a series based on parameter and value.
     *
     * @param string $parameter
     * @param string $value
     * @return SeriesData
     * @throws RequestFailedException
     * @throws UnauthorizedException
     * @throws InvalidArgumentException
     * @throws InvalidJsonInResponseException
     */
    private function search(string $parameter, string $value): SeriesData
    {
        $options = [
            'query' => [
                $parameter => $value,
            ],
            'http_errors' => false
        ];

        $json = $this->client->performApiCallWithJsonResponse('get', '/search/series', $options);
        return ResponseHandler::create($json, ResponseHandler::METHOD_SEARCH_SERIES)->handle();
    }
}
