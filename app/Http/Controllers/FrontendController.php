<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuizUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class FrontendController extends Controller
{
    public function index()
    {
        session()->forget('quiz_user');
        session()->forget('user_info');
        return Inertia::render('Frontend/HomePage');
    }

    public function quiz_page()
    {
        if (empty(session()->get('quiz_user'))){
            return redirect()->route('front.index')
                ->with('error', 'Please Fill Up the Form and Start the Test');
        }
        $questions = Question::where('status', 1)->latest()->get();
        return Inertia::render('Frontend/QuizPage', compact('questions'));
    }

    public function result_page()
    {
        if (empty(session()->get('user_info'))){
            return redirect()->route('front.index')
                ->with('error', 'Please Fill Up the Form and Start the Test');
        }
        $userInfo = session()->get('user_info');
        return Inertia::render('Frontend/ResultPage', compact('userInfo'));
    }

    public function user_register(Request $request)
    {
        Validator::make($request->all(), [
            'first_name' => ['required','string'],
            'last_name' => ['required','string'],
            'phone_no' => ['required','string'],
            'email' => ['required','string'],
            'pin_code' => ['required','string'],
            'city' => ['required','string'],
        ])->validate();

        try {
            DB::beginTransaction();
            $quizUser = QuizUser::create([
                'first_name'=> $request->first_name,
                'last_name'=> $request->last_name,
                'phone_no'=> $request->phone_no,
                'email'=> $request->email,
                'pin_code'=> $request->pin_code,
                'city'=> $request->city,
                'status'=>1
            ]);
            if (!empty($quizUser)){
                session()->put('quiz_user', $quizUser->fresh());
                DB::commit();
                return redirect()->route('front.quiz')
                    ->with('success', 'You Successfully Start the Test');
            }
            throw new \Exception('Invalid Question Information');
        }catch (\Exception $ex){
            DB::rollBack();
            return redirect()->back()
                ->with('error', $ex->getMessage());
        }
    }

    public function quiz_store(Request $request)
    {
        Validator::make($request->all(), [
            'answers' => ['required','array'],
            'answers.*.ans' => ['required'],
        ])->validate();

        try {
            DB::beginTransaction();
            $qUser = session()->get('quiz_user');
            if(empty($qUser)){
                throw new \Exception('Invalid Information. Reload and Try again');
            }
            $quizUser = QuizUser::where('id', $qUser['id'])->first();
            if (empty($quizUser)){
                throw new \Exception('Invalid Information. Reload and Try again');
            }

            $count = $right = $wrong = 0;
            foreach ($request->answers as $answer){
                $quesn = Question::where('question_id', $answer['ques_id'])->first();
                if($quesn->right_ans == $answer['ans']){
                    $right++;
                }else{
                    $wrong++;
                }
                $count++;
            }

            $result = ($right/$count)*100;

            $quizUserU = $quizUser->update([
                'result'=> $result,
            ]);
            if (!empty($quizUserU)){
                session()->put('user_info', $quizUser->fresh());
                DB::commit();
                return redirect()->route('front.result')
                    ->with('success', 'You Successfully Complete the Test');
            }
            throw new \Exception('Invalid Information');
        }catch (\Exception $ex){
            DB::rollBack();
            return redirect()->back()
                ->with('error', $ex->getMessage());
        }
    }

    public function print_result()
    {
        if (empty(session()->get('user_info'))){
            return redirect()->route('front.index')
                ->with('error', 'Please Fill Up the Form and Start the Test');
        }
        $userInfo = session()->get('user_info');
        $questions = Question::where('status', 1)->latest()->get();

        return view('print_result', compact('userInfo', 'questions'));

    }

    public function print()
    {
        return view('print_result', compact('userInfo', 'questions'));
    }
}
