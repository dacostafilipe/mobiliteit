<?php 
/**
 * Search for a station
 *
 * @dacostafilipe / 10/16/14 @ 11:46 AM
 */
namespace mobiliteit;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;

class searchControllerProvider implements ControllerProviderInterface {

    /**
     * Search for a station with a given name
     *
     * @param $searchString
     * @return mixed
     */
    private function labelSearch($searchString){

        // -- TODO : Clean/reformat up content here when/if needed

        return mobiliteitData::retrieve('http://www.mobiliteit.lu/hafassuggest.php?q='.$searchString,false);
    }

    /**
     * Search for a station around a geospatial position. The API returns
     *
     * @param $lat
     * @param $long
     * @return mixed
     */
    private function geoSearch($lat,$long,$limit=5){

        //clean up position if not int
        $lat = strpos($lat,'.')===false?$lat:floor($lat*1000000);
        $long = strpos($long,'.')===false?$long:floor($long*1000000);

        // -- TODO : Clean/reformat up content here when/if needed

        return mobiliteitData::retrieve('http://travelplanner.mobiliteit.lu/hafas/cdt/query.exe/fny?&performLocating=2&tpl=stop2json&look_maxno='.$limit.'&look_x='.$long.'&look_y='.$lat,false);
    }

    public function connect( Application $app ) {

        $ctr = $app['controllers_factory'];

        $ctr->get( '/', function( Application $app, Request $request ) {

            if($request->query->has('q')){
                return $this->labelSearch($request->query->get('q'));
            }elseif ($request->query->has('lat') && $request->query->has('long')){
                return $this->geoSearch($request->query->get('lat'),$request->query->get('long'));
            }else{
                return 'search by label /?q=<searchString> or by geospatial position /?lat=<latitude>&long=<longitude> - ';
            }

        });

        return $ctr;
    }
} 