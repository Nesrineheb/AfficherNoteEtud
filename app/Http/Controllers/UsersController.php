<?php
 
namespace App\Http\Controllers;
 
use App\User;
use Illuminate\Http\Request;
use Redirect,Response;
 
class UsersController extends Controller
{
/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
public function index()
{
    if(request()->ajax()) {
        return datatables()->of(User::select('*'))
        ->addColumn('action', 'action_button')
        ->rawColumns(['action'])
        ->addIndexColumn()
        ->make(true);
    }
    return view('list');
}
 
 
/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function store(Request $request)
{  
    $userId = $request->user_id;
    $user   =   User::updateOrCreate(['id' => $userId],
                ['name' => $request->name, 'email' => $request->email]);        
    return Response::json($user);
}
 
 
/**
 * Show the form for editing the specified resource.
 *
 * @param  \App\Product  $product
 * @return \Illuminate\Http\Response
 */
public function edit($id)
{   
    $where = array('id' => $id);
    $user  = User::where($where)->first();
 
    return Response::json($user);
}
 
 
/**
 * Remove the specified resource from storage.
 *
 * @param  \App\Product  $product
 * @return \Illuminate\Http\Response
 */
public function destroy($id)
{
    $user = User::where('id',$id)->delete();
 
    return Response::json($user);
}
}