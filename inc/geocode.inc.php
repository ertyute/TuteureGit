<?php
/*GET LONG ET LAT DE GOOGLE MAPS*/
function geocode($address){

$arrContextOptions=array(
        "ssl"=>array(
        "cafile" => "../../bundle/cacert.pem",
        "verify_peer"=> true,
        "verify_peer_name"=> true,
    ),
);


    // url encode the address
    $codeAdd = urlencode($address);
    // google map geocode api url
    $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$codeAdd}&key=AIzaSyDd9slKoG41gF1xM8xr_LoEGCxnWrZejoY";
    // get the json response
    $resp_json = file_get_contents($url, false, stream_context_create($arrContextOptions));
     
    // decode the json
    $resp = json_decode($resp_json, true);
 
    // response status will be 'OK', if able to geocode given address 
    if($resp['status']=='OK'){
 
        // get the important data
        $lati = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : "";
        $longi = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : "";
        $formatted_address = isset($resp['results'][0]['formatted_address']) ? $resp['results'][0]['formatted_address'] : "";
         
        // verify if data is complete
        if($lati && $longi && $formatted_address){
         
            // put the data in the array
            $geo_data = array();            
             
            
                $geo_data = [
                	"lat" => $lati, 
                    "long" => $longi, 
                    "address" => $formatted_address 
                ];
             
            return $geo_data;
             
        }else{
            return false;
        }
         
    }
 
    else{
        return false;
    }
};
?>