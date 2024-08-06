<?php
require_once 'Globals.php';
require_once 'config.php';
function saveAccess()
{
    if (!WRITE_ACCESS_REG) {
        return;
    }
    $ip = getUserIP();
    $browser = getBrowser();
    $os = getOS();
    $location = getLocation();
    // Exemplo de uso
    $location = getLocation();

    $country = $location['country'];
    $region = $location['region'];
    $city = $location['city'];
    $isp = $location['isp'];

    $sql = "INSERT INTO user_access_full 
            (country, region_name, city, isp, user_ip, browser, operating_system)
            VALUES 
            (?, ?, ?, ?, ?, ?, ?)";
    // include_once 'config.php';
    $mysqli = new MySQLi(HOST, USER, PASS, BASE, PORT);
    $stmt = $mysqli->stmt_init();
    $stmt->prepare($sql);
    $stmt->bind_param('sssssss', $country, $region, $city, $isp, $ip, $browser, $os);
    $booleano = $stmt->execute();
    $stmt->close();
    if (ACCESS_REG) {
        if ($booleano) {
            echo 'Access saved';
        } else {
            echo 'Error saving access';
        }
    }
}

function getUserIP()
{
    // Check if IP is from shared internet
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    // Check if IP is from a proxy
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    // Check if IP is from remote address
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function getBrowser()
{
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $browser = "Unknown Browser";

    $browser_array = array(
        '/msie/i' => 'Internet Explorer',
        '/firefox/i' => 'Firefox',
        '/safari/i' => 'Safari',
        '/chrome/i' => 'Chrome',
        '/edge/i' => 'Edge',
        '/opera/i' => 'Opera',
        '/netscape/i' => 'Netscape',
        '/maxthon/i' => 'Maxthon',
        '/konqueror/i' => 'Konqueror',
        '/mobile/i' => 'Mobile Browser'
    );

    foreach ($browser_array as $regex => $value) {
        if (preg_match($regex, $user_agent)) {
            $browser = $value;
        }
    }

    return $browser;
}

function getOS()
{
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $os_platform = "Unknown OS Platform";

    $os_array = array(
        '/windows nt 10/i' => 'Windows 10',
        '/windows nt 6.3/i' => 'Windows 8.1',
        '/windows nt 6.2/i' => 'Windows 8',
        '/windows nt 6.1/i' => 'Windows 7',
        '/windows nt 6.0/i' => 'Windows Vista',
        '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
        '/windows nt 5.1/i' => 'Windows XP',
        '/windows xp/i' => 'Windows XP',
        '/windows nt 5.0/i' => 'Windows 2000',
        '/windows me/i' => 'Windows ME',
        '/win98/i' => 'Windows 98',
        '/win95/i' => 'Windows 95',
        '/win16/i' => 'Windows 3.11',
        '/macintosh|mac os x/i' => 'Mac OS X',
        '/mac_powerpc/i' => 'Mac OS 9',
        '/linux/i' => 'Linux',
        '/ubuntu/i' => 'Ubuntu',
        '/iphone/i' => 'iPhone',
        '/ipod/i' => 'iPod',
        '/ipad/i' => 'iPad',
        '/android/i' => 'Android',
        '/blackberry/i' => 'BlackBerry',
        '/webos/i' => 'Mobile'
    );

    foreach ($os_array as $regex => $value) {
        if (preg_match($regex, $user_agent)) {
            $os_platform = $value;
        }
    }

    return $os_platform;
}

function getLocation()
{
    $ip = getUserIP();

    if ($ip == '::1') {
        return
            $location = [
                'country' => 'admin',
                'region' => 'admin',
                'city' => 'admin',
                'isp' => 'admin'
            ];
    }
    $url = "http://ip-api.com/json/$ip";
    $json = file_get_contents($url);
    $data = json_decode($json, true);

    if ($data['status'] === 'success') {
        $location = [
            'country' => $data['country'],
            'region' => $data['regionName'],
            'city' => $data['city'],
            'isp' => $data['isp']
        ];
        return $location;
    } else {
        return null;
    }
}
