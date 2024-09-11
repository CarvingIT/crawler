<?php
namespace App\Custom;

use Spatie\Crawler\CrawlObservers\CrawlObserver;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use App\Models\Url;


class CrawlHandler extends CrawlObserver{
    public function willCrawl(UriInterface $url, ?string $linkText): void{
        //echo "Found link - $url\n";
    }

    public function crawled(UriInterface $uri, ResponseInterface $response, 
            ?UriInterface $foundOnUrl = null, ?string $linkText=null): void{
        $uri = (string) $uri;
        echo "Crawled $uri \n";
        
        $url = Url::where('url', $uri)->first();
        if(!$url){
            $url = new Url;
        }
        $url->url = $uri;
        $url->status_code = $response->getStatusCode();
        $headers = $response->getHeaders();
        $headers = array_change_key_case($headers, CASE_LOWER);
        $content_type_ar = explode(";",$headers['content-type'][0]);
        $url->mime_type = $content_type_ar[0];
        $url->content = '';
        if($url->status_code == '200'){
            $body = $response->getBody();
            $body->seek(0);
            while($c = $body->read(1024)){
                $url->content .= $c;
            }
        }

        try{
            $url->save();
        }
        catch(\Exception $e){
            // do nothing
        }
    }

    public function crawlFailed(UriInterface $url, RequestException $requestException, 
            ?UriInterface $foundOnUrl = null, ?string $linkText = null): void {
        echo "Crawl of ".(string) $url." failed\n";  
        echo "Message: ". $requestException->getMessage()."\n";
        echo "Code: ". $requestException->getCode()."\n";
    }

    public function finishedCrawling(): void {
        echo "Finished crawling\n";
    }
}
