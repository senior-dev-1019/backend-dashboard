<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriptions=Subscription::all();
        return view('backend.subscriptions.index')->with('subscriptions', $subscriptions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.subscriptions.create');
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
            'monthly_price' => ['required', 'max:10', 'regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:4000'],
            'has_timeline' => ['required', 'boolean'],
            'has_documents' => ['required', 'boolean'],
            'has_institution' => ['required', 'boolean'],
            'provisions' => ['required', 'max:10', 'regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/'],
        ]); 

        $subscription = new Subscription;
        $subscription->monthly_price = $request->monthly_price;
        $subscription->title = $request->title;
        $subscription->description = $request->description;
        $subscription->has_timeline = $request->has_timeline;
        $subscription->has_documents = $request->has_documents;
        $subscription->has_institution = $request->has_institution;
        $subscription->provisions = $request->provisions;
        $subscription->save();

        return redirect('/dashboard/subscriptions')
            ->with('success', trans('dashboard.subscriptions.create-success'));
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
        $subscription=Subscription::find($id);
        return view('backend.subscriptions.edit')->with('subscription', $subscription);
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
            'monthly_price' => ['required', 'max:10', 'regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:4000'],
            'has_timeline' => ['required', 'boolean'],
            'has_documents' => ['required', 'boolean'],
            'has_institution' => ['required', 'boolean'],
            'provisions' => ['required', 'integer'],
        ]); 

        Subscription::where('id', $id)
          ->update(
                [
                    'monthly_price' => $request->monthly_price,
                    'title' => $request->title,
                    'description' => $request->description,
                    'has_timeline' => $request->has_timeline,
                    'has_documents' => $request->has_documents,
                    'has_institution' => $request->has_institution,
                    'provisions' => $request->provisions,
                ]
            );

        return redirect()->back()
            ->with('success', trans('dashboard.subscriptions.edit-success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Subscription::where('id', $id)->delete();
        return redirect()->back()
            ->with('success', trans('dashboard.subscriptions.delete-success'));
    }
}
