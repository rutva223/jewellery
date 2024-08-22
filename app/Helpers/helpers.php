<?php

use Illuminate\Http\Testing\File;

if (!function_exists('UploadImageFolder')) {
    function UploadImageFolder($folder_name, $file_name)
    {
        $paths = public_path($folder_name);
        if (!is_dir($paths)) {
            mkdir($paths, 0755, true);
        }
        $filename = time() . '_' . str_replace(' ', '', $file_name->getClientOriginalName());
        $file_name->move($paths, $filename);
        return $filename;
    }
}

if (!function_exists('UploadImageFolder')) {
    function deleteDataFromFolder($folder_name, $image_name)
    {
        $delete_image = public_path() . $folder_name . $image_name;
        if (File::exists($delete_image)) {
            File::delete($delete_image);
        }
        return true;
    }
}

if (!function_exists('getMailData')) {

    function getMailData() {
        $from_email = config('mail_config.mail_from_address');
        $fromName = config('mail_config.mail_from_name');

        return [
            'from_email' => $from_email,
            'from_name' => $fromName
        ];
    }

}
