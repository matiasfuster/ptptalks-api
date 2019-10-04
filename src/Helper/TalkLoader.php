<?php

namespace Solcre\ptptalks\Helper;

use Solcre\ptptalks\Entity\Talk;

class TalkLoader
{
    public static function load($path)
    {
        $talks = [];
        
        if (is_dir($path)) {
            $files = glob($path . "[0-9]*.json");

            foreach ($files as $file) {
                $talksDef = json_decode(file_get_contents($file), true);
                $talks[] = new Talk(
                    $file,
                    $talksDef['speaker'],
                    $talksDef['title'],
                    $talksDef['tags'],
                    $talksDef['slides'],
                    $talksDef['image'],
                    $talksDef['avatar']
                );
            }
        }

        return $talks;
    }
}
