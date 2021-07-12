<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Patient;
use App\Models\Coupon;
use App\Models\Folder;
use Illuminate\Support\Facades\Storage;


class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents=Document::all();
        return view('backend.documents.index')->with('documents', $documents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patients=Patient::all();
        $coupons=Coupon::all();
        $folders=Folder::all();
        return view('backend.documents.create')
            ->with('patients', $patients)
            ->with('coupons', $coupons)
            ->with('folders', $folders);
    }

    public function download(Request $request, $id){
        return Storage::download("public/".$id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => ['nullable', 'integer'],
            'coupon_id' => ['nullable', 'integer'],
            'title' => ['required', 'string', 'max:255'],
            'folder_id' => ['required', 'integer'],
            'is_provision' => ['required', 'boolean'],
        ]);

        // Handle file Upload
        if($request->hasFile('file')){
            // Get filename with the extension
            $filenameWithExt = $request->file('file')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('file')->getClientOriginalExtension();
            // Filename to store
            $storage_file_name = md5(time().$filename).'.'.$extension;
            $file_name = $filename.'.'.$extension;
            // Upload Image
            $path = $request->file('file')->storeAs('public',$storage_file_name);
        }

        $document = new Document;
        $document->patient_id = $request->patient_id;
        $document->coupon_id = $request->coupon_id;
        $document->title = $request->title;
        $document->file_name = $file_name;
        $document->storage_file_name = $storage_file_name;
        $document->folder_id = $request->folder_id;
        $document->is_provision = $request->is_provision;
        $document->save();

        return redirect('/dashboard/documents')
            ->with('success', trans('dashboard.documents.create-success'));
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $document=Document::find($id);
        $patients=Patient::all();
        $coupons=Coupon::all();
        $folders=Folder::all();
        return view('backend.documents.edit')
            ->with('document', $document)
            ->with('patients', $patients)
            ->with('coupons', $coupons)
            ->with('folders', $folders);
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
        $request->validate([
            'patient_id' => ['nullable', 'integer'],
            'coupon_id' => ['nullable', 'integer'],
            'title' => ['required', 'string', 'max:255'],
            'folder_id' => ['required', 'integer'],
            'is_provision' => ['required', 'boolean'],
        ]);

        $document = [
            'patient_id' => $request->patient_id,
            'coupon_id' => $request->coupon_id,
            'title' => $request->title,
            'folder_id' => $request->folder_id,
            'is_provision' => $request->is_provision,
        ];

        // Handle file Upload
        if($request->hasFile('file')){
            // Get filename with the extension
            $filenameWithExt = $request->file('file')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('file')->getClientOriginalExtension();
            // Filename to store
            $storage_file_name = md5(time().$filename).'.'.$extension;
            $file_name = $filename.'.'.$extension;
            // Upload Image
            $path = $request->file('file')->storeAs('public',$storage_file_name);

            $old_one = Document::find($id);
            // Delete old docment file.
            Storage::delete('public/'.$old_one->storage_file_name);

            // If a new document has been selected on edit page, update the name in the DB.
            $document['file_name'] = $file_name;
            $document['storage_file_name'] = $storage_file_name;
        }

        Document::where('id', $id)
            ->update($document);

        return redirect()->back()
            ->with('success', trans('dashboard.documents.edit-success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Document::where('id', $id)->delete();
        //Storage::delete('/public/documents/'.$user->storage_file_name);
        return redirect()->back()
            ->with('success', trans('dashboard.documents.delete-success'));
    }
}
