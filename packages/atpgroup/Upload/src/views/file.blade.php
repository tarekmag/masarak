<div>
    <input type="file" class="form-control image" >
    <div class="progress" style="display:none" >
        <div class="progress-bar"></div>
    </div>
    <ul class='preview-container' data-hasOne='1' >
		<?php
			$config['folder'] = (isset($config['folder']))?$config['folder']:'uploads' ;
			$config['is_file'] = true ;
		?>
        @if(isset($config['value']) && $config['value']!='')
			<li class="image_container" >
				<a href="#" style='bottom:0%;left:110%;' class="delete_image" >x</a>
				<a target="_blank" href="{{url($config['folder']).'/'.$config['value']}}" >Preview</a>
				<input type="hidden" name="{{$config['name']}}"  value="{{$config['value']}}" />
			</li>
		@endif
	</ul>
	<input type="hidden" class='config' value='@json($config)' >
</div>
@include('Upload::js')
@once
@include('Upload::style')
@endonce
