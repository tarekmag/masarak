<div>
    <input type="file" multiple class="form-control images" >
    <div class="progress" style="display:none" >
        <div class="progress-bar"></div>
    </div>
    <ul class='preview-container'>
		<?php
			$config['folder'] = (isset($config['folder']))?$config['folder']:'uploads' ;
			$config['is_file'] = true ;
		?>
        @if(isset($config['value']) && $config['value']!='')
            @foreach($config['value'] as $file)
                <li class="image_container mr-1" >
                    <a href="#" class="delete_image" >x</a>
                    <span class='fileIcon' data-name='{{$file}}'></span>
                    <a style="margin-left:0px;" target="_blank" href="{{url($config['folder']).'/'.$file}}" >Preview</a>
                    <input type="hidden" name="{{$config['name']}}"  value="{{$file}}" />
                </li>

		    @endforeach
		@endif
	</ul>
	<input type="hidden" class='config' value='@json($config)' >
</div>
@include('Upload::js')
@once
@include('Upload::style')
@endonce
