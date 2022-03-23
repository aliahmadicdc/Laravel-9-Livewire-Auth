<?php

namespace App\Http\Traits\back;

use App\Models\back\Upload;

trait UploadTrait
{
    public function uploadImage($data): bool|string
    {
        try {
            $image = $this->moveImage($data);
        } catch (\Exception $exception) {
            return false;
        }

        if ($image == false)
            return false;

        return basename($image->name);
    }

    private function moveImage($data): bool|Upload
    {
        try {
            $image = $data['image'];
            $imageName = $this->generateName($image->extension());

            $imageName = $image->store(imageUrl, 'public');

            return $this->saveToUploads($imageName, $data);
        } catch (\Exception $exception) {
            return false;
        }
    }

    private function saveToUploads($imageName, $data)
    {
        return Upload::create([
            'name' => $imageName,
            'user_id' => auth()->user() ? auth()->user()->id : 0,
            'type' => $data['upload_type']
        ]);
    }

    private function generateName($extension): string
    {
        return 'img_' . time() . mt_rand(11111, 99999) . '.' . $extension;
    }
}
