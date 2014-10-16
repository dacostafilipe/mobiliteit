<?php 
/**
 * Helper class for retrieving data. Should be more complex so that we don't have to handle urls in the application anymore, but for now keep it simple.
 *
 * @dacostafilipe / 10/16/14 @ 12:56 PM
 */
namespace mobiliteit;

class mobiliteitData {

    /**
     * Retrieve data from given URL. Result get's converted to array.
     *
     * @param string $URL
     * @param boolean $decode
     * @return mixed
     */
    static function retrieve($URL,$decode=true){
        $curlSession = curl_init();
        curl_setopt($curlSession, CURLOPT_URL, $URL);
        curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

        $data = curl_exec($curlSession);

        if($decode===true){
            $data = json_decode($data,true);
        }

        curl_close($curlSession);

        return $data;
    }

} 