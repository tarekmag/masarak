<?php
use ATPGroup\Upload\Upload;
?>

<div class="form-body">
    <div class="row">

        @csrf

        <div class="col-md-3">
            <div class="form-group control-group">
                <label for="name">{{ __('user::language.field.name') }} <span class="danger">*</span></label>
                <input type="text" name="name" value="{{ inputValidation('name', $user) }}" id="name"
                    class="form-control" placeholder="{{ __('user::language.field.name') }}" required
                    data-validation-required-message="{{ __('partials.ThisFieldIsRequired') }}">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group control-group">
                <label for="email">{{ __('user::language.field.email') }} <span class="danger">*</span></label>
                <input type="email" name="email" value="{{ inputValidation('email', $user) }}" id="email"
                    class="form-control" placeholder="{{ __('user::language.field.email') }}" required
                    data-validation-required-message="{{ __('partials.ThisFieldIsRequired') }}">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group control-group">
                <label for="password">{{ __('user::language.field.password') }} @if ($user->id == '')
                        <span class="danger">*</span>
                    @endif
                </label>
                <input type="password" name="password" id="password" class="form-control"
                    placeholder="{{ __('user::language.field.password') }}"
                    @if ($user->id == '') required
                data-validation-required-message="{{ __('partials.ThisFieldIsRequired') }}" @endif>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group control-group">
                <label for="PasswordConfirmation">{{ __('user::language.field.passwordConfirmation') }}
                    @if ($user->id == '')
                        <span class="danger">*</span>
                    @endif
                </label>
                <input type="password" name="password_confirmation" id="PasswordConfirmation" class="form-control"
                    placeholder="{{ __('user::language.field.passwordConfirmation') }}"
                    @if ($user->id == '') required
                data-validation-required-message="{{ __('partials.ThisFieldIsRequired') }}" @endif>
            </div>
        </div>

        @if (request()->route()->getName() != 'user.profile')
            <div class="col-md-3">
                <div class="form-group control-group">
                    <x-role-dropdown-list :roleId="$user->role_id" />
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group control-group">
                    <x-company-dropdown-company :companyId="$user->company_id" :required="false" name="company_id" />
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group control-group">
                    <x-company-dropdown-branch :companyId="$user->company_id" :branchId="$user->branch_id" :required="false" name="branch_id" />
                </div>
            </div>
        @endif

        <div class="col-md-3">
            <div class="form-group control-group">
                <label for="image">
                    {{ __('user::language.field.is_blank_dashboard') }}
                </label>
                <x-form-toggle :isActive="$user->is_blank_dashboard" name="is_dashboard" iconOn="fa fa-thumbs-up"
                    iconOff="fa fa-thumbs-down" colorOn="success" colorOff="danger" />
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group control-group">
                <label for="image">
                    {{ __('user::language.field.image') }}
                </label>
                <?= Upload::image([
                    'name' => 'image',
                    'value' => old('image', $user->image),
                ]) ?>
            </div>
        </div>

    </div>
</div>

<div class="form-actions right">
    <button type="submit" class="btn btn-blue">
        <i class="fa fa-check-square-o"></i> {{ __('partials.Save') }}
    </button>
</div>
