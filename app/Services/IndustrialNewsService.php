<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class IndustrialNewsService
{
    public function getNews()
    {
        return Cache::remember(
            'industrial_news',
            now()->addMinutes(30),
            function () {

                try {

                    $url = 'https://news.google.com/rss/search?q=industria+manufactura+metalurgia&hl=es-419&gl=CO&ceid=CO:es-419';

                    $response = Http::timeout(10)->get($url);

                    if (!$response->successful()) {
                        return [];
                    }

                    $xml = simplexml_load_string(
                        $response->body()
                    );

                    if (!$xml || !isset($xml->channel->item)) {
                        return [];
                    }

                    $news = [];

                    foreach ($xml->channel->item as $item) {

                        $news[] = [
                            'title' => (string) $item->title,
                            'link'  => (string) $item->link,
                            'date'  => (string) $item->pubDate,
                        ];

                    }

                    return array_slice($news, 0, 6);

                } catch (\Throwable $e) {

                    return [];

                }

            }
        );
    }
}