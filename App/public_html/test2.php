
<?php
// Login endpoint URL
$url = 'https://www.instagram.com/';

// Login form data
$data = [
  'username' => 'adriennejessica',
  'password' => 'Nwachukwu@06'
];


// Initialize curl session
$ch = curl_init();

// Set curl options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Execute the curl session
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}

// Close the curl session
curl_close($ch);

// Get the home page after successful login
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.instagram.com/');
curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}

// Close the curl session
curl_close($ch);

// Output the home page HTML
echo $response;