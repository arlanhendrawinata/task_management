@extends('layouts.app')

@section('container.isi')
<div class="card">
    <div class="card-body">
        <div class="profile-tab">
            <div class="custom-tab-1">
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a href="#about-me" data-toggle="tab" class="nav-link active show">About Me</a>
                    </li>
                    <li class="nav-item"><a href="#profile-settings" data-toggle="tab" class="nav-link">Setting</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="about-me" class="tab-pane fade active show">
                        <div class="profile-about-me">
                            <div class="pt-4 border-bottom-1 pb-3">
                                <h4 class="text-primary">About Me</h4>
                                <p class="mb-2">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence was created for the bliss of souls like mine.I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents.</p>
                                <p>A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.</p>
                            </div>
                        </div>
                        <div class="profile-skills mb-5">
                            <h4 class="text-primary mb-2">Skills</h4>
                            <a href="javascript:void()" class="btn btn-primary light btn-xs mb-1">Admin</a>
                            <a href="javascript:void()" class="btn btn-primary light btn-xs mb-1">Dashboard</a>
                            <a href="javascript:void()" class="btn btn-primary light btn-xs mb-1">Photoshop</a>
                            <a href="javascript:void()" class="btn btn-primary light btn-xs mb-1">Bootstrap</a>
                            <a href="javascript:void()" class="btn btn-primary light btn-xs mb-1">Responsive</a>
                            <a href="javascript:void()" class="btn btn-primary light btn-xs mb-1">Crypto</a>
                        </div>
                        <div class="profile-lang  mb-5">
                            <h4 class="text-primary mb-2">Language</h4>
                            <a href="javascript:void()" class="text-muted pr-3 f-s-16"><i class="flag-icon flag-icon-us"></i> English</a>
                            <a href="javascript:void()" class="text-muted pr-3 f-s-16"><i class="flag-icon flag-icon-fr"></i> French</a>
                            <a href="javascript:void()" class="text-muted pr-3 f-s-16"><i class="flag-icon flag-icon-bd"></i> Bangla</a>
                        </div>
                        <div class="profile-personal-info">
                            <h4 class="text-primary mb-4">Personal Information</h4>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Name <span class="pull-right">:</span>
                                    </h5>
                                </div>
                                <div class="col-9"><span>Mitchell C.Shay</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Email <span class="pull-right">:</span>
                                    </h5>
                                </div>
                                <div class="col-9"><span><a href="https://koki.dexignzone.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="791c01181409151c391c01181409151c15571a1614">[email&#160;protected]</a></span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Availability <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>Full Time (Free Lancer)</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Age <span class="pull-right">:</span>
                                    </h5>
                                </div>
                                <div class="col-9"><span>27</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Location <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>Rosemont Avenue Melbourne,
                                        Florida</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Year Experience <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>07 Year Experiences</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="profile-settings" class="tab-pane fade">
                        <div class="pt-3">
                            <div class="settings-form">
                                <h4 class="text-primary">Account Setting</h4>
                                <form>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Email</label>
                                            <input type="email" placeholder="Email" class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Password</label>
                                            <input type="password" placeholder="Password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" placeholder="1234 Main St" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Address 2</label>
                                        <input type="text" placeholder="Apartment, studio, or floor" class="form-control">
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>City</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>State</label>
                                            <select class="form-control" id="inputState">
                                                <option selected="">Choose...</option>
                                                <option>Option 1</option>
                                                <option>Option 2</option>
                                                <option>Option 3</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Zip</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="gridCheck">
                                            <label class="custom-control-label" for="gridCheck"> Check me out</label>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" type="submit">Sign
                                        in</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
