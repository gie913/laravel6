<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MoviesController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function get()
    {

        return response(['test'=>'Hello World'], 200);
    }

    public function toprated($page)
    {
        $pagenumber = isset($page)?$page:1;
        $target_api = env('API_MOVIE')."3/movie/top_rated?api_key=".env('API_MOVIE_KEY')."&language=en-US&page=".$pagenumber;
        $data = $this->guzzle($target_api);
        $decode = json_decode($data);
        $current_page = $decode->page;
        $total_pages = $decode->total_pages;
        $total_results= $decode->total_results;
        $results = $decode->results;
        $genres = $this->genres();
        return view('TopRatedMovie', compact('current_page','total_pages','total_results','results','genres'));
    }

    public function upcoming($page)
    {
        $pagenumber = isset($page)?$page:1;
        $target_api = env('API_MOVIE')."3/movie/upcoming?api_key=".env('API_MOVIE_KEY')."&language=en-US&page=".$pagenumber;
        $data = $this->guzzle($target_api);
        $decode = json_decode($data);
        $current_page = $decode->page;
        $total_pages = $decode->total_pages;
        $total_results= $decode->total_results;
        $results = $decode->results;
        $genres = $this->genres();
        return view('UpcomingMovie', compact('current_page','total_pages','total_results','results','genres'));
    }

    public function nowplaying($page)
    {
        $pagenumber = isset($page)?$page:1;
        $target_api = env('API_MOVIE')."3/movie/now_playing?api_key=".env('API_MOVIE_KEY')."&language=en-US&page=".$pagenumber;
        $data = $this->guzzle($target_api);
        $decode = json_decode($data);
        $current_page = $decode->page;
        $total_pages = $decode->total_pages;
        $total_results= $decode->total_results;
        $results = $decode->results;
        $genres = $this->genres();
        return view('NowPlayingMovie', compact('current_page','total_pages','total_results','results','genres'));
    }

    public function popular($page)
    {
        $pagenumber = isset($page)?$page:1;
        $target_api = env('API_MOVIE')."3/movie/popular?api_key=".env('API_MOVIE_KEY')."&language=en-US&page=".$pagenumber;
        $data = $this->guzzle($target_api);
        $decode = json_decode($data);
        $current_page = $decode->page;
        $total_pages = $decode->total_pages;
        $total_results= $decode->total_results;
        $results = $decode->results;
        $genres = $this->genres();
        return view('PopularMovie', compact('current_page','total_pages','total_results','results','genres'));
    }

    public function guzzle($url)
    {
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', $url);
        return $res->getBody();
    }

    private function genres()
    {
        $target_api = env('API_MOVIE')."3/genre/movie/list?api_key=".env('API_MOVIE_KEY')."&language=en-US";
        $data = $this->guzzle($target_api);
        $decode = json_decode($data);
        $list_genre = [];
        foreach($decode->genres as $genre)
        {
            $list_genre[$genre->id] = $genre->name;
        }
        return $list_genre;
    }


}
