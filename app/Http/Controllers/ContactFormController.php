<?php
// php artisan make:controller ContactFormController --resourceコマンドで作成
// CRUD機能

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// ContactFormをインスタンス化し、storeでDBに保存するためにModelsフォルダを呼び出す
use App\Models\ContactForm;
use Illuminate\Support\Facades\DB;
use App\Services\CheckFormData;
// php artisan make:request StoreContactFormで作成したバリデーションファイル
use App\Http\Requests\StoreContactForm;

class ContactFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 検索フォームの値を持てくる必要があるので引数に(Request $request)持てくる
    public function index(Request $request)
    {

        $search = $request->input('search');

        // エロクワント ORマッパー 
        //$contacts = ContactForm::all();

        //クエリビルダ
        // $contacts = DB::table('contact_forms')
        // ->select('id', 'your_name', 'title', 'created_at')
        // ->orderBy('created_at', 'asc')
        // ->paginate(20); ページネーション

        // 検索フォーム
        $query = DB::table('contact_forms');

        // もしキーワードがあったら
        if($search !== null){
            // 全角スペースを半角に
            $search_split = mb_convert_kana($search,'s');

            //空白で区切る
            $search_split2 = preg_split('/[\s]+/', $search_split,-1,PREG_SPLIT_NO_EMPTY);

            //単語をループで回す
            foreach($search_split2 as $value)
            {
            $query->where('your_name','like','%'.$value.'%');
            }
        };
        
        $query->select('id', 'your_name', 'title', 'created_at');
        // orderBy('created_at', 'asc');で作成された順で表示
        $query->orderBy('created_at', 'asc');

        $contacts = $query->paginate(20);

        // compactで渡せる$マークは不要
        return view('contact.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactForm $request)
    {
        // 引数にあるRequest $request 依存性の注入
        // インスタンス化
        $contact = new ContactForm;

        $contact->your_name = $request->input('your_name');
        $contact->title = $request->input('title');
        $contact->email = $request->input('email');
        $contact->url = $request->input('url');
        $contact->gender = $request->input('gender');
        $contact->age = $request->input('age');
        $contact->contact = $request->input('contact');

        // Modelにあるメソッドのsave()を使うことで保存できる。
        $contact->save();

        // 保存後redirect()で強制的に飛ばす
        return redirect('contact/index');

        //dd($your_name, $title);

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
        $contact = ContactForm::find($id);

        // 新しくCheckFormDataを作成しファットコントローラーを防ぐ
        $gender = CheckFormData::checkGender($contact);
        $age = CheckFormData::checkAge($contact);

        //dd($contact);
        // compactは複数の変数を渡すこともできる
        return view('contact.show', 
        compact('contact','gender','age'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $contact = ContactForm::find($id);

        return view('contact.edit', compact('contact'));
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
        // 
        // $contact = new ContactForm;
        $contact = ContactForm::find($id);

        $contact->your_name = $request->input('your_name');
        $contact->title = $request->input('title');
        $contact->email = $request->input('email');
        $contact->url = $request->input('url');
        $contact->gender = $request->input('gender');
        $contact->age = $request->input('age');
        $contact->contact = $request->input('contact');

        // Modelにあるメソッドのsave()を使うことで保存できる。
        $contact->save();

        // 保存後redirect()で強制的に飛ばす
        return redirect('contact/index');

    }

    // 論理削除にするには？
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $contact = ContactForm::find($id);
        $contact->delete();

        return redirect('contact/index');

    }
}
