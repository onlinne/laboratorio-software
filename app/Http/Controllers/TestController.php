<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Test;
use Auth;
use App\UserTest;

class TestController extends Controller
{
    public function index()
    {

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
        if (Auth::check()) {
            $usertest = UserTest::where('user_id', '=', Auth::id())
                                    ->get();
            $tests = [];
            foreach ($usertest as $row) {
                $tests[] = $row->test;
            }
            $tests = collect($tests);
        } else {
            */
            $tests = Test::all();
        //}
        if ($tests->isEmpty()) {
            \Session::flash('test', 'No se ha encontrado examenes para realizar');
        } else {
            foreach ($tests as $test) {
                $test->author = User::find($test->user_id);
            }
        }
        return view('tests', compact('tests'));
    }
    /*
    public function account(Test $_test)
    {
        $_test = Test::find(Auth::id());
        $submitbuttontext = "Actualizar";
        return view('_test.edit', compact('submitbuttontext', '_test'));
    }
    */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $submitbuttontext = "Crear";
        return view('tests.create', compact('submitbuttontext'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input =$request->all();
        //$input['thumbnail'] = $request->file('thumbnail')->store('imagen');
        $input['user_id'] = Auth::id();
        $test = Test::create($input);
        \Session::flash('flash_message', 'Una nueva pregunta ha sido creada!');
        $author = User::find($test->user_id);
        return redirect(route('home'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Test $test)
    {
        $user = Auth::user();
        $text = UserTest::where('user_id' , '=', $user->id)->where('test_id', '=', $test->id)->get()->first();
        //$text = Test::where('id', '=', $test->id)->get()->first();
        //$enroll = (isset($text))?$text->course_enrolled:'';
        //$comp = UserCourse::where('user_id', '=', $user->id)->where('course_id', '=', $course->id)->get()->first();
        //$complete = (isset($comp) && $comp->course_completed == 1)?$comp->course_completed:false;
        $author = User::find($test->user_id);
        return view('tests.singletest', compact('test','author'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Test $test)
    {
        $submitbuttontext = "Editar";
        return view('tests.edit', compact('test','submitbuttontext'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Test $test, Request $request)
    {
        $input = $request->all();
        //$input['thumbnail'] = $request->file('thumbnail')->store('imagen');
        $test->update($input);
        \Session::flash('flash_message', 'La pregunta ha sido modificada!');
        return redirect(route('test.edit',[$test['id']]));
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $test = Test::find($id);
        $test->delete();
        \Session::flash('flash_message', 'Pregunta Eliminada!');
        // dd($course);
        return redirect(route('test.index'));
    }



    //-----------------------------------------------------------
    
}
