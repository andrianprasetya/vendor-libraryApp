<?php

namespace App\Libraries;

use App\Models\File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class FileLibrary
{
    private $rootDir = 'public/';

    /**
     * @param $image
     * @param $dir
     * @param string $moduleType
     * @return array
     */
    public function saveImage($image, $dir, $moduleType = 'service')
    {
        $id = Uuid::uuid4()->toString();
        $ext = $image->getClientOriginalExtension();
        $path = $this->rootDir . $moduleType . '/' . $dir;
        Storage::disk()->put($path, $image);
        $modelImage = new File();
        $modelImage->id = $id;
        $modelImage->module_type = $moduleType;
        $modelImage->extension = Str::slug($image->getClientOriginalExtension());
        $modelImage->path = $path;
        $modelImage->file_location = Storage::disk()->put($path, $image);
        $modelImage->created_at = Carbon::now('Asia/Jakarta')->toIso8601String();
        $modelImage->save();
        return [
            'id' => $modelImage->id,
            'file_location' => $modelImage->file_location,
            'extension' => $modelImage->extension,
        ];
    }
}
