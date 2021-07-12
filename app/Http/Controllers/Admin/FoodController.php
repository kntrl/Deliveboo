<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

//models
use App\Food;

//services
use App\Services\Slug;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foods = Food::where('user_id', '=', Auth::user()->id)->get();

        $data = [
            'foods' => $foods
        ];

        return view('admin.view', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('admin.foods.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Slug $slug)
    {
        // ADD VALIDATION
        $request->validate($this->getValidation());

       $from_data = $request->all();

        

        // Create new Food
        $food = new Food();

        // ADD SLUG
        $food->slug = $slug($from_data['name'],'foods');

        // User Id
        $food->user_id = Auth::user()->id;

        $food->fill($from_data);
        $food->save();

        return redirect()->route('admin.foods.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $food = Food::findOrFail($id);

        if(Auth::user()->id != $food->user_id) {

            return redirect()->route('admin.foods.index');
        }

        $data = [
            'food' => $food
        ];

        return view('show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $food = Food::findOrFail($id);

        if(Auth::user()->id != $food->user_id) {
            return redirect()->route('admin.foods.index');
        }

        $data = [
            'food' => $food
        ];

        return view('admin.foods.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Slug $slug)
    {
        // ADD VALIDATION

        $from_data = $request->all();

        $food = Food::findOrFail($id);

        // ADD SLUG
        $food->slug = Str::slug($from_data['name'], '-');


        // Name check function
        if ($from_data['name'] != $food->name) {
          $food->slug = $slug($from_data['name'],'foods');
        }
        // Update
        $food->update($from_data);

        return redirect()->route('admin.foods.index');

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


    private function getValidation() {

        return [
            'name' => 'required| min: 2| max: 255',
            'price' => 'required| numeric| min: 0| max: 9999,99',
            'course' => 'nullable| max: 20',
            'ingredients' => 'required| max: 2000',
            'available' => 'required| min: 0| max: 1| numeric',
            'is_vegan' => 'nullable| min: 1| max: 1| numeric',
            'is_veggy' => 'nullable| min: 1| max: 1| numeric',
            'is_hot' => 'nullable| min: 1| max: 1| numeric',
            'is_lactose_free' => 'nullable| min: 1| max: 1| numeric',
            'is_gluten_free' => 'nullable| min: 1| max: 1| numeric'
        ];
    }
}
