<?php
function fetchMatches() {
    $date = date('Y-m-d');
    $url = "https://www.sofascore.com/api/v1/sport/football/scheduled-events/$date";
    
    // Use cURL for better reliability with Sofascore
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Host: www.sofascore.com",
        "cache-control: max-age=0",
        "sec-ch-ua: \"Not)A;Brand\";v=\"99\", \"Google Chrome\";v=\"127\", \"Chromium\";v=\"127\"",
        "sec-ch-ua-mobile: ?1",
        "sec-ch-ua-platform: \"Android\"",
        "upgrade-insecure-requests: 1",
        "user-agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Mobile Safari/537.36",
        "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7",
        "sec-fetch-site: none",
        "sec-fetch-mode: navigate",
        "sec-fetch-user: ?1",
        "sec-fetch-dest: document"
    ]);
    
    $json = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($json !== FALSE && $httpCode == 200) {
        $data = json_decode($json, true);
        if ($data && isset($data['events']) && !empty($data['events'])) {
            return ['success' => true, 'data' => $data['events'], 'httpCode' => $httpCode, 'json' => $json];
        }
    }
    
    // If Sofascore fails, return error info
    return ['success' => false, 'data' => [], 'httpCode' => $httpCode, 'json' => $json];
}

$result = fetchMatches();
echo "Success: " . ($result['success'] ? 'Yes' : 'No') . "\n";
echo "Matches count: " . count($result['data']) . "\n";
echo "HTTP Response Code: " . $result['httpCode'] . "\n";
echo "Raw JSON Response: " . substr($result['json'], 0, 500) . "...\n";
echo "Matches data: ";
var_dump($result['data']);
?> 