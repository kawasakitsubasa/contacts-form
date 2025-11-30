<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    /**
     * 入力フォーム表示
     */
    public function index()
    {
        $categories = Category::all();  // カテゴリ一覧取得

        return view('contact.index', compact('categories'));
    }


    /**
     * 確認画面
     */
    public function confirm(ContactRequest $request)
    {

        $inputs = $request->all();

        // カテゴリ名（表示用）
        if (!empty($inputs['category_id'])) {
            $category = Category::find($inputs['category_id']);
            $inputs['category_name'] = $category ? $category->name : '';
        } else {
            $inputs['category_name'] = '';
        }

        return view('contact.confirm', compact('inputs'));
    }


    /**
     * 保存 → Thanks
     */
    public function store(Request $request)
    {
        Contact::create([
            'last_name'   => $request->input('lastname'),
            'first_name'  => $request->input('firstname'),
            'gender'      => $request->input('gender'),
            'email'       => $request->input('email'),
            'tel1'        => $request->input('tel1'),
            'tel2'        => $request->input('tel2'),
            'tel3'        => $request->input('tel3'),
            'address'     => $request->input('address'),
            'building'    => $request->input('building'),
            'category_id' => $request->input('category_id'),
            'detail'      => $request->input('detail'),
        ]);

        return view('contact.thanks');
    }

    public function admin()
    {
    $contacts = Contact::with('category')->paginate(7);
    $categories = Category::all();

    return view('contact.admin', compact('contacts', 'categories'));
    }

    public function search(Request $request)
    {
    $query = Contact::with('category');

    // 名前
    if (!empty($request->keyword)) {
        $keyword = $request->keyword;
        $query->where(function($q) use ($keyword) {
            $q->where('last_name', 'like', "%$keyword%")
              ->orWhere('first_name', 'like', "%$keyword%")
              ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ["%$keyword%"]);
        });
    }

    // メール
    if (!empty($request->email)) {
        $query->where('email', 'like', "%{$request->email}%");
    }

    // 性別
    if (!empty($request->gender)) {
        $query->where('gender', $request->gender);
    }

    // カテゴリー
    if (!empty($request->category_id)) {
        $query->where('category_id', $request->category_id);
    }

    // 日付
    if (!empty($request->date)) {
        $query->whereDate('created_at', $request->date);
    }

    // ページ
    $contacts = $query->paginate(7)->appends($request->all());

    // カテゴリー一覧
    $categories = Category::all();

    return view('contact.admin', compact('contacts', 'categories'));
    }
    public function reset()
    {
    return redirect('/admin');
    }
    private function searchQuery($request)
    {
    $query = Contact::with('category');

    // 名前（姓・名・フルネーム・部分一致）
    if (!empty($request->keyword)) {
        $keyword = $request->keyword;
        $query->where(function($q) use ($keyword) {
            $q->where('last_name', 'like', "%$keyword%")
              ->orWhere('first_name', 'like', "%$keyword%")
              ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ["%$keyword%"]);
        });
    }

    // メール
    if (!empty($request->email)) {
        $query->where('email', 'like', "%{$request->email}%");
    }

    // 性別
    if (!empty($request->gender)) {
        $query->where('gender', $request->gender);
    }

    // カテゴリー
    if (!empty($request->category_id)) {
        $query->where('category_id', $request->category_id);
    }

    // 日付
    if (!empty($request->date)) {
        $query->whereDate('created_at', $request->date);
    }

    return $query;
    }

    public function export(Request $request)
    {
    $query = $this->searchQuery($request);

    $contacts = $query->get();

    $csvFileName = 'contacts_export.csv';

    $csvData = "ID,名前,性別,メール,電話番号,住所,建物名,カテゴリ,内容\n";

    foreach ($contacts as $contact) {

        $gender = [
            1 => '男性',
            2 => '女性',
            3 => 'その他',
        ][$contact->gender];

        $tel = $contact->tel1 . '-' . $contact->tel2 . '-' . $contact->tel3;

        $csvData .= implode(',', [
            $contact->id,
            $contact->last_name . ' ' . $contact->first_name,
            $gender,
            $contact->email,
            $tel,
            $contact->address,
            $contact->building ?? '',
            $contact->category->name ?? '',
            $contact->detail,
        ]) . "\n";
    }

    return response($csvData)
        ->header('Content-Type', 'text/csv')
        ->header("Content-Disposition", "attachment; filename={$csvFileName}");
    }


}


