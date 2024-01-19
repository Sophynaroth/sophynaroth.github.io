<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Gift;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{

    public function index()
    {
        $allQA = Question::paginate(3);

        return view('backend.question', compact('allQA'));
    }

    public function home()
    {
        $allQA = DB::table('questions')->whereNotNull('is_active')->get();
        $image = Gift::where('typeLevel', "index")->first();

        return view('frontend.index', compact('allQA', 'image'));
    }

    public function show()
    {
        $info = Quiz::paginate(10);
        return view('dashboard', compact('info'));
    }

    public function giftPick(string $id)
    {
        $data = Quiz::find($id);
        $data->customerName = $data->customerName;
        $data->phoneNumber = $data->phoneNumber;
        $data->serialNumber = $data->serialNumber;
        $data->gift = $data->gift;
        $data->score = $data->score;
        $data->is_picked = '1';
        $data->save();

        return redirect()->route('dashboard')->with('success', 'Picked Up Succefully');
    }

    public function indexQuiz(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phoneNumber' => 'required',
            'serialNumber' => 'required',
        ]);

        $getCorrectAnswer = DB::table('questions')->get('correctAnswer');
        $totalQuestion = count($getCorrectAnswer);
        $countChecked = count($request->customerAnswer);
        $array = array();
        foreach ($getCorrectAnswer as $data) {
            array_push($array, $data->correctAnswer);
        }

        $totalMark = $totalQuestion * 100;
        $haftMark = $totalMark / 2;
        if ($countChecked == $totalQuestion) {
            $result = array_diff($request->customerAnswer, $array);
            $mark = ($totalQuestion - count($result)) * 100;
        } else {
            $result = array_diff($request->customerAnswer, $array);
            $totalChecked = $totalQuestion - $countChecked;
            $mark1 = $totalChecked + count($result);
            $mark = ($totalQuestion - $mark1) * 100;
        }

        $data = new Quiz;
        $data->customerName = $request->name;
        $data->phoneNumber = $request->phoneNumber;
        $data->serialNumber = $request->serialNumber;
        $data->score = $mark;
        $data->is_picked = '0';

        $customerInfo = array();
        array_push($customerInfo, $request->name);
        array_push($customerInfo, $request->phoneNumber);
        array_push($customerInfo, $request->serialNumber);

        if ($mark == $totalMark) {
            array_push($customerInfo, $mark);
            $giftImage = Gift::where('typeLevel', 'typeA')->first();
            $data->gift = $giftImage->giftName;
            $data->save();
            return view("frontend.gift-result", compact('customerInfo', 'giftImage'));
        } elseif ($mark > $haftMark && $mark < $totalMark) {
            array_push($customerInfo, $mark);
            $giftImage = Gift::where('typeLevel', 'typeB')->first();
            $data->gift = $giftImage->giftName;
            $data->save();
            return view("frontend.gift-result", compact('customerInfo', 'giftImage'));
        } elseif ($mark == $haftMark) {
            array_push($customerInfo, $mark);
            $giftImage = Gift::where('typeLevel', 'typeC')->first();
            $data->gift = $giftImage->giftName;
            $data->save();
            return view("frontend.gift-result", compact('customerInfo', 'giftImage'));
        } else {
            $data->gift = "Not Pass";
            $data->save();
            return view("frontend.gift-fail");
        }
    }

    public function create()
    {
        return view('backend.question-add');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'question' => 'required',
            'answer' => 'required',
            'correctAnswer' => 'required',
        ]);
        $question = new Question;
        $question->question = $request->question;
        $question->answer = $request->answer;
        $question->correctAnswer = $request->correctAnswer;
        $question->is_active = $request->isActive;
        $question->save();

        return redirect()->route('question.index')->with('success', 'Question Added Succefully');
    }


    public function edit(string $id)
    {
        $question = Question::find($id);

        return view('backend.question-edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'question' => 'required',
            'answer' => 'required',
            'correctAnswer' => 'required',
        ]);

        $id = $request->input('id');
        $question = Question::find($id);

        $question->question = $request->question;
        $question->answer = $request->answer;
        $question->correctAnswer = $request->correctAnswer;
        $question->is_active = $request->isActive;
        $question->save();

        return redirect()->route('question.index')->with('success', 'Question Updated Succefully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $answer = DB::table('answers')->where('questionId', $id)->delete();
        $question = Question::find($id);
        $question->delete();
        return redirect()->route('question.index')->with('success', 'Question Deleted Succefully');
    }
}
