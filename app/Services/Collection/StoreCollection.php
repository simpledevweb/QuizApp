<?php 
namespace App\Services\Collection;

use App\Models\Collection;
use App\Models\Question;
use App\Services\BasicService;
use App\Services\Question\StoreQuestion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class StoreCollection extends BasicService
{
    private array $answers;
    public function rules(): array
    {
        return [
            "category_id" => 'required|exists:categories,id',
            "name" => 'required',
            "description" => 'required',
            "allowed_type" => "required_with:public,url,limited users",
            "questions" => "nullable|array",
            "questions.*.question" => "required_unless:questions,null",
            "questions.*.answers" => "required_unless:questions,null",
            "questions.*.answers.*.answer" => "required_unless:questions,null",
            "questions.*.answers.*.is_correct" => "required_unless:questions,null|boolean",
            "allowed_users"=> "required_unless:allowed_type,public,url|array"
        ];
    }

    public function execute(array $data)
    {
        $this->validate($data);
        $collection = Collection::create([
            'category_id' => $data['category_id'],
            'user_id' => Auth::id(),
            'name' => $data['name'],
            'description' => $data['description'],
            'code' => Str::random(30),
            'allowed_type' => $data['allowed_type'],
        ]);
        if($data['questions']!=null){
                app(StoreQuestion::class)->execute([
                    'questions'=>$data['questions'],
                    'collection_id'=>$collection->id
                ]);
            }
        if($data['allowed_users']!=null){
            $users=[];
            foreach($data['allowed_users'] as $user){
            $users[]=[
                'user_id'=>$user,
                'collection_id'=>$collection->id
            ];
            }
            DB::table('allowed_users')->insert($users);
        }


        return true;
    }
}

?>