<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\News;
use Illuminate\Support\Facades\Http;

class FetchNews extends Command
{
    protected $signature = 'news:fetch';
    protected $description = 'Fetch news from RSS feeds';

    protected $feeds = [
        'https://apa.az/rss',
        'https://report.az/rss/',
        'https://azertag.az/rss',
        'https://oxu.az/rss',
        'https://qafqazinfo.az/rss',
        'https://milli.az/rss',
        'https://trend.az/rss.xml',
        'https://feeds.bbci.co.uk/news/rss.xml'
    ];

    protected function translateToAzerbaijani(string $text): string
    {
        if (empty($text))
            return $text;

        try {
            $response = Http::post('https://libretranslate.com/translate', [
                'q' => $text,
                'source' => 'en',
                'target' => 'az',
                'format' => 'text'
            ]);

            return $response->json('translatedText') ?? $text;

        } catch (\Exception $e) {
            return $text;
        }
    }

    public function handle()
    {
        $this->fetchFromApi();
        $this->fetchFromRssFeeds();
        $this->info('News fetched successfully!');
    }

    protected function fetchFromApi(): void
    {
        $response = Http::get('https://newsapi.org/v2/top-headlines', [
            'country' => 'us',
            'apiKey' => env('NEWSAPI_KEY')
        ]);

        if ($response->successful()) {
            $articles = $response->json()['articles'] ?? [];

            foreach ($articles as $article) {
                if (empty($article['url']))
                    continue;

                $link = $article['url'];
                $image = $article['urlToImage'] ?? null;
                $published = $article['publishedAt'] ?? now();
                $titleAZ = $this->translateToAzerbaijani($article['title'] ?? '');
                $contentAZ = $this->translateToAzerbaijani($article['description'] ?? '');

                News::updateOrCreate(
                    ['link' => $link],
                    [
                        'title' => $titleAZ,
                        'content' => $contentAZ,
                        'image' => $image,
                        'published_at' => $published
                    ]
                );
            }
        }
    }

    protected function fetchFromRssFeeds(): void
    {
        foreach ($this->feeds as $feedUrl) {
            try {
                $context = stream_context_create([
                    'http' => ['header' => "User-Agent: Mozilla/5.0\r\n"]
                ]);

                $xmlString = @file_get_contents($feedUrl, false, $context);
                if (!$xmlString) {
                    $this->error("RSS feed alınmadı: $feedUrl");
                    continue;
                }

                $rss = @simplexml_load_string($xmlString);
                if (!$rss || !isset($rss->channel->item))
                    continue;

                foreach ($rss->channel->item as $item) {
                    $link = (string) $item->link;
                    if (!$link)
                        continue;

                    $image = $this->extractImage($item);
                    $published = isset($item->pubDate)
                        ? date('Y-m-d H:i:s', strtotime($item->pubDate))
                        : now();

                    $titleAZ = $this->translateToAzerbaijani((string) $item->title);
                    $contentAZ = $this->translateToAzerbaijani(strip_tags((string) $item->description));

                    News::updateOrCreate(
                        ['link' => $link],
                        [
                            'title' => $titleAZ,
                            'content' => $contentAZ,
                            'image' => $image,
                            'published_at' => $published
                        ]
                    );
                }

            } catch (\Exception $e) {
                $this->error("Xəta: " . $e->getMessage());
            }
        }
    }

    protected function extractImage($item): ?string
    {
        $image = null;
        $namespaces = $item->getNameSpaces(true);

        if (isset($namespaces['media'])) {
            $media = $item->children($namespaces['media']);
            if (isset($media->thumbnail)) {
                $image = (string) $media->thumbnail->attributes()->url;
            } elseif (isset($media->content)) {
                $image = (string) $media->content->attributes()->url;
            }
        }

        if (!$image && isset($item->description)) {
            preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $item->description, $matches);
            $image = $matches['src'] ?? null;
        }

        return $image;
    }
}