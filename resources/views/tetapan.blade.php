@extends('layouts.app', ['page' => 'tetapan'])

@section('content')
    <div class="row mt-2">
        <div class="col-12 col-xl-8">
            <div class="card card-body border-0 shadow mb-4">
                <h2 class="h5 mb-4">Maklumat Akaun</h2>
                <form method="POST" action="{{ url('kemaskini-maklumat-diri') }}" class="form-control">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class=" mb-3">
                            <label for="nama">Nama</label>
                            <input class="form-control" id="nama" type="text" name="nama" placeholder="nama"
                                value="{{ Auth::user()->name }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input class="form-control" id="email" type="email" name="email"
                                    value="{{ Auth::user()->email }}" placeholder="name@company.com" required>
                            </div>
                        </div>
                        {{-- <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input class="form-control" id="phone" type="number" placeholder="+12-345 678 910"
                                    required>
                            </div>
                        </div> --}}
                    </div>
                    
                    <div class="mt-3">
                        <button class="btn btn-gray-800 mt-2 animate-up-2" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
            {{-- <div class="card card-body border-0 shadow mb-4 mb-xl-0">
                <h2 class="h5 mb-4">Alerts & Notifications</h2>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex align-items-center justify-content-between px-0 border-bottom">
                        <div>
                            <h3 class="h6 mb-1">Company News</h3>
                            <p class="small pe-4">Get Rocket news, announcements, and product updates</p>
                        </div>
                        <div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="user-notification-1">
                                <label class="form-check-label" for="user-notification-1"></label>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item d-flex align-items-center justify-content-between px-0 border-bottom">
                        <div>
                            <h3 class="h6 mb-1">Account Activity</h3>
                            <p class="small pe-4">Get important notifications about you or activity you've missed</p>
                        </div>
                        <div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="user-notification-2" checked>
                                <label class="form-check-label" for="user-notification-2"></label>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                        <div>
                            <h3 class="h6 mb-1">Meetups Near You</h3>
                            <p class="small pe-4">Get an email when a Dribbble Meetup is posted close to my location</p>
                        </div>
                        <div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="user-notification-3" checked>
                                <label class="form-check-label" for="user-notification-3"></label>
                            </div>
                        </div>
                    </li>
                </ul>
            </div> --}}
        </div>
        <div class="col-12 col-xl-4">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="card shadow border-0 p-0">
                        <div class="card-body pb-5">
                            <h2 class="h5 mb-4">Kata Laluan</h2>
                            <div class="row">
                                <div class=" mb-3">
                                    <label for="current_password">Kata Laluan Terini</label>
                                    <input class="form-control" id="current_password" name="current_password" type="password" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class=" mb-3">
                                    <label for="new_password">Kata laluan Baru</label>
                                    <input class="form-control" id="new_password" name="new_password" type="password" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class=" mb-3">
                                    <label for="confirm_new_password">Sahkan Kata laluan Baru</label>
                                    <input class="form-control" id="confirm_new_password" name="confirm_new_password" type="password" required>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-gray-800 mt-2 animate-up-2" type="submit">Kemaskini</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-12">
                    <div class="card card-body border-0 shadow mb-4">
                        <h2 class="h5 mb-4">Select profile photo</h2>
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <!-- Avatar -->
                                <img class="rounded avatar-xl"
                                    src="{{ asset('volt/assets/img/team/profile-picture-3.jpg') }}" alt="change avatar">
                            </div>
                            <div class="file-field">
                                <div class="d-flex justify-content-xl-center ms-xl-3">
                                    <div class="d-flex">
                                        <svg class="icon text-gray-500 me-2" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <input type="file">
                                        <div class="d-md-block text-left">
                                            <div class="fw-normal text-dark mb-1">Choose Image</div>
                                            <div class="text-gray small">JPG, GIF or PNG. Max size of 800K</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
