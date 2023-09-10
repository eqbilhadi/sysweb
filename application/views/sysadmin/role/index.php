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
                    <h4 class="mb-sm-0">Role Lists</h4>
                    <div class="flex-shrink-0">
                        <button type="button" class="btn btn-primary waves-effect waves-light" onclick="add()"><i class="las la-plus-circle la-lg"></i> Add Role</button>
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
                                    <th style="vertical-align: middle;" class="text-center">No</th>
                                    <th class="text-center" style="vertical-align: middle;"><u>Role Name</u><br /> <span style="font-size: 9pt; font-weight: lighter;"> Description</span></th>
                                    <th style="vertical-align: middle;" class="text-center">Action</th>
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
</div>

<div id="myModalForm" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" id="formData">
                <div class="modal-header border-bottom pb-3">
                    <h5 class="modal-title" id="myModalLabel">Modal Heading</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label for="role_nm" class="form-label">Role Name</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="hidden" name="role_id" id="role_id">
                            <input type="text" class="form-control" id="role_nm" name="role_nm" placeholder="Enter role name" autofocus>
                            <div class="invalid-feedback msg_role_nm"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label for="role_desc" class="form-label">Role Description</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="role_desc" name="role_desc" placeholder="Enter role description">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label for="default_page" class="form-label">Default Page</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="default_page" name="default_page" placeholder="Enter default page">
                            <div class="invalid-feedback msg_default_page"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-start ps-3">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" id="btnSave" onclick="save()">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    <?php include APPPATH . 'views/sysadmin/role/js/index.js'; ?>
</script>