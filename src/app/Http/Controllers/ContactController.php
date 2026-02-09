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
        return view('index',compact('categories'));
    }
    
    public function confirm(ContactRequest $request)
    {
        if ($request->input('action') === 'back') 
        {
        return redirect('/')->withInput();
        }

        $contact = $request->only(['last_name','first_name','gender','email','tel1','tel2','tel3','address','building','detail','category_id']);
        $category = Category::find($request->category_id);
        $contact['content']= $category->content;
        $genders = config('contact.gender');
        $contact['gender_label'] = $genders[$request->gender];
        return view('confirm',compact('contact'));
    }

    public function store(ContactRequest $request)
    {
        $tel = $request->tel1 . $request->tel2 . $request->tel3;
        $contact = $request->only(['last_name','first_name','gender','email','address','building','detail','category_id']);
        $contact['tel'] = $tel;

        Contact::create($contact);

        return view('thanks');

    }

   private function buildSearchQuery($request)
{
    return Contact::with('category')
        ->keywordSearch($request->keyword)
        ->genderSearch($request->gender)
        ->categorySearch($request->category_id)
        ->date($request->date);
}
    
  public function adminIndex(Request $request)
    {
       $genders = config('contact.gender');
       $categories = Category::all(); 

        $query = $this->buildSearchQuery($request);

        if ($request->export === 'csv') {
        return $this->exportCsv($query->get());
    }

        $contacts = $query->paginate(7)->appends($request->all());

        return view('admin.index', compact('genders','contacts','categories'));
    
    }

        public function search(Request $request)
{
       $genders = config('contact.gender');
       $categories = Category::all();

       $query = Contact::query()
        ->keywordSearch($request->keyword)
        ->genderSearch($request->gender)
        ->categorySearch($request->category_id)
        ->date($request->date);

         if ($request->export === 'csv') {
        return $this->exportCsv($query->get());
    }

        
         $contacts = $query->paginate(7)->appends($request->all());

      return view('admin.index', compact('contacts','categories','genders'));
}

    

    public function destroy(Request $request)
    {
    Contact::findOrFail($request->id)->delete();
   
    return redirect('/admin');
    }

 
private function exportCsv($contacts)
{
    $filename = 'contacts_' . date('Ymd_His') . '.csv';

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename={$filename}",
    ];

    $callback = function () use ($contacts) {
        $handle = fopen('php://output', 'w');

    
        fputcsv($handle, ['ID', '名前', 'メール', '性別', 'カテゴリ', '作成日']);

        $genderLabel = [
            1 => '男性',
            2 => '女性',
            3 => 'その他',
        ];

        foreach ($contacts as $contact) {
            fputcsv($handle, [
                $contact->id,
                $contact->name,
                $contact->email,
                $genderLabel[$contact->gender] ?? '',
                optional($contact->category)->content, 
                $contact->detail, 
                $contact->created_at,
            ]);
        }

        fclose($handle);
    };

    return response()->stream($callback, 200, $headers);
}


public function export(Request $request)
{
   
    $query = Contact::with('category')
        ->keywordSearch($request->keyword)
        ->genderSearch($request->gender)
        ->categorySearch($request->category_id)
        ->date($request->date);

    return $this->exportCsv($query->get());
}
}

