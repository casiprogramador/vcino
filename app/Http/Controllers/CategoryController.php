<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Category;
use Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Auth::user()->company;

        $category = Category::where('company_id',$company->id );
        return view('categories.index')->with('categories',$category->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'tipo_categoria' => 'required|not_in:0',
            'clase' => 'required|not_in:0',
            'description' => 'required',
            'icono'	=>	'required | mimes:jpeg,jpg,png'
        ]);

        $id = Auth::user()->id;
        $file = $request->file('icono');
        $tmpFilePath = '/img/upload/';
        $tmpFileName = time() . '-'.$id. '-' . $file->getClientOriginalName();
        $file->move(public_path() . $tmpFilePath, $tmpFileName);
        $path = $tmpFilePath . $tmpFileName;

        $company = Auth::user()->company;
        $activa = (empty($request->activa) ? '0' : $request->activa);

        $category = new Category();
        $category->nombre = $request->nombre;
        $category->clase = $request->clase;
        $category->tipo_categoria = $request->tipo_categoria;
        $category->description = $request->description;
        $category->icono = $path;
        $category->activa = $activa;
        $category->company_id = $company->id;

        $category->save();
        Session::flash('message', 'Nueva categoria ingresada correctamente');
        return redirect()->route('config.category.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return view('categories.show')
            ->with('category',$category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('categories.edit')
            ->with('category',$category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'tipo_categoria' => 'required|not_in:0',
            'clase' => 'required|not_in:0',
            'description' => 'required'
        ]);

        if(!empty($request->icono)){
            $user_id = Auth::user()->id;
            $file = $request->file('icono');
            $tmpFilePath = '/img/upload/';
            $tmpFileName = time() . '-'.$user_id. '-' . $file->getClientOriginalName();
            $file->move(public_path() . $tmpFilePath, $tmpFileName);
            $path = $tmpFilePath . $tmpFileName;
        }


        $activa = (empty($request->activa) ? '0' : $request->activa);

        $category = Category::find($id);
        $category->nombre = $request->nombre;
        $category->clase = $request->clase;
        $category->tipo_categoria = $request->tipo_categoria;
        $category->description = $request->description;
        if(!empty($request->icono)) {
            $category->icono = $path;
        }
        $category->activa = $activa;

        $category->save();
        Session::flash('message', 'Categoria actualizada correctamente');
        return redirect()->route('config.category.index');
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
