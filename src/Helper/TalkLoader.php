<?php

namespace Solcre\ptptalks\Helper;

use Solcre\ptptalks\Entity\Talk;

class TalkLoader
{
    public static function load($path)
    {
        if (!is_dir($path)) {
            return [];
        }
        
        $files = glob($path . "[0-9]*.json");
        if (!$files) {
            return [];
        }

        $talks = [];
        foreach ($files as $file) {
            $content = file_get_contents($file);
            if (!$content) {
                continue;
            }

            $talksDef = json_decode($content, true);
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

        return $talks;
    }
}
