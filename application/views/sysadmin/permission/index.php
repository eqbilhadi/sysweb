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
                    <h4 class="mb-sm-0">Permission</h4>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" id="formData">
                <div class="modal-header border-bottom pb-3">
                    <h5 class="modal-title" id="myModalLabel">List Permission Navigation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-nowrap mb-0" id="tableNav" style="width: 100%;">
                        <thead class="table-light">
                            <tr>
                                <th style="vertical-align: middle;" class="text-center">No</th>
                                <th class="text-center" style="vertical-align: middle;">Navigation Name</th>
                                <th style="vertical-align: middle;" class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <input type="hidden" name="role_id" id="role_id">
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
    <?php include APPPATH . 'views/sysadmin/permission/js/index.js'; ?>
</script>