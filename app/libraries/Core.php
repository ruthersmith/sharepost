<?php
/**
 * App core class
 *This is the first class being loaded in public/index.php, provides an entry point to the application
 * creates url and loads core controller
 * URL FORMAT - /controller/method/params
 */

class Core{

  //the current controller, method, and params loaded, initialize to our default values
  protected $currentController = 'Pages';
  protected $currentMethod = 'index';
  protected $params = [];

  function __construct(){

    //this should be an array with the name of the controller at the first Index.
    //the name of the method as the second index, any additional indexes would be parametter
    //OR it would be empty
    $url = $this->getUrl();

    //if the url variable is not empy change the defults
    if(!empty($url)){
      //look in controllers for first value as disctated by FORMAT
      if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
        //if exists, set as current controller
        $this->currentController = ucwords($url[0]);
        unset($url[0]);
      }
    }

    //since the file for this controller exist, require that file
    require_once '../app/controllers/' . $this->currentController . '.php';
    //instanciate the controller class
    $this->currentController = new $this->currentController;

    //check that the second part of the url
    if (isset(($url[1]))) {
      //check if method exist in the controller
      if(method_exists($this->currentController, $url[1] )){
        $this->currentMethod = $url[1] ;
        unset($url[1]);
      }
    }

    //get params
    $this->params = $url ? array_values($url) :  [];

    //call a callback with array of params
    call_user_func_array([$this->currentController,$this->currentMethod] ,$this->params );


  }

  public function getUrl(){
    if(isset($_GET['url'])){
      //remove trailing slashes
      $url = rtrim($_GET['url'],'/');
      //filer as a url, making sure that its in a url format
      $url = filter_var($url,FILTER_SANITIZE_URL);
      //break it into an array, essentially split it based on where the
      //charater '/' exists
      $url = explode('/',$url);
      return $url;
    }

  }
}
