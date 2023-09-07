<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Home</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-3">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="text-center">
                            <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                <img src="<?= base_url() ?>assets/images/users/avatar-1.jpg" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image">
                                <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                    <input id="profile-img-file-input" type="file" class="profile-img-file-input">
                                    <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                        <span class="avatar-title rounded-circle bg-light text-body">
                                            <i class="ri-camera-fill"></i>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <h5 class="fs-17 mb-1"><?= $data->user_fullname; ?></h5>
                            <p class="text-muted mb-0"><?= $data->role_nm; ?></p>
                        </div>
                    </div>
                </div>
                <!--end card-->
            </div>
            <!--end col-->
            <div class="col-xxl-9">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                    <i class="fas fa-home"></i>
                                    Personal Details
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                    <i class="far fa-user"></i>
                                    Change Password
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body p-4">
                        <div class="tab-content">
                            <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                <form action="javascript:void(0);">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="firstnameInput" class="form-label">Nama Lengkap</label>
                                                <input type="text" class="form-control" id="firstnameInput" placeholder="Enter your firstname" value="<?= $data->user_fullname ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="emailInput" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="emailInput" placeholder="Enter your email" value="<?= $data->email ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="firstnameInput" class="form-label">Tempat Lahir</label>
                                                <input type="text" class="form-control" id="firstnameInput" placeholder="Enter your firstname" value="<?= $data->user_birthplace ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="lastnameInput" class="form-label">Tanggal Lahir</label>
                                                <input type="date" class="form-control" id="lastnameInput" placeholder="Enter your lastname" value="<?= $data->user_birth_date ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="phonenumberInput" class="form-label">Nomor Telepon</label>
                                                <input type="text" class="form-control" id="phonenumberInput" placeholder="Enter your phone number" value="<?= $data->user_phone ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="JoiningdatInput" class="form-label">Jenis Kelamin</label><br>
                                                <div class="form-check form-check-inline mt-2">
                                                    <input class="form-check-input" type="radio" name="gender" id="inlineCheckbox1" value="l" <?= ($data->user_gender == 'l') ? 'checked' : '' ?>>
                                                    <label class="form-check-label" for="inlineCheckbox1">Laki-Laki</label>
                                                </div>
                                                <div class="form-check form-check-inline mt-2 ml-5">
                                                    <input class="form-check-input" type="radio" name="gender" id="inlineCheckbox2" value="p" <?= ($data->user_gender == 'p') ? 'checked' : '' ?>>
                                                    <label class="form-check-label" for="inlineCheckbox2">Perempuan</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3 pb-2">
                                                <label for="exampleFormControlTextarea" class="form-label">Description</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea" placeholder="Enter your description" rows="3"><?= $data->user_address; ?></textarea>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-12">
                                            <div class="hstack gap-2 justify-content-end">
                                                <button type="button" class="btn btn-soft-primary">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Updates</button>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </form>
                            </div>
                            <!--end tab-pane-->
                            <div class="tab-pane" id="changePassword" role="tabpanel">
                                <form action="javascript:void(0);">
                                    <div class="row g-2">
                                        <div class="col-lg-4">
                                            <div>
                                                <label for="oldpasswordInput" class="form-label">Old
                                                    Password*</label>
                                                <input type="password" class="form-control" id="oldpasswordInput" placeholder="Enter current password">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div>
                                                <label for="newpasswordInput" class="form-label">New
                                                    Password*</label>
                                                <input type="password" class="form-control" id="newpasswordInput" placeholder="Enter new password">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div>
                                                <label for="confirmpasswordInput" class="form-label">Confirm
                                                    Password*</label>
                                                <input type="password" class="form-control" id="confirmpasswordInput" placeholder="Confirm password">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <a href="javascript:void(0);" class="link-primary text-decoration-underline">Forgot
                                                    Password ?</a>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-12">
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-success">Change
                                                    Password</button>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </form>
                            </div>
                            <!--end tab-pane-->
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
        <!-- end page title -->

    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->