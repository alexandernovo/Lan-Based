<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 p-3" style="min-height: 500px">
                <?php if ($_SESSION['usertype'] != 2) { ?>
                    <div id="calendar" data-type="notadmin" style="width: 100%;"></div>
                <?php } else { ?>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <p class="mb-0 fw-bold" style="font-size: 18px">Schedules</p>
                        <div class="form-group mb-0 col-3">
                            <input type="search" id="teacher_filter" autocomplete="off" class="form-control" placeholder="Search teacher here..." list="teacher_list">
                            <datalist class="teacher_list" id="teacher_list"></datalist>
                        </div>
                    </div>
                    <div id="calendarAdmin" data-type="admin" style="width: 100%;"></div>
                <?php } ?>
            </div>
        </div>

    </div>
</div>