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
                    <h4 class="mb-sm-0">Navigation Lists</h4>
                    <div class="flex-shrink-0">
                        <button type="button" class="btn btn-primary waves-effect waves-light" onclick="add()"><i class="las la-plus-circle la-lg"></i> Add Nav</button>
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
                                    <th class="text-center" style="vertical-align: middle;">Navigation Name</th>
                                    <th class="text-center" style="vertical-align: middle;">URL</th>
                                    <th class="text-center" style="vertical-align: middle;">Order</th>
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
                    <h5 class="modal-title" id="myModalLabel">Modal Heading</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label for="induk_menu" class="form-label">Induk Menu</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="hidden" name="nav_id" id="nav_id">
                            <select name="induk_menu" id="induk_menu" class="form-select">
                                <option value="0">Induk Menu</option>
                                <?php foreach ($induk_menu as $r) { ?>
                                    <option value="<?= $r['nav_id'] ?>"><?= $r['nav_title']; ?></option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback msg_induk_menu"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label for="nav_title" class="form-label">Menu Title</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="nav_title" name="nav_title" placeholder="Enter menu title">
                            <div class="invalid-feedback msg_nav_title"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label for="nav_desc" class="form-label">Menu Description</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="nav_desc" name="nav_desc" placeholder="Enter menu description">
                            <div class="invalid-feedback msg_nav_desc"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label for="nav_url" class="form-label">Menu URL</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="nav_url" name="nav_url" placeholder="Enter menu url ex. sysadmin/dashboard">
                            <div class="invalid-feedback msg_nav_url"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label for="nav_no" class="form-label">Order</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="nav_no" name="nav_no" placeholder="Enter menu order for determine the order of the menu">
                            <div class="invalid-feedback msg_nav_no"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label for="faicon" class="form-label">Menu Icon</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="faicon" name="faicon" placeholder="Enter menu icon ex. las la-home, las la-users">
                            <div class="invalid-feedback msg_faicon"></div>
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
    <?php include APPPATH . 'views/sysadmin/navigation/js/index.js'; ?>
</script>