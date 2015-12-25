<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Http\Controllers\Faq;

use App\Http\Controllers\Controller as Controller;
use App\Models\Faq\Category;
use App\Models\Faq\Article;

use Illuminate\Http\Request;

class FaqController extends Controller
{
    protected $section = 'help';

    public function getIndex()
    {
    	$categories = Category::with("articles")->get();
        return view('help.faq.index', compact("categories"));
    }
    public function getUpdate($articleId)
    {
        $article = Article::findOrFail($articleId);
        return view('help.faq.create', [
            'article' => $article,
            'categoryId' => $article->category_id,
            'categories' => Category::get(),
        ]);
    }
    public function postUpdate($articleId, Request $request) 
    {
        $article = Article::findOrFail($articleId);
        $article->update($request->all());
        return redirect('/help/faq');
    }
    public function postUpdateCategory($id = null, Request $request) 
    {
    	$category = Category::findOrNew($id);
    	$category->update($request->all());
    	$category->save();
    	return "true";
    }
    public function getCreate($categoryId = null)
    {
        $categories = Category::get();
        return view('help.faq.create', compact('categories', 'categoryId'));
    }
    public function postCreate(Request $request)
    {
        $article = new Article($request->all());
        $article->save();
        return redirect('/help/faq');
    }
    public function getView($articleId)
    {
        $article = Article::findOrFail($articleId);
        return view('help.faq.view', compact('article'));
    }
    public function getSearch(Request $request)
    {
        $searchQuery = $request->input("query", false);
        if ($searchQuery != false) {
            $articles = Article::whereRaw("MATCH(title,content) AGAINST(? IN BOOLEAN MODE)", [$searchQuery])->get();
            return response()->json($articles->toArray());
        }
        return response()->json([]);
    }
    public function getCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        return view('help.faq.category-listing', compact('category'));
    }
}