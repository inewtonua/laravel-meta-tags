<?php

namespace Inewtonua\LaravelMetaTags\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inewtonua\LaravelMetaTags\Models\MetaTag;

class MetaTagController extends Controller
{

    public function index(Request $request)
    {
        $query = MetaTag::with(['metatagable']);

        if( !is_null($request->path) && $request->path) {
            $query->where('path', 'like', '%' . $request->path. '%');
        }

        if ($model_type = $request->model_type) {
            $query->where('model_type', $request->model_type);
        }

        $models = $query->orderBy('updated_at', 'desc')->paginate(25);

        return view('meta-tags::system.index', [
            'models' => $models
        ]);

    }

    public function create()
    {
        return view('meta-tags::system.create', [
            'model' => new MetaTag(),
        ]);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'path' => 'nullable|string|unique:meta_tags',
            'title' => 'nullable|string|max:255',
            'keywords' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'h1' => 'nullable|string|max:255',
            'robots' => 'nullable|string|max:255',
            'lang' => 'required|string|max:2',
            'seo_text' => 'nullable|string'
        ]);

        /*
         * Существует ли такой пут?
         */

//        $routes = \Route::getRoutes();
//
//        foreach ($routes as $route) {
//            $slugs[] = $route->uri();
//        }
//
//        $routes = array_unique($slugs);
//
//        if(!in_array($request->path, $routes)) {
//            $error = \Illuminate\Validation\ValidationException::withMessages([
//                'path' => ['Такого пути не существует.']
//            ]);
//            throw $error;
//        }

        $model = MetaTag::create([
            'path' => $request->path,
            'title' => $request->title,
            'keywords' => $request->keywords,
            'description' => $request->description,
            'h1' => $request->h1,
            'robots' => $request->robots,
            'locale' => $request->lang,
            'seo_text' => $request->seo_text,
        ]);

        return redirect()->route('system.meta-tags.index')->with('success', 'Метатеги добавлены.');
    }

    public function edit(MetaTag $metatag)
    {
        return view('meta-tags::system.edit', [
            'model' => $metatag,
        ]);
    }

    public function update(Request $request, $id)
    {
        $model = MetaTag::findOrFail($id);

        $this->validate($request, [
            'path' => 'nullable|string|unique:meta_tags,path,'.$model->id,
            'title' => 'nullable|string|max:255',
            'keywords' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'h1' => 'nullable|string|max:255',
            'robots' => 'nullable|string|max:255',
            'lang' => 'required|string|max:2',
            'seo_text' => 'nullable|string',
        ]);

        $model->update([
            'path' => $request->path,
            'title' => $request->title,
            'keywords' => $request->keywords,
            'description' => $request->description,
            'h1' => $request->h1,
            'robots' => $request->robots,
            'locale' => $request->lang,
            'seo_text' => $request->seo_text,
        ]);

        return redirect()->route('system.meta-tags.index')->with('success', 'Изменения сохранены.');

    }

    public function destroy(Request $request)
    {

        $model = MetaTag::find($request->id);

        if (is_null($model)) {
            return [
                'status' => 'error',
                'msg' => \Lang::get('Не найден.')
            ];
        }

        if ($model->delete()) {
            return [
                'status' => 'success',
                'msg' => \Lang::get('Метатеги удалены.'),
            ];
        } else {
            return [
                'status' => 'error',
                'msg' => \Lang::get('Ошибка. Метатеги не были удалены.')
            ];
        }

    }
}
