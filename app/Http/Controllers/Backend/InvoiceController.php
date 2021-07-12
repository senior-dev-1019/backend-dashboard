<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceLine;
use App\Models\User;
use Carbon\Carbon;
use App;
use PDF;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices=Invoice::all();
        
        $locale=App::getLocale();
        foreach ($invoices as $key => $invoice) {
            if(isset($invoice->invoice_date)){
                if($locale == "de"){
                    $invoice->invoice_date=Carbon::parse($invoice->invoice_date)->format('d.m.Y');
                }else{
                    $invoice->invoice_date=Carbon::parse($invoice->invoice_date)->format('m-d-Y');
                }
            }
            if(isset($invoice->payment_date)){
                if($locale == "de"){
                    $invoice->payment_date=Carbon::parse($invoice->payment_date)->format('d.m.Y');
                }else{
                    $invoice->payment_date=Carbon::parse($invoice->payment_date)->format('m-d-Y');
                }
            }
        }
        return view('backend.invoices.index')->with('invoices', $invoices);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users=User::all();
        return view('backend.invoices.create')->with('users', $users);
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
            'user_id' => ['required', 'integer'],
            'invoice_date' => ['required'],
            'payment_date' => ['nullable'],
            'status' => ['required', 'string', 'max:255'],
        ]);

        $invoice = new Invoice;
        $invoice->user_id = $request->user_id;
        $locale=App::getLocale();
        if (isset($request->invoice_date)) {
            if($locale == "de"){
                $invoice->invoice_date=Carbon::createFromFormat('d.m.Y', $request->invoice_date)->format('Y-m-d');
            }else{
                $invoice->invoice_date=Carbon::createFromFormat('m-d-Y', $request->invoice_date)->format('Y-m-d');
            }
        } else {
            $invoice->invoice_date=null;
        }

        if(isset($request->payment_date)){
            if($locale == "de"){
                $invoice->payment_date=Carbon::createFromFormat('d.m.Y', $request->payment_date)->format('Y-m-d');
            }else{
                $invoice->payment_date=Carbon::createFromFormat('m-d-Y', $request->payment_date)->format('Y-m-d');
            }
        }else{
            $invoice->payment_date=null;
        }

        $invoice->amount = array_sum($request->invoiceline_amounts);
        $invoice->status = $request->status;
        $invoice->save();

        // Get input values.
        $ids=$request->ids;
        $iAmounts=$request->invoiceline_amounts;
        $iTexts=$request->invoiceline_texts;
        if(isset($ids)){
            foreach ($ids as $key=>$id) {
                $invoiceline=new InvoiceLine;
                $invoiceline->invoice_id=$invoice->id;
                $invoiceline->amount=$iAmounts[$key];
                $invoiceline->text=$iTexts[$key];
                $invoiceline->save();
            }
        }        

        return redirect('/dashboard/invoices')
            ->with('success', trans('dashboard.invoices.create-success'));
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
        $invoice=Invoice::find($id);
        $invoicelines = InvoiceLine::where('invoice_id', $invoice->id)->get();
        
        /**
         * Date format for de: dd.mm.yy
         * Date format for en: mm.dd.yy
         */
        $locale=App::getLocale();
        if($locale == "de"){
            if(isset($invoice->invoice_date)){
                $invoice->invoice_date=Carbon::parse($invoice->invoice_date)->format('d.m.Y');
            }
            if(isset($invoice->payment_date)){
                $invoice->payment_date=Carbon::parse($invoice->payment_date)->format('d.m.Y');
            }
        }else{
            if(isset($invoice->invoice_date)){
                $invoice->invoice_date=Carbon::parse($invoice->invoice_date)->format('m-d-Y');
            }
            if(isset($invoice->payment_date)){
                $invoice->payment_date=Carbon::parse($invoice->payment_date)->format('m-d-Y');
            }
        }
        
        $users=User::all();
        return view('backend.invoices.edit')
            ->with('invoice', $invoice)
            ->with('invoicelines', $invoicelines)
            ->with('users', $users);
    }

    public function addInvoiceLine(){
        $id=time();
        return view('backend.invoices.invoiceline')->with('id', $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $invoice_id)
    {
        $request->validate([
            'user_id' => ['required', 'integer'],
            'invoice_date' => ['required'],
            'payment_date' => ['nullable'],
            'status' => ['required', 'string', 'max:255'],
        ]);

        $locale=App::getLocale();
        if(isset($request->invoice_date)){
            if($locale == "de"){
                $invoice_date=Carbon::createFromFormat('d.m.Y', $request->invoice_date)->format('Y-m-d');
            }else{
                $invoice_date=Carbon::createFromFormat('m-d-Y', $request->invoice_date)->format('Y-m-d');
            }
        }else{
            $invoice_date=null;
        }

        if(isset($request->payment_date)){
            if($locale == "de"){
                $payment_date=Carbon::createFromFormat('d.m.Y', $request->payment_date)->format('Y-m-d');
            }else{
                $payment_date=Carbon::createFromFormat('m-d-Y', $request->payment_date)->format('Y-m-d');
            }
        }else{
            $payment_date=null;
        }
        

        Invoice::where('id', $invoice_id)
            ->update([
                'user_id' => $request->user_id,
                'invoice_date' => $invoice_date,
                'payment_date' => $payment_date,
                'amount' => array_sum($request->invoiceline_amounts),
                'status' => $request->status,
            ]);

        $existingIds=InvoiceLine::where('invoice_id', $invoice_id)->pluck('id')->toArray();
        // Get input values.
        $incomeingIds=$request->ids;
        $iAmounts=$request->invoiceline_amounts;
        $iTexts=$request->invoiceline_texts;
        $updateIds = [];
        if(isset($incomeingIds)){
            foreach ($incomeingIds as $key=>$incomeingId) {
                if(in_array($incomeingId, $existingIds)){ // Update current one.
                    InvoiceLine::where('id', $incomeingId)
                        ->update([
                            'amount' => $iAmounts[$key],
                            'text' => $iTexts[$key],
                        ]);
                    array_push($updateIds, $incomeingId);
                }else{ // Create new one
                    $invoiceline=new InvoiceLine;
                    $invoiceline->invoice_id=$invoice_id;
                    $invoiceline->amount=$iAmounts[$key];
                    $invoiceline->text=$iTexts[$key];
                    $invoiceline->save();
                }
            }
        }
        
        // Delete missing invoicelines from db.
        foreach ($existingIds as $key => $existingId) {
            if(!in_array($existingId, $updateIds)){
                InvoiceLine::where('id', $existingId)->delete();
            }
        }

        return redirect()->back()
            ->with('success', trans('dashboard.invoices.edit-success'));
    }

    public function downloadInvoice($id){
        $invoice=Invoice::find($id);
        $invoicelines = InvoiceLine::where('invoice_id', $invoice->id)->get();
        $user = $invoice->user;
        
        $locale=App::getLocale();
        if($locale == "de"){
            $invoice->payment_date=Carbon::parse($invoice->payment_date)->format('d.m.Y');
            $invoice->invoice_date=Carbon::parse($invoice->invoice_date)->format('d.m.Y');
        }else{
            $invoice->payment_date=Carbon::parse($invoice->payment_date)->format('m-d-Y');
            $invoice->invoice_date=Carbon::parse($invoice->invoice_date)->format('m-d-Y');
        }
        $pdf=PDF::loadView('backend.templates.invoice', compact("invoice", "invoicelines", "user"));
        return $pdf->download('invoice.pdf');
        // return view('backend.templates.invoice')->with('invoice', $invoice)->with('invoicelines', $invoicelines);
    }

    public function downloadReceipt($id){
        $invoice=Invoice::find($id);
        $invoicelines = InvoiceLine::where('invoice_id', $invoice->id)->get();
        $user = $invoice->user;

        $locale=App::getLocale();
        if($locale == "de"){
            $invoice->payment_date=Carbon::parse($invoice->payment_date)->format('d.m.Y');
            $invoice->invoice_date=Carbon::parse($invoice->invoice_date)->format('d.m.Y');
        }else{
            $invoice->payment_date=Carbon::parse($invoice->payment_date)->format('m-d-Y');
            $invoice->invoice_date=Carbon::parse($invoice->invoice_date)->format('m-d-Y');
        }
        $pdf=PDF::loadView('backend.templates.receipt', compact("invoice", "invoicelines", "user"));
        return $pdf->download('receipt.pdf');
        // return view('backend.templates.receipt')->with('invoice', $invoice)->with('invoicelines', $invoicelines);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Invoice::where('id', $id)->delete();
        InvoiceLine::where('invoice_id', $id)->delete();
        return redirect()->back()
            ->with('success', trans('dashboard.invoices.delete-success'));
    }
}
