<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\http\Requests\ReviewForm;
use App\http\Requests\ItemForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating an Item.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $manufacturers = DB::table('manufacturers')->get();
        return view('item.create', compact('manufacturers'));
    }

    /**
     * Store a newly created Item.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeItem(ItemForm $request)
    {
        $refinedName = preg_replace('/\s+/', '', $request->name);
        $refinedManufacturer = preg_replace('/\s+/', '', $request->manufacturer);
        
        //create a new manufacturer
        DB::table('manufacturers')->insert(['name' => $request->manufacturer, 'sku' => $refinedManufacturer.'/m/a'.rand(1,9)]);

        $manufacturerId = DB::table('manufacturers')->where('name', $request->manufacturer)->first();
        // store image
        $path = Storage::disk('local')->put('public', $request->path);
        
         DB::table('items')->insert(['name' => $request->name, 'sku' => $request->refinedName.rand(1000,6000), 'about' => $request->about, 'price' => $request->price, 'manufacturer_id' => $manufacturerId->id, 'image_path' => $path, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);

        //Return to review page and flash message.
        Session::flash('success', 'You have created a new Item.');
        return redirect('/');
    }

    /**
     * Display an Item.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($sku)
    {
        $item = DB::table('items')->where('sku', $sku)->first();
        $manufacturer = DB::table('manufacturers')->where('id', $item->manufacturer_id)->first();
        $reviews = DB::table('reviews')->where('item_id', $item->id)->get();
        return view('item.item', compact('item', 'reviews', 'manufacturer'));
    }

    /**
     * Display review item form
     *
     * @return
     */
    public function showReview($sku)
    {
        $item = DB::table('items')->where('sku', $sku)->first();
        return view('item.review', compact('item'));
    }

    /**
     * Store an item's review
     * 
     * @param $request
     * @return response
     */
    public function storeReview(ReviewForm $request)
    {
        //find item
        $item = DB::table('items')->find($request->item_id);

        // store the user first is it user_name exists in request object
        if($request->user_name){

        
            DB::table('users')->insert(['user_name' => $request->user_name, 
                                        'slug' => $request->user_name.rand(1000,6)]);

             $user =  DB::table('users')->where('user_name', $request->user_name)->first();
           
            //add user to sessiom
            Session::put('user', $request->user_name);

            //check if the user_id exists on the review table
             $useridOnReview = DB::table('reviews')->where('user_id', $user->id)->where('item_id', $item->id)->first();

            if(!$useridOnReview){

                // create review on it
                DB::table('reviews')->insert(['rating' => $request->rating, 'comment' => $request->comment, 'user_id' => $user->id, 'item_id' => $request->item_id, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);

                //Return to review page and flash message.
                Session::flash('success', 'Your review has been posted.');
                return redirect('item/'.$item->sku);
            }
            Session::flash('fail', 'Your can not review this item twice, but you can edit you previous review.');
            return redirect('item/'.$item->sku);

        }

        //if a no user_name in request, it means a user exists  in session, so we find it
            $user_name = Session::get('user');
            $user = DB::table('users')->where('user_name', $user_name)->first();

            $useridOnReview = DB::table('reviews')->where('user_id', $user->id)->where('item_id', $item->id)->first();

            if(!$useridOnReview){

                //Now store the review
                DB::table('reviews')->insert(['rating' => $request->rating, 'comment' => $request->comment, 'user_id' => $user->id, 'item_id' => $request->item_id, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);

                //Return to review page and flash message.
                Session::flash('success', 'Your review has been posted.');
                return redirect('item/'.$item->sku);
                
            }

            Session::flash('fail', 'Your can not review this item twice, but you can edit you previous review.');
            return redirect('item/'.$item->sku);
    }

    /**
     * Show the form for editing a review.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editReview($id)
    {
        $review = DB::table('reviews')->find($id);
        $item =  DB::table('items')->find($review->item_id);
        return view('item.edit-review', compact('review', 'item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateReview(Request $request)
    {
        // dd($request->all());

        //check if request has username
        if($request->user_name){
            //firstly check if usernamae exist 
            $user = DB::table('users')->where('user_name', $request->user_name)->first();
                // add this user to session
                Session::put('user', $user->user_name);

            if($user){

                // find review and if the user id is what created the review initially
                $review = DB::table('reviews')->where('user_id', $user->id)
                                                ->where('item_id', $request->item_id)->first();
                if($review){
                    
                    //finding item
                    $item = DB::table('items')->where('id', $review->item_id)->first();
                   
                    DB::table('reviews')->where('user_id', $user->id)
                                                ->where('item_id', $request->item_id)->update(['comment' => $request->comment, 'rating' => $request->rating]);

                    Session::flash('success', 'Your previous review has been updated successfully.');
                    return redirect('item/'.$item->sku);
                }
                Session::flash('fail', 'Sorry you can only edit a review originally created by you.');
                return back();
            }

            Session::flash('fail', 'This user name does not exist in our database');
            return back();
            
        }

        //If user is not in the request object then user exists in session
         $user_name = Session::get('user');

         // still check if user exists
         $user = DB::table('users')->where('user_name', $user_name)->first();
          if($user){
                // find review and if the user id is what created the review initially
                $review = DB::table('reviews')->where('user_id', $user->id)
                                                ->where('item_id', $request->item_id)->first();
                                               
                if($review){

                    //finding item
                    $item = DB::table('items')->where('id', $review->item_id)->first();
                   
                    DB::table('reviews')->where('user_id', $user->id)
                                                ->where('item_id', $request->item_id)->update(['comment' => $request->comment, 'rating' => $request->rating]);
                   
                    
                    Session::flash('success', 'Your previous review has been updated successfully.');
                    return redirect('item/'.$item->sku);
                }
                Session::flash('fail', 'Sorry you can only edit a review originally created by you.');
                return back();
            }

        Session::flash('fail', 'This user name does not exist in our database');
        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
