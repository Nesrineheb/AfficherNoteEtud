<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\moymod;
use DataTables;
use DB;

class Full_text_search_Controller extends Controller
{
    function index()
    {
    //	return view('Full_text_search');
    }

    /**
     * action
     *
     * @param  mixed $request
     *
     * @return void
     */
    function action(Request $request)
    { 
    	
            $data = DB::table('moymod')
            ->where("MatrEtud","17/0004")
            ->get();
            //echo $data;
            return $data;
           
    
    }

    /**
     * normal_search
     *
     * @param  mixed $request
     *
     * @return void
     */
    function normal_search(Request $request)
    {
          $data = DB::table('moymod')
          ->where("CodeMod","Anal")
          ->get();
          return  $data;
    }

    /*function hiiteste()
    {
           $afftest="la vie est belle ";
    	
          // echo "hi it is me teste one";
           return 'hello';
   
    }*/

}
