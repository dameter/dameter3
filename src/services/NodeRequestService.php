<?php

namespace respund\collector\services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use respund\collector\models\Response;

class NodeRequestService
{
    public function checkResponse(Response $response) {
        $uri = $this->baseUrl()."api/response/check-quota";
        echo $uri.PHP_EOL;
        $data['data'] =  [
            "responseId" => $response->uuid,
            "pageData" => ["test" => 1],
            "currentPageNo" => 0,
        ];
        try {
            $response = $this->client()->post($uri, [
                'headers' => $this->headers(),
                'form_params' => $data,
            ]);
            print_r($data);
            var_dump($response->getBody()->getContents());

        } catch (RequestException $e) {
            if($e->getCode() == 404) {
                // assuming recoding not existing (eg deleted)
                return "nooo";
            }
            throw $e;
        }

    }

    public function test(string $uri)
    {
        $uri = $this->baseUrl().$uri;
        $data =  ["email" => "test"];
        try {
            $response = $this->client()->post($uri, [
                'headers' => $this->headers(),
                'form_params' => $data,
            ]);
            print_r($data);
            var_dump($response->getBody()->getContents());

        } catch (RequestException $e) {
            if($e->getCode() == 404) {
                // assuming recoding not existing (eg deleted)
                return "nooo";
            }
            throw $e;
        }

    }

    private function baseUrl() : string
    {
        $uri = "http://respund_nginx/";
        return $uri;

    }
    private function  headers() : array
    {
        return [
            'Authorization' => 'Bearer FIXMe' ,
        ];
    }

    private function client( ): Client
    {
        return new Client([
            'verify' => false, // no valid cert here!
        ]);
    }

}
