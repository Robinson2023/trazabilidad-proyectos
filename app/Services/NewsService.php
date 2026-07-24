<?php

namespace App\Services;

class NewsService
{
    public function getNews()
    {
        $url = 'https://www.thefabricator.com/rss';

        try {

            $rss = simplexml_load_file($url);

            if (!$rss) {
                return [];
            }

            $news = [];

            foreach ($rss->channel->item as $item) {

                $news[] = [

                    'title' => (string) $item->title,

                    'link' => (string) $item->link,

                    'date' => (string) $item->pubDate,

                ];

                if (count($news) >= 5) {
                    break;
                }
            }

            return $news;

        } catch (\Exception $e) {

            return [];
        }
    }
}