<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //
    public function index(){
        return view('member');
    }
    public function store(Request $req){
        $data=new Member();
        $data->name=$req->input('name');
        $data->last_name=$req->input('last_name');
        $data->address=$req->input('address');
        $data->save();
        return response()->json(['data'=>$data]);
    }
    public function fetch(){
        $data=Member::all();
        return response()->json([
            'data'=>$data,
        ]);
    }
    public function edit(Member $member)
    {
        return response()->json([
            'member'=>$member,
        ]);
    }
    public function update(Request $req,Member $member)
    {
      
            $member->name=$req->input('name');
            $member->last_name=$req->input('last_name');
            $member->address=$req->input('address');
            $member->update();
        return response()->json([
            'member'=>$member,
        ]);
    }
    public function destroy(Request $req,Member $member)
    {
        $member->delete([
            'name'=>$req->name,
            'last_name'=>$req->last_name,
            'address'=>$req->address,
        ]);
        
    }
}