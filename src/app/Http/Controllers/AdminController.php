<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    public function index()
    {
        $contacts = Contact::with('category')->paginate(8);
        $contents = Category::all();
        return view('admin.index', ['user' => Auth::user()], compact('contacts', 'contents'));
    }

    public function search(Request $request)
    {
        $contents = Category::all();
        $contacts = Contact::with('category')
            ->ContactSearch($request->all())
            ->paginate(7)
            ->appends($request->query());
        return view('admin.index', compact('contacts', 'contents'));
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect('/admin');
    }

    public function export(Request $request)
    {
        // 検索条件を適用してデータ取得
        $contacts = Contact::with('category')
            ->ContactSearch($request->all())
            ->get();

        // CSVのヘッダー行
        $csv = "お名前,性別,メールアドレス,電話番号,住所,建物名,お問い合わせの種類,お問い合わせ内容,登録日時\n";

        foreach ($contacts as $c) {
            // 性別とカテゴリを整形
            $gender = ['1' => '男性', '2' => '女性', '3' => 'その他'][$c->gender] ?? '';
            $category = $c->category->content ?? '未分類';

            // 改行・カンマを置換してCSV崩れ防止
            $detail = str_replace(["\r", "\n", ","], ["", "", "、"], $c->detail);
            $adress = str_replace([",", "\r", "\n"], ["、", "", ""], $c->adress);
            $building = str_replace([",", "\r", "\n"], ["、", "", ""], $c->building);

            // 1行分のCSVデータを追加
            $csv .= "{$c->last_name} {$c->first_name},{$gender},{$c->email},{$c->tel},{$adress},{$building},{$category},{$detail},{$c->created_at}\n";
        }

        // 文字コード変換（Excel対応）
        $csv = mb_convert_encoding($csv, 'SJIS-win', 'UTF-8');

        // ファイル名設定
        $filename = 'contacts_' . date('Ymd_His') . '.csv';

        // CSVをダウンロードさせるレスポンスを返す
        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', "attachment; filename={$filename}");
    }
}
