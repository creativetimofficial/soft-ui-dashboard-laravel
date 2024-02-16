@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="container-fluid">
        <div class="page-header min-height-100 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
            <span class="mask bg-gradient-primary opacity-6"></span>
        </div>
        <div class="card card-body blur shadow-blur mx-4 mt-n6">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="../assets/img/bruce-mars.jpg" alt="..." class="w-100 border-radius-lg shadow-sm">
                        <a href="javascript:;" class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
                            <i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Image"></i>
                        </a>
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ __('Alec Thompson') }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            {{ __(' CEO / Co-Founder') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="/user-profile" method="POST" role="form text-left">
        @csrf
        @if($errors->any())
                    <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                <span class="alert-text text-white">
                {{$errors->first()}}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <i class="fa fa-close" aria-hidden="true"></i>
                </button>
            </div>
        @endif
        @if(session('success'))
            <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                <span class="alert-text text-white">
                {{ session('success') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <i class="fa fa-close" aria-hidden="true"></i>
                </button>
            </div>
        @endif
        <div class="container-fluid py-2">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">{{ __('Personal Details') }}</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-title" class="form-control-label">{{ __('Title') }}<span class="text-danger">*</span></label>
                                <div class="dropdown @error('user.title')border border-danger rounded-3 @enderror">
                                    <select class="form-select form-control" aria-label="Default select example" id="user-title" name="title">
                                        <option selected>
                                            @if(auth()->user()->title)
                                                {{ auth()->user()->title }}
                                            @else
                                                Please choose
                                            @endif
                                        </option>
                                        @foreach(['Ms' => 1, 'Mr' => 2, 'Mrs' => 3] as $key => $value)
                                            <option class="dropdown-item" value="{{ $value }}">{{ $key }}</option>
                                        @endforeach
                                    </select>
                                        @error('title')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-lastname" class="form-control-label">{{ __('Last Name') }}<span class="text-danger">*</span></label>
                                <div class="@error('lastname')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ auth()->user()->lastname }}" type="text" placeholder="Last Name" id="user-lastname" name="lastname">
                                        @error('lastname')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-firstname" class="form-control-label">{{ __('First Name') }}<span class="text-danger">*</span></label>
                                <div class="@error('firstname')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ auth()->user()->firstname }}" type="text" placeholder="First Name" id="user-firstname" name="firstname">
                                        @error('firstname')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user.fullname" class="form-control-label">{{ __('Full Name') }}</label>
                                <div class="@error('user.fullname') border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="Full Name" id="name" name="fullname" disabled="true">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="horizontal dark">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">{{ __('Job Details') }}</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-organization" class="form-control-label">{{ __('Organizational unit') }}<span class="text-danger">*</span></label>
                                <div class="dropdown @error('user.organization')border border-danger rounded-3 @enderror">
                                    <select class="form-select form-control" aria-label="Default select example" id="user-organization" name="organization">
                                        <option selected>
                                            @if(auth()->user()->organization)
                                                {{ auth()->user()->organization }}
                                            @else
                                                Please choose
                                            @endif
                                        </option>
                                        @foreach(['AwanBiru Technology Berhad' => 1, 'Awantec System Sdn Bhd' => 2] as $key => $value)
                                            <option class="dropdown-item" value="{{ $value }}">{{ $key }}</option>
                                        @endforeach
                                    </select>
                                        @error('organization')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-position" class="form-control-label">{{ __('Job title') }}<span class="text-danger">*</span></label>
                                <div class="dropdown @error('user.position')border border-danger rounded-3 @enderror">
                                    <select class="form-select form-control" aria-label="Default select example" id="user-position" name="position">
                                        <option selected>
                                            @if(auth()->user()->position)
                                                {{ auth()->user()->position }}
                                            @else
                                                Please choose
                                            @endif
                                        </option>
                                        @foreach(['Chief Executive Office (CEO)' => 1, 'Executive' => 2, 'Manager' => 3] as $key => $value)
                                            <option class="dropdown-item" value="{{ $value }}">{{ $key }}</option>
                                        @endforeach
                                    </select>
                                        @error('position')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-department" class="form-control-label">{{ __('Department') }}<span class="text-danger">*</span></label>
                                <div class="dropdown @error('user.department')border border-danger rounded-3 @enderror">
                                    <select class="form-select form-control" aria-label="Default select example" id="user-department" name="department">
                                        <option selected>
                                            @if(auth()->user()->department)
                                                {{ auth()->user()->department }}
                                            @else
                                                Please choose
                                            @endif
                                        </option>
                                        @foreach(['Corporate Human Resources' => 1, 'Internal IT & Services' => 2, 'Sales & Marketing' => 3] as $key => $value)
                                            <option class="dropdown-item" value="{{ $value }}">{{ $key }}</option>
                                        @endforeach
                                    </select>
                                        @error('department')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user.empid" class="form-control-label">{{ __('Employee ID') }}</label>
                                <div class="@error('user.empid') border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="Employee ID" id="name" name="empid" value="{{ auth()->user()->emp_id }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-reporting" class="form-control-label">{{ __('Reporting line') }}</label>
                                <div class="dropdown @error('user.reporting')border border-danger rounded-3 @enderror">
                                    <select class="form-select form-control" aria-label="Default select example" id="user-reporting" name="reporting">
                                        <option selected>
                                            @if(auth()->user()->reporting)
                                                {{ auth()->user()->reporting }}
                                            @else
                                                Select user
                                            @endif
                                        </option>
                                        @foreach(['Azlan Zainal Abidin' => 1, 'Chok Joon Heng' => 2, 'Nadzirah Binti Awaludin' => 3] as $key => $value)
                                            <option class="dropdown-item" value="{{ $value }}">{{ $key }}</option>
                                        @endforeach
                                    </select>
                                        @error('reporting')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user.joined" class="form-control-label">{{ __('Date joined') }}<span class="text-danger">*</span></label>
                                <div class="@error('user.joined') border border-danger rounded-3 @enderror">
                                    <input class="datepicker form-control" type="text" placeholder="dd-mm-yyyy" onfocus="focused(this)" onfocusout="defocused(this)">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="horizontal dark">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">{{ __('Contact Details') }}</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user.phone" class="form-control-label">{{ __('Mobile no') }}</label>
                                <div class="d-flex align-items-center @error('user.phone')border border-danger rounded-3 @enderror">
                                    <span class="col-md-3">+60</span><input class="form-control" type="tel" placeholder="XXXXXXXXX" id="number" name="phone" value="{{ auth()->user()->phone }}">
                                        @error('phone')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user.extno" class="form-control-label">{{ __('Extension no') }}</label>
                                <div class="d-flex align-items-center @error('user.extno')border border-danger rounded-3 @enderror">
                                    <span class="col-md-3">+60 8689</span><input class="form-control" type="tel" placeholder="XXXX" id="number" name="extno" value="{{ auth()->user()->extno }}">
                                        @error('extno')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="user-email" class="form-control-label">{{ __('Email') }}</label>
                            <div class="row">
                                <div class="col-md-4 @error('email')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ auth()->user()->email }}" type="email" placeholder="@example.com" id="user-email" name="email">
                                        @error('email')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                                <div class="col-md-4 dropdown @error('user.domain')border border-danger rounded-3 @enderror">
                                    <select class="form-select form-control" aria-label="Default select example" id="user-domain" name="domain">
                                        <option value="1" @if(auth()->user()->domain == '@awantec.my') selected @endif>@awantec.my</option>
                                        <option value="2" @if(auth()->user()->domain == '@prestariang.my') selected @endif>@prestariang.my</option>
                                    </select>
                                    @error('domain')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <a class="btn bg-gradient-dark mb-0" href="javascript:;"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add New Email</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    NO
                                                </th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Email
                                                </th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Set Email
                                                </th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Status
                                                </th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="ps-4">
                                                    <p class="text-xs font-weight-bold mb-0">1</p>
                                                </td>
                                                <td class="text-center">
                                                    <p class="text-xs font-weight-bold mb-0">admin@softui.com</p>
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">Primary</span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">Active</span>
                                                </td>
                                                <td class="text-center">
                                                    <a href="#" class="mx-2" data-bs-toggle="tooltip" data-bs-original-title="Edit email">
                                                        <i class="fas fa-user-edit text-secondary"></i>
                                                    </a>
                                                    <a href="#" class="mx-2" data-bs-toggle="tooltip" data-bs-original-title="Delete email">
                                                        <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid py-2">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">{{ __('Contact Details') }}</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-name" class="form-control-label">{{ __('Full Name') }}</label>
                                <div class="@error('user.name')border border-danger rounded-3 @enderror">
                                    <input class="form-control" id="user-name" name="name" value="{{ auth()->user()->name }}" type="text" placeholder="Name" >
                                        @error('name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-email" class="form-control-label">{{ __('Email') }}</label>
                                <div class="@error('email')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ auth()->user()->email }}" type="email" placeholder="@example.com" id="user-email" name="email">
                                        @error('email')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user.phone" class="form-control-label">{{ __('Phone') }}</label>
                                <div class="@error('user.phone')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="tel" placeholder="40770888444" id="number" name="phone" value="{{ auth()->user()->phone }}">
                                        @error('phone')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user.location" class="form-control-label">{{ __('Location') }}</label>
                                <div class="@error('user.location') border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="Location" id="name" name="location" value="{{ auth()->user()->location }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="about">{{ 'About Me' }}</label>
                        <div class="@error('user.about')border border-danger rounded-3 @enderror">
                            <textarea class="form-control" id="about" rows="3" placeholder="Say something about yourself" name="about_me">{{ auth()->user()->about_me }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid py-4">
            <div class="row justify-content-end">
                <div class="col-md-6">
                    <div class="form-group text-end">
                        <a href="../user-management" class="btn bg-gradient-secondary btn-md mt-4 mb-4" type="button">Cancel</a>
                        <button type="submit" class="btn bg-gradient-primary btn-md mt-4 mb-4">{{ 'Submit' }}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@push('user-profile')
    <script>
        if (document.querySelector('.datepicker')) {
            flatpickr('.datepicker', {
            dateFormat: "d-m-Y"
            });
        }
    </script>
@endpush

@endsection