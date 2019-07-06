<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Image;
use Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FileController extends Controller
{
	public function manipulate(Request $request)
	{
		$fileName = 'user_image'.time().'.png';
		$path = $request->file('photo')->move(public_path('/'), $fileName);
		//return response()->json(['url' => $photoUrl], 200);

		$image = Image::make(public_path($fileName))
		->resize(400,400) // i know this is not taken in consideration
		->greyscale()
		->text('HOPE THAT I PASS THIS INTERVIEW!', 30, 100, function($font) 
		{
		    $font->size(60);
		    $font->color('#ffffff');
		    $font->angle(45);
		})
		->text('HOPE THAT I PASS THIS INTERVIEW!', 30, 100, function($font) 
		{
		    $font->size(60);
		    $font->color('#000000');
		    $font->angle(45);
		})
		->ellipse(50, 50, 50, 50, function ($draw) 
		{
		    $draw->background('#0000ff');
		})
		->rotate(-45)
		->sharpen(15)
		->flip('v');

		$image->save(public_path($fileName));

		return response()->download(public_path($fileName), 'User Img');
	}
}
    
