<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Http\Request;
use App\Http\Requests\QuestionCreateRequest;
use App\Http\Requests\QuestionUpdateRequest;
use Illuminate\Support\Facades\File;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $quiz = Quiz::find($id)->with('questions')->first() ?? abort(404, 'Quiz Bulunamadı');
        return view('admin.question.list', compact('quiz'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $quiz = Quiz::find($id)->first() ?? abort(404, 'Quiz Bulunamadı');
        return view('admin.question.create', compact('quiz'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionCreateRequest $request, $id)
    {
        if($request->hasFile('image')){
            $fileName = md5(uniqid(rand(1000,10000))) . '.' . $request->image->extension();
            $path = 'uploads/' . $fileName;
            $request->image->move(public_path('uploads'), $fileName);
            $request->merge([
                'image' => $path
            ]);
        }
        Quiz::find($id)->questions()->create($request->post());
        return redirect()->route('questions.index', $id)->withSuccess('Soru başarıyla oluşturuldu');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($quiz_id, $quesstion_id)
    {
        $question = Quiz::find($quiz_id)->questions()->whereId($quesstion_id)->first() ?? abort(404, 'Quiz veya soru bulunamadı');
        return view('admin.question.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionUpdateRequest $request, $quiz_id, $quesstion_id)
    {
        $question = Quiz::find($quiz_id)->questions()->whereId($quesstion_id)->first() ?? abort(404, "Quiz veya soru bulunamadı");
        if($request->hasFile('image')){
            $fileName = md5(uniqid(rand(1000,10000))) . '.' . $request->image->extension();
            $path = 'uploads/' . $fileName;
            $request->image->move(public_path('uploads'), $fileName);
            $request->merge([
                'image' => $path
            ]);
            if(File::exists($question->image)){
                File::delete(public_path($question->image));
            }
        }
        $question->update($request->post());
        return redirect()->route('questions.index', $quiz_id)->withSuccess('Soru başarıyla güncellendi');
    }

    public function removePhoto(Request $request){
        $question = Quiz::find($request->quiz_id)->questions()->whereId($request->question_id)->first() ?? abort(404, "Quiz veya soru bulunamadı");
        if(File::exists($question->image)){
            File::delete(public_path($question->image));
            $question->update([
                'image' => null
            ]);
            return response('success', 200);
        }else{
            return response('error', 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($quiz_id, $quesstion_id)
    {
        $question = Quiz::find($quiz_id)->questions()->whereId($quesstion_id)->first() ?? abort(404, "Quiz veya soru bulunamadı");
        if(File::exists($question->image)){
            File::delete(public_path($question->image));
        }
        $question->delete();
        return redirect()->route('questions.index', $quiz_id)->withSuccess("Soru başarıyla silindi");
    }


}
