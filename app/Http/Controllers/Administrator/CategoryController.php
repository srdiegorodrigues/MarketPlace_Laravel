<?php

namespace App\Http\Controllers\Administrator;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\App;

class CategoryController extends Controller
{
    /**
     * @var Category
     */

    private $category;

    public function __construct(Category $category)
    {
        $this->middleware('access.control.administrator')->only(['listCategories']);
        $this->category = $category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->category->paginate(10);

        return view('administrator.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('administrator.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function category(CategoryRequest $request)
    {
        $data = $request->validated();
        $category = $this->category->create($data);
        flash('Categoria '.$data['name']. ' criada com sucesso!')->success();
        return redirect()->route('administrator.categories.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($category)
    {
        $category = $this->category->findOrFail($category);

        return view('administrator.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param  int $category
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $category)
    {

        $data = $request->validated();

        $category = \App\Category::find($category);
        $category->update($data);

        flash('A Categoria '.$data['name'].' foi atualizada com Sucesso!')->success();
        return redirect()->route('administrator.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $category
     * @return \Illuminate\Http\Response
     */
    public function remove($category)
    {

        $category = Category::find($category);
        $name = $category['name'];
        $category->delete();

        flash('Categoria '.$category['name'].' Removida com Sucesso!')->error();
        return redirect()->route('administrator.categories.index');
    }
}
