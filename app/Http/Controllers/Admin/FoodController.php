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
        return view('admin.foods.index');
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

        $form_data = $request->all();

        // Create new Food
        $food = new Food();

        // ADD SLUG
        $food->slug = $slug($form_data['name'],'foods');

        // User Id
        $food->user_id = Auth::user()->id;

        $food->fill($form_data);
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
        $food = Auth::user()->foodOrFail($id);

        $data = [
            'food' => $food
        ];

        return view('admin.foods.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $food = Auth::user()->foodOrFail($id);

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
        $request->validate($this->getValidation());

        $form_data = $request->all();

        $food = Food::findOrFail($id);

        // Checking if slugs needs an update.
        if ($form_data['name'] != $food->name) {
          $food->slug = $slug($form_data['name'],'foods');
        }
        // Update
        $food->update($form_data);

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
        $food = Auth::user()->foodOrFail($id);

        $food->delete();

        return redirect()->route('admin.foods.index');
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
