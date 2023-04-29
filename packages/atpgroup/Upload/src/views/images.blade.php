
<div>
    <input type="file"  class="form-control image" >
    <div class="progress" style="display:none" >
        <div class="progress-bar"></div>
    </div>
    <ul class='preview-container sortable' >
		<?php
			$config['folder'] = (isset($config['folder']))?$config['folder']:'uploads' ;
		?>
        @if(isset($config['value']) &&  is_array($config['value']))
			@foreach($config['value'] as $image)
			<li class="image_container" >
				<a href="#" class="delete_image" >x</a>
				<img style="width:100px;margin:0 3px" id=""  src="{{url($config['folder']).'/'.$image}}" />
				<input type="hidden" name="{{$config['name']}}"  value="{{$image}}" />
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
