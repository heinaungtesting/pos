<?php

namespace App\Http\Controllers\Customer;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class CustomerController extends Controller
{
    function customerhome(){
        $categories=Category::get();
        if(request('sorting')){
            explode(",",request('sorting'));

        }

        $products=Product::select('products.id','products.name','products.price','products.description','products.image','categories.name as category_name',)
        ->leftJoin('categories','products.category_id','categories.id')
        ->when(request('categoryid'),function($query){//search category
            $query->where('products.category_id',request('categoryid'));
        })->when(request('key'),function($query){//search by name
            $query->where('products.name','like','%'.request('key').'%');
        })
        ->when(request('sorting'),function($query){//sort by
           $sortrule= explode(",",request('sorting'));
           $sortname='products.'.$sortrule[0];//products.price,products.name,products.created_at
           $sortby=$sortrule[1];//asc.desc
            $query=$query->orderBy($sortname,$sortby );
        })
        //min=true max=true
        ->when(request('minprice')!=null && request('maxprice')!=null, function($query) {
            $query=$query->whereBetween('products.price',[request('minprice'),request('maxprice')]);
        })
        ->when(request('minprice')!=null && request('maxprice')==null, function($query) {//min=true max =false
            $query=$query->where('products.price','>=',request('minprice'));
        })->when(request('minprice')==null && request('maxprice')!=null, function($query) {//min=false max =true
            $query=$query->where('products.price','<=',request('maxprice'));
        })
        ->paginate(8);
        return view('customer.home.list',compact('products','categories'));
    }
    function customerinfo(){
        return view('customer.profile.accountinfo');
    }
    function updateinfo($id){

        $userinfo=User::where('id',$id)->get();
        return view('customer.profile.edit',compact('userinfo'));




    }
    function editinfo(Request $req){
        $this->checkinfo($req);
        $data=$this->data($req);
        if($req->hasFile('image')){
            if(Auth::user()->profile!=null){
                if(file_exists(public_path('/profile/'.Auth::user()->profile))){
                    unlink(public_path('/profile/'.Auth::user()->profile));
                }

            }
            $filename=uniqid().$req->file('image')->getClientOriginalName();
            $req->file('image')->move(public_path().'/profile/',$filename);
            $data['profile']=$filename;


        }else{
            $data['profile']=Auth::user()->profile;
        }
        User::where('id',Auth::user()->id)->update($data);
Alert::success('Profile Changed','Profile Changed Successfully');
return to_route('customerhome');

    }
    function updateuserpassword(){

        return view('customer.profile.changepasswordpage');
    }
    function edit(Request $req){
$this->checkuser($req);
$currentpassword=Auth::user()->password;
if(Hash::check($req->oldpassword,$currentpassword)){
User::where('id',Auth::user()->id)->update(['password'=>Hash::make($req->newpassword)]);
Alert::success('Password Change','Password Change successfully');
return to_route('customerhome');

}


    }


    private function checkuser($req){
        $req->validate([
'newpassword'=>'required',
'oldpassword'=>'required',
'conpassword'=>'required|same:newpassword|min:6',

        ]);


    }
    private function checkinfo($req){
        $req->validate([
            'image'=>'required',
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'address'=>'required'
        ]);
    }
    private function data($req){
        return [
            'name'=>$req->name,
            'phone'=>$req->phone,
            'email'=>$req->email,
            'address'=>$req->address,
        ];
    }
}
