<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use App\Models\Document;
use App\Models\UserPatient;
use \Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Display a listing of the documents.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'is_provision' => ['nullable', 'boolean'],
            'folder_id' => ['nullable', 'integer']
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                "message" => "The given data was invalid.",
                'errors' => $validator->errors()->getMessages()
            ], 400);
        }

        $is_provision=$request->is_provision;
        $folder_id=$request->folder_id;
        
        $user = JWTAuth::user();
        
        // Users whose institution is the same as authenticated user.
        $userIds = User::where('institution_id', $user->institution_id)->pluck('id')->toArray();
        $patientIds = array_unique(UserPatient::whereIn('user_id', $userIds)->pluck('patient_id')->toArray());

        $documents = Document::whereIn('patient_id', $patientIds);
        if (isset($is_provision)) {
            $documents = $documents->where('is_provision', $is_provision);
        }
        if(isset($folder_id)){
            $documents = $documents->where('folder_id', $folder_id);
        }
        $documents = $documents->get();
        
        return response()->json([
            'status' => 'success',
            'documents' => $documents,
        ]);
    }

    public function share(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'type' => ['in:email, sms, fax']
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                "message" => "The given data was invalid.",
                'errors' => $validator->errors()->getMessages()
            ], 400);
        }

        /**
         * Share process...
         */

        $status="success";
        return response()->json(compact('status'));
    }

    public function contacts(){

        /**
         * Get permissions
         */

        $status='success';
        $permissions=[];
        return response()->json(compact('permissions', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => ['nullable', 'integer'],
            'coupon_id' => ['nullable', 'integer'],
            'title' => ['required', 'string', 'max:255'],
            'folder_id' => ['required', 'integer'],
            'is_provision' => ['required', 'boolean'],
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                "message" => "The given data was invalid.",
                'errors' => $validator->errors()->getMessages()
            ], 400);
        }

        $storage_file_name = "";
        $file_name = "";
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
    
        $status="success";
        return response()->json(compact('status'));
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $document = Document::where('id', $id)->first();
        $status='success';

        return response()->json(compact('document', 'status'));
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
        $validator = Validator::make($request->all(), [
            'patient_id' => ['nullable', 'integer'],
            'coupon_id' => ['nullable', 'integer'],
            'title' => ['required', 'string', 'max:255'],
            'folder_id' => ['required', 'integer'],
            'is_provision' => ['required', 'boolean'],
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                "message" => "The given data was invalid.",
                'errors' => $validator->errors()->getMessages()
            ], 400);
        }
        
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
        
        $status='success';
        return response()->json(compact('status'));
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
        
        $status='success';
        return response()->json(compact('status'));
    }
}
