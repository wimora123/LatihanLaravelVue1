<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use Illuminate\Support\Facades\File; 

class ContactController extends Controller
{
    	public function getContacts(){
    		$contact = Contact::all();
    		return $contact;
    	}

		public function saveContact(Request $request){
			$contact = new Contact;
			if($request->has('image') && !empty($request->image)){
				$imageName = time() . '.' . $request->image->getClientOriginalExtension();
				$request->image->move(public_path('images/gallery'), $imageName);

				// Pathnya otomatis tersimpan ke dalam folder publik
				$path = ('images/gallery/'.$imageName);
				$contact->image = $path;
			}

			$contact->name = $request->name;
			$contact->email = $request->email;
			$contact->designation = $request->designation;
			$contact->bio = $request->bio;
			$contact->contact_no = $request->contact_no;

			if($contact->save()){
				return response()->json([
					'status' => true,
					'message' => 'Contact added successfully'
				]);
			}
			else{
				return response()->json([
					'status' => false,
					'message' => 'There is some problem. Please try again'
				]);
			}

		}

		public function getIDContact($id){
			$contact = Contact::find($id);
			if($contact){
				return response()->json($contact);
			}
			else{
				return response()->json([
					'status' => false,
					'message' => 'ID Not found'
				]);
			}
		}

		public function updateContact(Request $request, $id){
			$contact = Contact::where('id', $id)->first();

			if($request->has('image') && !empty($request->image)){
				$imageName = time() . '.' . $request->image->getClientOriginalExtension();
				$request->image->move(public_path('images/gallery'), $imageName);

				// Pathnya otomatis tersimpan ke dalam folder publik
				$path = ('images/gallery/'.$imageName);
				$contact->image = $path;

				$contact->name = $request->name;
				$contact->email = $request->email;
				$contact->designation = $request->designation;
				$contact->bio = $request->bio;
				$contact->contact_no = $request->contact_no;
	
				if($contact->save()){
					return response()->json([
						'status' => true,
						'message' => 'Contact updated successfully'
					]);
				}
				else{
					return response()->json([
						'status' => false,
						'message' => 'There is some problem. Please try again'
					]);
				}

				// if(File::exists($path)) {
				// 	unlink($path);
				// }	

			}

			else{
				$contact->name = $request->name;
				$contact->email = $request->email;
				$contact->designation = $request->designation;
				$contact->bio = $request->bio;
				$contact->contact_no = $request->contact_no;

				if($contact->save()){
					return response()->json([
						'status' => true,
						'message' => 'Contact updated successfully'
					]);
				}
				else{
					return response()->json([
						'status' => false,
						'message' => 'There is some problem. Please try again'
					]);
				}
			}

		}


		public function deleteContact($id){
			$contact = Contact::find($id);

			if($contact->delete($id)){
				return response()->json([
					'status' => true,
					'message' => 'Contact deleted successfully'
				]);
			}
			else{
				return response()->json([
					'status' => false,
					'message' => 'There is some problem. Please try again'
				]);
			}
		}
}
