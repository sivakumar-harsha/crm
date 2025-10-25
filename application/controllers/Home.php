<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ConfigCtrl extends CI_Controller 
{
    public function index()
    {
         print_r("hi"); exit;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
           print_r("1"); exit;
            $accessToken = 'YOUR_ACCESS_TOKEN_HERE';
        
            // File details
            $filePath = $_FILES['file']['tmp_name'];
            $fileName = $_FILES['file']['name'];
            $dropboxPath = '/' . $fileName;
        
            // Initialize cURL
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://content.dropboxapi.com/2/files/upload");
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Authorization: Bearer $accessToken",
                "Dropbox-API-Arg: {\"path\": \"$dropboxPath\", \"mode\": \"add\", \"autorename\": true, \"mute\": false}",
                "Content-Type: application/octet-stream",
            ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, file_get_contents($filePath));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
            // Execute cURL
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
        
            if ($httpCode == 200) {
                // File uploaded successfully, now create a shared link
                $responseData = json_decode($response, true);
                $sharedLink = createSharedLink($accessToken, $responseData['id']);
                
                if ($sharedLink) {
                    echo "File uploaded successfully! Access it <a href=\"$sharedLink\" target=\"_blank\">here</a>.";
                } else {
                    echo "File uploaded but could not create a shared link.";
                }
            } else {
                echo "Error uploading file: " . $response;
            }
        }
        return view('Upload');

    }
    // Function to create a shared link
        function createSharedLink($accessToken, $fileId) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.dropboxapi.com/2/sharing/create_shared_link_with_settings");
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Authorization: Bearer $accessToken",
                "Content-Type: application/json",
            ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(["path" => $fileId, "settings" => ["requested_visibility" => "public"]]));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
        
            if ($httpCode == 200) {
                $linkData = json_decode($response, true);
                return $linkData['url'];
            }
        
            return false;
        }
}
