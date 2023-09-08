<style>
    div.dataTables_processing div {
        display: none;
    }
</style>
<div class="page-content">
    <div class="container-fluid" id="index">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Users Lists</h4>
                    <div class="flex-shrink-0">
                        <button type="button" class="btn btn-primary waves-effect waves-light" onclick="add()"><i class="las la-plus-circle la-lg"></i> Add User</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-nowrap mb-0" id="test" style="width: 100%;">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">Id</th>
                                    <th class="text-center">Username</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Gender</th>
                                    <th class="text-center">Phone</th>
                                    <th class="text-center">Address</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" id="formulir" style="display: none;">
        <form action="#" method="POST" id="formData">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Add Users</h4>
                        <div class="flex-shrink-0">
                            <button type="button" class="btn btn-danger waves-effect waves-light" onclick="back()"><i class="las la-arrow-alt-circle-left la-lg"></i> Back</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username <small class="text-danger fs-14">*</small> </label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Enter username">
                                <div class="invalid-feedback msg_username"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password <small class="text-danger fs-14">*</small> </label>
                                <input type="text" class="form-control" name="password" id="password" placeholder="Enter user password">
                                <div class="invalid-feedback msg_password"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="fullname" class="form-label">Fullname</label>
                                <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Enter user fullname">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email <small class="text-danger fs-14">*</small></label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter user email">
                                <div class="invalid-feedback msg_email"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="birthplace" class="form-label">Birthplace</label>
                                <input type="text" class="form-control" name="birthplace" id="birthplace" placeholder="Enter user birthplace">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="birthday" class="form-label">Birthday</label>
                                <input type="date" class="form-control" name="birthday" id="birthday" placeholder="Enter your birthday">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control rounded-end" name="phone" id="phone" placeholder="Enter user phone number" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" />
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label for="role" class="form-label">User Role</label>
                                <select class="form-select mb-3" id="role" name="role">
                                    <?php foreach ($role as $r) { ?>
                                        <option value="<?=$r['role_id']?>"><?= $r['role_nm']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 border-1">
                            <div class="mb-3">
                                <label for="JoiningdatInput" class="form-label">Gender</label><br>
                                <div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="radio" name="gender" id="inlineCheckbox1" value="l" checked>
                                    <label class="form-check-label" for="inlineCheckbox1">Laki-Laki</label>
                                </div>
                                <div class="form-check form-check-inline mt-2 ml-5">
                                    <input class="form-check-input" type="radio" name="gender" id="inlineCheckbox2" value="p">
                                    <label class="form-check-label" for="inlineCheckbox2">Perempuan</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" name="address" id="address" placeholder="Enter user address" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-lg-12">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="submit" class="btn btn-primary" id="btnSave" onclick="save()">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    <?php include APPPATH . 'views/sysadmin/users/js/index.js'; ?>
</script>