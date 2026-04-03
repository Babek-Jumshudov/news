<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\News;
use Illuminate\Support\Facades\Http;


class FetchNews extends Command
{

    protected $signature = 'news:fetch';
    protected $description = 'Fetch news from RSS feeds and NewsAPI';

    // RSS feed-lər
    protected $feeds = [
        'https://oxu.az/rss',                   // Oxu.az
        'https://qafqazinfo.az/rss',            // Qafqazinfo
        'https://milli.az/rss',                 // Milli.az
        'https://trend.az/rss.xml',             // Trend
        'https://feeds.bbci.co.uk/news/rss.xml' // BBC Dünya
    ];

    public function handle()
    {
        $this->fetchFromApi();
        $this->fetchFromRssFeeds();
        $this->info('News fetched successfully!');
    }

    // NewsAPI-dən xəbər çəkmək
    protected function fetchFromApi(): void
    {
        $response = Http::get('https://newsapi.org/v2/top-headlines', [
            'country' => 'us',
            'apiKey' => env('NEWSAPI_KEY') // .env-də saxla
        ]);

        if ($response->successful()) {
            $articles = $response->json()['articles'] ?? [];

            foreach ($articles as $article) {
                if (empty($article['url']))
                    continue;

                News::updateOrCreate(
                    ['link' => $article['url']],
                    [
                        'title' => $article['title'] ?? '',
                        'content' => $article['description'] ?? '',
                        'image' => $article['urlToImage'] ?? null,
                        'published_at' => $article['publishedAt'] ?? now()
                    ]
                );
            }
        }
    }

    // RSS feed-lərdən xəbər çəkmək
    protected function fetchFromRssFeeds(): void
    {
        foreach ($this->feeds as $feedUrl) {
            try {
                // RSS-i HTTP ilə çəkmək
                $response = Http::get($feedUrl);
                if (!$response->ok())
                    continue;

                $rss = @simplexml_load_string($response->body());
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

                    News::updateOrCreate(
                        ['link' => $link],
                        [
                            'title' => (string) $item->title,
                            'content' => strip_tags((string) $item->description),
                            'image' => $image,
                            'published_at' => $published
                        ]
                    );
                }

            } catch (\Exception $e) {
                $this->error("Failed to fetch RSS feed: $feedUrl");
            }
        }
    }

    // RSS item-dən şəkil çıxarma funksiyası
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

        // description içində <img> varsa çıxart
        if (!$image && isset($item->description)) {
            preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $item->description, $matches);
            $image = $matches['src'] ?? null;
        }

        return $image;
    }
}

class NewsController extends Controller
{
    // Xəbərləri list etmək
    public function index()
    {
        $news = News::latest()->paginate(5);

        return view('home.index', compact('news'));
    }

    // Xəbəri silmək
    public function delete($id)
    {
        $news = News::findOrFail($id);

        if ($news->image && file_exists(public_path($news->image))) {
            unlink(public_path($news->image));
        }

        $news->delete();

        return back()->with('success', 'Xəbər silindi!');
    }
}