<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Template extends Controller
{
    public function welcome()
	 {
	 	return view('booking.index');
	 }
	 public function category_room()
	 {
	 	return view('booking.pages.room.category_room');
	 }
	 public function detail_room()
	 {
	 	return view('booking.pages.room.detail_room');
	 }
	 public function blog()
	 {
	 	return view('booking.pages.blog.blog');
	 }
	 public function detail_blog()
	 {
	 	return view('booking.pages.blog.detail_blog');
	 }
	 public function contact()
	 {
	 	return view('booking.pages.contact');
	 }
	 public function about_us()
	 {
	 	return view('booking.pages.about_us');
	 }
}
