<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class ContactController extends Controller
{
    public function AdminContact(){
        $contacts = Contact::all();
        return view('admin.contact.index',compact('contacts'));
    }

    public function AddContact()
    {
        return view('admin.contact.create');
    }

    public function StoreContact(Request $request)
    {
        $contacts = Contact::create([
           'email'=> $request->email,
           'phone'=> $request->phone,
           'address'=> $request->address,
        ]);

        return Redirect()->route('admin.contact')->with('success','Contact info added successfully!');
    }

    public function EditContact($id)
    {
        $contacts = Contact::find($id);
        return view('admin.contact.edit',compact('contacts'));
    }

    public function UpdateContact(Request $request, $id)
    {
        Contact::find($id)->update([
            'email'=> $request->email,
            'phone'=> $request->phone,
            'address'=> $request->address,
        ]);
        return Redirect()->route('admin.contact')->with('success','Contact info Updated successfully!');
    }

    public function DeleteContact($id)
    {
        $delete = Contact::find($id)->delete();
        return Redirect()->back()->with('success','Contact Deleted successfully!');

    }

    public function Contact()
    {
        $contacts = Contact::first();
        return view('pages.contact',compact('contacts'));
    }
//    contact form
    public function ContactForm(Request $request)
    {
        $validatedData = $request->validate([
           'name'=>'required',
           'email'=>'required',
           'subject'=>'required',
           'message'=>'required',
        ]);
        ContactForm::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'subject'=> $request->subject,
            'message'=> $request->message,
        ]);
        return Redirect()->back()->with('success','Your message send successfully!');
    }

    public function AdminMessage()
    {
        $messages = ContactForm::paginate(10);
        return view('admin.contact.message',compact('messages'));
    }

    public function DeleteMessage($id)
    {
        $delete = ContactForm::find($id)->delete();
        return Redirect()->back()->with('success','Your message deleted successfully!');

    }
}
