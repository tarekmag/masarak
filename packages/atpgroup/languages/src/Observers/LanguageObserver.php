<?php

namespace ATPGroup\Languages\Observers;

use Illuminate\Support\Facades\File;

class LanguageObserver
{
    /**
     * Handle the Language "saving" event.
     *
     * @param  \ATPGroup\Languages\Models\Language  $language
     * @return void
     */
    public function saving($language)
    {
        $request = request();
        $language->fill($request->all());
    }

    /**
     * Handle the Language "created" event.
     *
     * @param  \ATPGroup\Languages\Models\Language  $language
     * @return void
     */
    public function created($language)
    {
        $files = $this->getLanguagesDirectory($language);

        foreach ($files['newDirectory'] as $key => $file) {
            if (!File::exists($file)) {
                File::copyDirectory($files['defaultDirectory'][$key], $file);
            }
        }
    }

    /**
     * Handle the Language "deleting" event.
     *
     * @param  \ATPGroup\Languages\Models\Language  $language
     * @return void
     */
    public function deleting($language)
    {
        $files = $this->getLanguagesDirectory($language);

        foreach ($files['newDirectory'] as $file) {
            if (File::exists($file)) {
                File::deleteDirectory($file);
            }
        }
    }

    private function getLanguagesDirectory($language)
    {
        $defaultLanguageFiles = resource_path('lang/en');

        $defaultDirectory = collect(config('helpers.packagesLanguageFiles'))->map(function ($item) use ($language) {
            return $item['path'] . 'en';
        })->toArray();

        $defaultDirectory = array_merge($defaultDirectory, [$defaultLanguageFiles]);

        $newDirectory = collect(config('helpers.packagesLanguageFiles'))->map(function ($item) use ($language) {
            return $item['path'] . strtolower($language->symbol);
        })->toArray();

        $newDirectory = array_merge($newDirectory, [resource_path('lang/' . strtolower($language->symbol))]);

        return ['defaultDirectory' => $defaultDirectory, 'newDirectory' => $newDirectory];
    }

}
