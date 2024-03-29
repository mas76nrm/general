<?php
	$moonImageUrl = '';
	$moonImageUrlBig = '';
	$latitude = 35.50;
	$longitude = 52.0;
	$month = '01';
	$day = '01';
	$year = '2000';
	$qrCode = null;
	$googleFilePath = '';
	
	$data = $_REQUEST;
    if(isset($data['y']) && isset($data['m']) && isset($data['d']) && isset($data['latitude']) && isset($data['longitude'])) {
        $year = $data['y'];
	    $month = $data['m'];
	    $day = $data['d'];
	    $latitude = $data['latitude'];
	    $longitude = $data['longitude'];

        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, "https://moonphases.co.uk/service/getMoonDetails.php?day=$day&month=$month&year=$year&lat=$latitude&lng=$longitude&len=1");
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        $page = curl_exec($c);
        curl_close($c);
        if(!empty($page)) {
            
            echo $page;
            die;

            $page = json_decode($page);
            if(isset($page->days) && !empty($page->days)) {
                $days = $page->days;
                $day0 = $days[0];
                $phase_img = $day0->phase_img;
                $moonImageUrl = "https://moonphases.co.uk/images/moons/$phase_img";
                $moonImageUrlBig = "https://moonphases.co.uk/images/moons/big/$phase_img";
            }
        }
    }

    echo "";
    die;

    print_r(json_encode([
        'moonImageUrl' => $moonImageUrl,
        'moonImageUrlBig' => $moonImageUrlBig,
        'latitude' => $latitude,
        'longitude' => $longitude,
        'year' => $year,
        'month' => $month,
        'day' => $day,
        'data' => $data,
        'page' => $page
    ]));
	
		
?>
