<?php
// Submitting multiple URLs efficiently
$urls = array(
    "https://netmirror.art",
    "https://netmirror.art/explore/movie?country=India&dubbing=Hindi&title=Bollywood",
    "https://netmirror.art/explore/movie?country=United+States&category=Hollywood&title=Hollywood",
    "https://netmirror.art/explore/movie?dubbing=Tamil&title=Tamil",
    "https://netmirror.art/explore/movie",
    "https://netmirror.art/explore/tv",
    "https://netmirror.art/explore/animated",
    "https://netmirror.art/explore/netflix",
    "https://netmirror.art/explore/primeVideo",
    "https://netmirror.art/explore/tv?country=Korea&title=K-Drama",
    "https://netmirror.art/explore/movie?dubbing=Telugu&title=Telugu",
    "https://netmirror.art/explore/movie?dubbing=Malayalam&title=Malayalam",
);
function submitBatchIndexNow($urls) {
    $request = curl_init();
    $data = array(
        'host' => "netmirror.art",
        'key' => "9aefa5d94ec04c3eb48edfa777585985",
        'keyLocation' => "https://netmirror.art/9aefa5d94ec04c3eb48edfa777585985.txt",
        'urlList' => $urls
    );
    curl_setopt($request, CURLOPT_URL, "https://api.indexnow.org/indexnow");
    curl_setopt($request, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($request, CURLOPT_POST, 1);
    curl_setopt($request, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($request);
    curl_close($request);
    return $response;
}

// Enhanced logging to track API responses
function logIndexNowSubmission($urls) {
    $logFile = "indexnow_log.txt";
    $response = submitBatchIndexNow($urls);
    print $response;
    file_put_contents($logFile, date("Y-m-d H:i:s") . " - Response: " . $response . "\n", FILE_APPEND);
}
logIndexNowSubmission($urls);

?>