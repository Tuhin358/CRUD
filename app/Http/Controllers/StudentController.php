<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){
        $students=Student::latest()->get();
        return view('crud',compact('students'));
    }

    public function store(Request $request){
        $request->validate([
            'name'=> 'required',
            'roll'=> 'required',
            'class'=> 'required',

        ],[
            'name.required'=>'Please Input your Name',
            'roll.required'=>'Please Input your Roll',
            'class.required'=>'Please Input your Class',

        ]);
        Student::insert([
            'name'=>$request->name,
            'roll'=>$request->roll,
            'class'=>$request->class,

        ]);
        return redirect()->back()->with('success','Successfully Data Added');

    }


    public function edit($id){
        $student=Student::findOrfail($id);
        return view('edit',compact('student'));

    }



    public function update(Request $request,$id){

        Student::findOrFail($id)->update([
            'name'=>$request->name,
            'roll'=>$request->roll,
            'class'=>$request->class,

        ]);
        return redirect()->to('/crud')->with('update','Successfully Data Updated');


    }

    public function delete($id){
        Student::FindOrFail($id)->delete();
        return redirect()->to('/crud')->with('delete','Successfully Data Delete');


    }

}
