<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex p-2  align-items-center justify-content-between">
                    <div class="d-flex gap-2 ">
                        <i class="fa fa-calendar text-primary text-sm opacity-10"></i>
                        <h6 class="mb-0">Schedule</h6>
                    </div>
                </div>
                <div class="card-body px-0 pt-2 pb-2 px-4 classes-card">
                    <table class="table align-items-center mb-0" id="schedule_table">
                        <thead>
                            <tr>
                                <th width="20%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Class</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Monday</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tuesday</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Wednesday</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Thursday</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Friday</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Saturday</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sunday</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="8" class="text-center">No data available</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="schedule_modal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa fa-clock"></i> Add Schedule Time</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="schedForm">
                <div class="px-3 py-2">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-sm px-3 mb-1 btn-primary" id="time_sched_btn"><i class="fa fa-plus-circle"></i> Add Time</button>
                    </div>

                    <div id="time_sched_div">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm  px-3 btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    <button type="submit" class="btn btn-sm  px-3 btn-primary"><i class="fa fa-plus-circle"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>