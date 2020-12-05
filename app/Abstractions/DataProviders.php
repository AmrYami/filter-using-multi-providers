<?php


namespace App\Abstractions;


abstract class DataProviders
{
    /**
     * read json file
     * @param string $url
     * @return mixed
     */
    public function readData(string $url){
        $result = file_get_contents($url);
        $data = json_decode($result, true);
        $data = array_filter($data);
        return $data;
    }
    abstract public function manageData(array $request);

}