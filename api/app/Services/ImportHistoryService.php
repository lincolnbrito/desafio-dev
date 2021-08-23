<?php

namespace App\Services;

use App\Models\ImportHistory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImportHistoryService
{
    public function getModel(): ImportHistory
    {
        return new ImportHistory();
    }

    /**
     * @param UploadedFile $file
     * @return mixed
     */
    public function save(UploadedFile $file)
    {
        $hash = $this->getHash($file);
        $path = Storage::putFileAs('imports', $file, $hash.'.'.$file->extension());

        return $this->getModel()->firstOrCreate(
            [ 'hash' => $hash ],
            [
                'filename' => $file->getClientOriginalName(),
                'path' => $path
            ]
        );
    }

    /**
     * @param $file
     * @return mixed
     */
    public function find($file)
    {
        return $this->getModel()->firstWhere('hash', $this->getHash($file));
    }

    /**
     * @param $file
     * @return false|string
     */
    public function getHash($file)
    {
        return hash('sha1', $file->getContent());
    }
}
