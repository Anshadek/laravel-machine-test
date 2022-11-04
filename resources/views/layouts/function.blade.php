{{-- Functions --}}
@php

if (!function_exists('setTitle')):
    function setTitle($page_name)
    {
        // echo $page_name;

        $app_name = '| ' . config('app.name');

        if ($page_name === 'dashboard'):
            echo 'Dashboard ' . $app_name;
        elseif ($page_name === 'sales'):
            echo 'Sales Admin ' . $app_name;
        elseif ($page_name === 'calendar'):
            echo 'Fullcalendar Drag and Drop Event ' . $app_name;
        else:
            echo config('app.name');
        endif;
    }
endif;

// Function to get the client IP address
function get_client_ip()
{
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    } elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    } elseif (isset($_SERVER['HTTP_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    } elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    } else {
        $ipaddress = 'UNKNOWN';
    }
    return $ipaddress;
}

@endphp
