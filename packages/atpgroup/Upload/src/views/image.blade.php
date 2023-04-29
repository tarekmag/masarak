<div>
    <input type="file"  class="form-control image" >
    <div class="progress" style="display:none" >
        <div class="progress-bar"></div>
    </div>
    <input type="hidden" name="{{$config['name']}}"  value="" />

    <ul class='preview-container' data-hasOne='1' >
		<?php
			$config['folder'] = (isset($config['folder']))?$config['folder']:'uploads' ;
		?>
        @if(isset($config['value']) && $config['value']!='')
			<li class="image_container" >
				<a href="#" class="delete_image" >x</a>
				<img data-toggle="modal" data-target="#imageView"
                    style="cursor:pointer;width:100px;margin:0 3px" id=""  src="{{url($config['folder']).'/'.$config['value']}}" />
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

@if(isset($config['value']) && $config['value']!='')
@once
<div class="modal fade" id="imageView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img src='uploads/{{$config['value']}}'>
            </div>
        </div>
    </div>
</div>
@endonce
@endif
