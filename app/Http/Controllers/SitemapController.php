<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SitemapController extends Controller
{
    function index()
    {
    	$xml = simplexml_load_string(file_get_contents(public_path('sitemap.xml'))) or die("Error: Cannot create object");

    	$urls = [];

    	foreach ($xml as $node) {
    		if (isset($node->loc)) {
    			$urls[] = (string)$node->loc;
    		}
    	}

    	return view('sitemap', compact('urls'));
    }
}
