<div class="container mt-5">
    <div class="row my-2">
        <div class="col-md-12">
            @if (session()->has('alerts'))
            <div class="alert {{ session('alerts.type') }} alert-dismissible fade show" role="alert">
                {{ session('alerts.message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-2">
                            Change Password
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-8 py-4">
                            <form wire:submit.prevent="save">
                                <div class="row">
                                    <div class="col-md-3"><label for="oldpassword">Old Password</label></div>
                                    <div class="col-md-9"><input class="form-control" required
                                            wire:model.defer="oldpassword" type="password" required id="oldepassword">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-5 offset-3">
                                        @error('oldpassword') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-3"><label for="oldpassword">New Password</label></div>
                                    <div class="col-md-9"><input class="form-control" required
                                            wire:model.defer="newpassword" type="password" required id="newpassword">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-9 offset-3">
                                        @error('newpassword') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-3"><label for="oldpassword">Confirm Password</label></div>
                                    <div class="col-md-9"><input class="form-control" required
                                            wire:model.defer="confirmpassword" type="password" required
                                            id="confirmpassword"></div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-9 offset-3">
                                        @error('confirmpassword') <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-md-2 offset-3"><input class="btn btn-success" type="submit"
                                            value="Save Password">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>