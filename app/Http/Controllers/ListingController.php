<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //Show all listing
    public function index(Request $request) {

        return view('listings.index',[ 
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
            ]);
    }

    //Show single listing
    public function show(Listing $listing) {

        return view('listings.show', [
            'listing' => $listing
        ]);

    }

    //Show create form
    public function create() {
        return view ('listings.create');
    }

    //Store listing ddatea
    public function store(Request $request) {
        
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public'); 
        }

        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);

        return redirect('/')->with('message', 'Job created sucessfully!');
    }

    //Show Edit Form
    public function edit(Listing $listing) {
        
        return view('listings.edit', ['listing' => $listing] );
    }

    //Update listing data
    public function update(Request $request, Listing $listing) {
        
        //make sure logged in user is owner
        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public'); 
        }

        $listing->update($formFields);

        return back()->with('message', 'Job updated sucessfully!');
    }

    //Delete Listing
    public function destroy(Listing $listing) {
        
        //make sure logged in user is owner
        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $listing->delete();
        return redirect('/')->with('message', 'Job deleted successfully');
    }

    //Manage Listings
    public function manage() {
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
