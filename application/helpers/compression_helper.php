<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Compress image (JPG, PNG, GIF)
 */
if (!function_exists('compress_image')) {
    function compress_image($source, $destination, $quality = 70, $max_width = 1920, $max_height = 1080)
    {
        $info = getimagesize($source);
        if (!$info) return false;

        // Create image resource
        switch ($info['mime']) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($source);
                break;
            case 'image/png':
                $image = imagecreatefrompng($source);
                break;
            case 'image/gif':
                $image = imagecreatefromgif($source);
                break;
            default:
                return false;
        }

        $width  = imagesx($image);
        $height = imagesy($image);

        // --- Step 1: Resize if larger than target dimensions ---
        if ($width > $max_width || $height > $max_height) {
            $ratio      = min($max_width / $width, $max_height / $height);
            $new_width  = (int)($width * $ratio);
            $new_height = (int)($height * $ratio);

            $resized = imagecreatetruecolor($new_width, $new_height);
            imagecopyresampled($resized, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            imagedestroy($image);
            $image = $resized;
        }

        // --- Step 2: Reduce quality (default = 70 %) ---
        imagejpeg($image, $destination, $quality);
        imagedestroy($image);

        // --- Step 3: Adaptive re-compression loop if still too big ---
        $final_size_kb = round(filesize($destination) / 1024, 2);
        $target_kb     = 500; // target ≈ 500 KB

        while ($final_size_kb > $target_kb && $quality > 20) {
            $quality -= 10;
            imagejpeg(imagecreatefromjpeg($destination), $destination, $quality);
            $final_size_kb = round(filesize($destination) / 1024, 2);
        }

        return true;
    }
}


/**
 * Compress PDF using Ghostscript
 */
if (!function_exists('compress_pdf')) {
    function compress_pdf($source, $destination)
    {
        // Normalize paths for Windows compatibility
        $source = str_replace('/', DIRECTORY_SEPARATOR, $source);
        $destination = str_replace('/', DIRECTORY_SEPARATOR, $destination);

        // Detect Ghostscript path
        if (stripos(PHP_OS, 'WIN') === 0) {
            // Windows - use full path if Ghostscript is installed
            $gs = 'C:\\Program Files\\gs\\gs10.03.0\\bin\\gswin64c.exe';
            if (!file_exists($gs)) {
                log_message('error', 'Ghostscript not found on Windows path: ' . $gs);
                return false;
            }
        } else {
            // Linux / macOS
            $gs = shell_exec("which gs");
            if (!$gs) {
                log_message('error', 'Ghostscript not found on system PATH.');
                return false;
            }
            $gs = trim($gs);
        }

        // Build Ghostscript command
        $cmd = "\"$gs\" -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dPDFSETTINGS=/ebook " .
               "-dNOPAUSE -dQUIET -dBATCH -sOutputFile=\"$destination\" \"$source\"";

        exec($cmd, $output, $return_var);

        if ($return_var !== 0 || !file_exists($destination)) {
            log_message('error', "PDF compression failed for: $source (Exit Code: $return_var)");
            return false;
        }

        return true;
    }
}

