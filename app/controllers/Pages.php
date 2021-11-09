<?php
/**
 *
 */
class Pages extends Controller {

  function __construct(){
  }

  public function index(){

    if (is_logged_in()) {
      redirect('posts');
    }

  	$my_data = [
  		'title' => 'SharePost'
  	];
  	$this->load_view('pages/welcome', $my_data);
  }

  public function about($value='')
  {
    $this->load_view('pages/about');
  }

  public function get_req(){
    $response = file_get_contents('https://jsonplaceholder.typicode.com/posts/1');
    $response_json = json_decode($response);
    var_dump($response_json->title);
  }

  public function get_using_curl($value=''){
    $curl =  curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://jsonplaceholder.typicode.com/posts/1' );
    curl_setopt($curl,CURLOPT_RETURNTRANSFER, True);
    $resp = curl_exec($curl);
    echo $resp;
  }

}
