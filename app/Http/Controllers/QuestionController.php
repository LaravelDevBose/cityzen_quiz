<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionResource;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::where('status', '!=', 0)->latest()->paginate(2);
        $questions = QuestionResource::collection($questions);
        return Inertia::render('Question/Index', compact('questions'));
    }

    public function create()
    {
        return Inertia::render('Question/CreateQuestion');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'question_title' => ['required','string'],
            'hindi_audio' => ['required','mimes:mpga,mp3', 'max:500'],
            'english_audio' => ['required','mimes:mpga,mp3', 'max:500'],
            'gujrati_audio' => ['required','mimes:mpga,mp3', 'max:500'],
            'right_ans' => ['required'],
            'right_ans_img' => ['required', 'image', 'mimes:jpeg,jpg,png,gif','max:1024'],
            'wrong_ans_img' => ['required', 'image', 'mimes:jpeg,jpg,png,gif','max:1024'],
        ])->validate();

        try {
            DB::beginTransaction();

            $hindiAudio = $this->updateAttachment($request->file('hindi_audio'));
            if (empty($hindiAudio)){
                throw new \Exception('Invalid Hindi Audio File');
            }

            $english_audio = $this->updateAttachment($request->file('english_audio'));
            if (empty($english_audio)){
                throw new \Exception('Invalid English Audio File');
            }

            $gujrati_audio = $this->updateAttachment($request->file('gujrati_audio'));
            if (empty($gujrati_audio)){
                throw new \Exception('Invalid Gujrati Audio File');
            }

            $rightImg = $this->updateAttachment($request->file('right_ans_img'));
            if (empty($rightImg)){
                throw new \Exception('Invalid Right Image File');
            }

            $wrongImg = $this->updateAttachment($request->file('wrong_ans_img'));
            if (empty($wrongImg)){
                throw new \Exception('Invalid Wrong Image File');
            }
            $question = Question::create([
                'question_title'=> $request->question_title,
                'hindi_audio'=> $hindiAudio,
                'english_audio'=>$english_audio,
                'gujrati_audio'=>$gujrati_audio,
                'right_ans'=>$request->right_ans,
                'right_ans_img'=>$rightImg,
                'wrong_ans_img'=>$wrongImg,
                'status'=>1
            ]);
            if (!empty($question)){
                DB::commit();
                return redirect()->route('questions.index')
                    ->with('success', 'Question Created Successfully.');
            }
            throw new \Exception('Invalid Question Information');
        }catch (\Exception $ex){
            DB::rollBack();
            return redirect()->back()
                ->with('error', $ex->getMessage());
        }
    }

    public function edit($id)
    {
        $question = Question::findOrFail($id);
        return Inertia::render('Question/UpdateQuestion', compact('question'));
    }

    public function show($id)
    {
        $question = Question::findOrFail($id);
        return Inertia::render('Question/ShowQuestion', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {

        Validator::make($request->all(), [
            'question_title' => ['required','string'],
            'hindi_audio' => ['nullable','mimes:mpga,mp3', 'max:500'],
            'english_audio' => ['nullable','mimes:mpga,mp3', 'max:500'],
            'gujrati_audio' => ['nullable','mimes:mpga,mp3', 'max:500'],
            'right_ans' => ['required'],
            'right_ans_img' => ['nullable', 'image', 'mimes:jpeg,jpg,png,gif','max:1024'],
            'wrong_ans_img' => ['nullable', 'image', 'mimes:jpeg,jpg,png,gif','max:1024'],
        ])->validate();

        try {
            DB::beginTransaction();

            $hindiAudio = $english_audio = $gujrati_audio = $rightImg = $wrongImg = null;
            if(!empty($request->file('hindi_audio'))){
                $hindiAudio = $this->updateAttachment($request->file('hindi_audio'));
                if (empty($hindiAudio)){
                    throw new \Exception('Invalid Hindi Audio File');
                }
            }

            if(!empty($request->file('english_audio'))){
                $english_audio = $this->updateAttachment($request->file('english_audio'));
                if (empty($english_audio)){
                    throw new \Exception('Invalid English Audio File');
                }
            }

            if(!empty($request->file('gujrati_audio'))){
                $gujrati_audio = $this->updateAttachment($request->file('gujrati_audio'));
                if (empty($gujrati_audio)){
                    throw new \Exception('Invalid Gujrati Audio File');
                }
            }

            if(!empty($request->file('right_ans_img'))){
                $rightImg = $this->updateAttachment($request->file('right_ans_img'));
                if (empty($rightImg)){
                    throw new \Exception('Invalid Right Image File');
                }
            }

            if(!empty($request->file('wrong_ans_img'))){
                $wrongImg = $this->updateAttachment($request->file('wrong_ans_img'));
                if (empty($wrongImg)){
                    throw new \Exception('Invalid Wrong Image File');
                }
            }


            $question = Question::find($id);
            if (empty($question)){
                throw new \Exception('Invalid Question Information');
            }

            $questionUpdate = $question->update([
                'question_title'=> $request->question_title,
                'hindi_audio'=> !empty($hindiAudio)? $hindiAudio: $question->hindi_audio,
                'english_audio'=> !empty($english_audio)? $english_audio: $question->english_audio,
                'gujrati_audio'=> !empty($gujrati_audio)? $gujrati_audio: $question->gujrati_audio,
                'right_ans'=>$request->right_ans,
                'right_ans_img'=> !empty($rightImg)? $rightImg: $question->right_ans_img,
                'wrong_ans_img'=> !empty($wrongImg)? $wrongImg: $question->wrong_ans_img,
                'status'=>1
            ]);
            if (!empty($questionUpdate)){

                DB::commit();
                return redirect()->route('questions.index')
                    ->with('success', 'Question Updated Successfully.');
            }
            throw new \Exception('Invalid Question Information');
        }catch (\Exception $ex){
            DB::rollBack();
            return redirect()->back()
                ->with('error', $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        try{
            $question = Question::find($id);

            if (empty($question)){
                throw new \Exception('Invalid Question Information',Response::HTTP_NOT_FOUND);
            }
            $updateStatus = $question->update([
                'status'=> 0
            ]);
            if(!empty($updateStatus)){
                DB::commit();
                return redirect()->route('questions.index')
                    ->with('success', 'Question Deleted Successfully.');
            }

            throw new \Exception('Invalid Question Information',Response::HTTP_NOT_FOUND);
        }catch(\Exception $ex){
            DB::rollBack();
            return redirect()->back()
                ->with('error', $ex->getMessage());
        }
    }

    public function updateAttachment(UploadedFile $file)
    {
        return $file->storePublicly(
            'questions', ['disk' => config('filesystems.default')]
        );
    }
}
