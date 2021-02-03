<?php

namespace Flipper\Module\Support;
use Illuminate\Support\Facades\File;

class Stub
{
    protected static function formatTrasnformKey($tranformer)
    {
        $newTranformer = [];
        
        foreach ($tranformer as $key => $value) {
            $newTranformer["{{ $$key }}"] = $value;
        }

        return $newTranformer;
    }

    public static function convert($path, $tranformer, $extension)
    {
        $tranformer = static::formatTrasnformKey($tranformer);
        $content = File::get($path);
        $content = strtr($content, $tranformer);
        
        File::put($path, $content);
        File::move($path, str_replace('.stub', ".$extension", $path));
    }
}