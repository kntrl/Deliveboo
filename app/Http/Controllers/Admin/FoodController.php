<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

// Validation
use App\Http\Requests\FoodRequest;

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
        $courses = $this->course();

        return view('admin.foods.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FoodRequest $request,Slug $slug)
    {

        $form_data = $request->all();

        // Create new Food
        $food = new Food();

        // ADD SLUG
        $food->slug = $slug($form_data['name'],'foods');

        // User Id
        $food->user_id = Auth::user()->id;

        $food->fill($form_data);
        $food->price = round($food->price,2,PHP_ROUND_HALF_DOWN);
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

        $courses = $this->course();

        $data = [
            'food' => $food,
            'courses' => $courses
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
    public function update(FoodRequest $request, $id, Slug $slug)
    {

        $form_data = $request->all();

        $food = Auth::user()->foodOrFail($id);

        //updating is_foodType fields 
        foreach ($food->foodTypes() as $type) {
            $food->$type = isset($form_data[$type]) ? 1 : 0 ;
        }

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

    protected function course()
    {
        return $course =  [
            'Antipasto',
            'Piatto Unico',
            'Primo',
            'Secondo',
            'Contorno',
            'Dolce',
            'Bevande'
        ];
    }


}
