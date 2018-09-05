<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Models\User;
use App\Models\Item;
use App\Models\Review;
use App\http\Requests\ReviewForm;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display an Item.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($sku)
    {
        $item = Item::where('sku', $sku)->first();
        $reviews = Review::where('item_id', $item->id)->first();
        return view('item.item', compact('item', 'reviews'));
    }

    /**
     * Display review item form
     *
     * @return
     */
    public function showReview($sku)
    {
        $item = Item::where('sku', $sku)->first();
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
        dd($item);
        // store the user first is it user_name exists in request object
        if($request->user_name){

            //add user to sessiom
            Session::put('user', $request->user_name);

            $user = new User();
            $user->user_name = $request->user_name;
            $user->slug = $request->user_name.rand(1,6);
            $user->save();

            //check if the user_id exists on the review table

            $review =  new Review();
            $review->ratings = $request->rating;
            $review->comments = $request->comment;
            $review->user_id = $user->id;
            $review->item_id = $request->item_id;
            $review->save();

            //Return to review page and flash message.
            Session::flash('success', 'Your review has been posted.');
            return redirect('item/'.$item->sku);
        }

        //if a no user_name in request, it means a user exists  in session, so we find it
            $user_name = Session::get('user');
            $user = DB::table('users')->where('user_name', $user_name)->first();

            $useridOnReview = DB::table('reviews')->where('user_id', $user->id)->where('item_id', $item->id)->first();

            if(!$useridOnReview){

                //Now store the review
                $review =  new Review();
                $review->ratings = $request->rating;
                $review->comments = $request->comment;
                $review->user_id = $user->id;
                $review->item_id = $request->item_id;
                $review->save();

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
        return view('item.edit-review', compact('review'));
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
        dd($request->all());
        
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
