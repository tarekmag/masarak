<div class="btn-group float-md-right mt-1" role="group" aria-label="Button group with nested dropdown">   
    <button class="btn btn-blue round dropdown-toggle dropdown-menu-right px-2" id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-language icon-left"></i> {{ $currentLangauge->name }}</button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
    @foreach ($languages as $language)
        <a class="dropdown-item" href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), ['setLanguage='.$language->symbol]) }}">{{ $language->name }}</a>
    @endforeach
</div>