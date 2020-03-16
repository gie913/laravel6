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
        echo $data;

    }

    public function upcoming($page)
    {
        $pagenumber = isset($page)?$page:1;
        $target_api = env('API_MOVIE')."3/movie/upcoming?api_key=".env('API_MOVIE_KEY')."&language=en-US&page=".$pagenumber;
        $data = $this->guzzle($target_api);
        echo $data;
    }

    public function nowplaying($page)
    {
        $pagenumber = isset($page)?$page:1;
        $target_api = env('API_MOVIE')."3/movie/now_playing?api_key=".env('API_MOVIE_KEY')."&language=en-US&page=".$pagenumber;
        $data = $this->guzzle($target_api);
        echo $data;
    }

    public function popular($page)
    {
        $pagenumber = isset($page)?$page:1;
        $target_api = env('API_MOVIE')."3/movie/popular?api_key=".env('API_MOVIE_KEY')."&language=en-US&page=".$pagenumber;
        $data = $this->guzzle($target_api);
        echo $data;
    }

    public function guzzle($url)
    {
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', $url);
        return $res->getBody();
    }



}
