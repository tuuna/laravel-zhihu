<?php

namespace App\Http\Controllers;

use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreQuestionRequest;

class QuestionController extends Controller
{
    protected $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->middleware('auth')->except(['index','show']);
        $this->questionRepository = $questionRepository;
    }

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questions.create');
    }

    /**
     * @param StoreQuestionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function store(StoreQuestionRequest $request)
    {
        /*$rules = [
            'title' => 'required|min:2|max:196',
            'body' => 'required|min:10'
        ];

        $message = [
            'title.required' => '标题不能为空',
            'body.required' => '内容太少了'
        ];

        $this->validate($request,$rules,$message);*/

        $topics = $this->questionRepository->normalizeTopic($request->get('topics'));
        $data = [
            'title' => $request->get('title'),
            'body' => $request->get('body'),
            'user_id' => Auth::id()
        ];
        $question = $this->questionRepository->create($data);

//        $question = Question::with('topics')->findOrfail($id);
        $question->topics()->attach($topics);
        return redirect()->route('question.show',[$question->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        $data = Question::where('id',$id)->with('topics')->first();
        $data = $this->questionRepository->byIdWithTopics($id);
        return view('questions.show',['question' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = $this->questionRepository->byIdWithTopics($id);
        if(!Auth::user()->owns($question)) {
            back();
        }
        return view('questions.edit',['question' => $question]);
    }

    /**
     * @param StoreQuestionRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreQuestionRequest $request, $id)
    {
        $question = $this->questionRepository->byId($id);
        $topics = $this->questionRepository->normalizeTopic($request->get('topics'));

        $question->update([
            'title' => $request->get('title'),
            'body' => $request->get('body')
        ]);

        $question->topics()->sync($topics);
        return redirect()->route('question.show',[$question->id]);
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
