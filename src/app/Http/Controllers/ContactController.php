<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('contact/index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->all();
        $contact['tel'] = $request->tel1 . $request->tel2 . $request->tel3;

        // 性別は数字のまま保持 表示用ラベル作成
        $gender = $contact['gender'];
        $genderLabels = [
            1 => '男性',
            2 => '女性',
            3 => 'その他',
        ];
        $contact['gender_label'] = $genderLabels[$gender];

        $category = Category::find($request->input('category_id'));
        $contact['category_content'] = $category->content;

        return view('contact/confirm', compact('contact'));
    }

    public function store(Request $request)
    {

        if ($request->input('action') === 'back') {
            return redirect('/')->withInput();
        }

        if ($request->input('action') === 'submit') {

            $tel = $request->tel1 . $request->tel2 . $request->tel3;

            $contact = $request->only([
                'last_name',
                'first_name',
                'gender',
                'email',
                'adress',
                'building',
                'category_id',
                'detail',
            ]);

            $contact['tel'] = $tel;

            Contact::create($contact);
            return redirect('/thanks');
        }
    }

    public function thanks()
    {
        return view('contact.thanks');
    }
}
