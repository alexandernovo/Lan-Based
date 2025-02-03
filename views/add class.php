<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header  p-2  d-flex gap-2 d-flex align-items-center">
                    <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    <h6 class="mb-0">Add Class</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2 px-4 classes-card">
                    <div class="mx-auto class-add-card">
                        <form method="POST" action="actions/manage_class.php" enctype="multipart/form-data">
                            <div class="image-now mt-4" id="image-container">
                                <img class="img-fluid h-100 border" src="public/assets/img/default.jpg" id="preview-image">
                                <input type="file" name="image" class="d-none" id="image-upload">
                                <label for="image-upload" type="button" class="btn btn-sm btn-secondary mt-1 mx-0 px-3">Upload</;>
                            </div>
                            <div class="form-row">
                                <!-- <label class="mx-0">Class name</label> -->
                                <input type="hidden" name="classname" class="form-control">
                            </div>

                            <div class="form-row">
                                <!-- <label class="mx-0">Subject</label> -->
                                <input type="hidden" name="subject" class="form-control">
                            </div>

                            <div class="form-row mt-5">
                                <label class="mx-0">Course</label>
                                <input name="course" class="form-control">
                            </div>
                            <div class="form-row mt-2">
                                <label class="mx-0">Year and Section</label>
                                <input required name="section" class="form-control">
                            </div>
                            <div class="form-row mt-2">
                                <label class="mx-0">Program</label>
                                <input name="program" class="form-control">
                            </div>
                            <div class="form-row mt-2">
                                <p class="mb-0 font-bold">Schedule of Classes</p>
                                <select name="schedclass_lecture" class="form-select">
                                    <option value="Lecture">Lecture</option>
                                    <option value="Lab">Lab</option>
                                </select>
                                <!-- <label class="mx-0">Lecture</label> -->
                                <!-- <input name="schedclass_lecture" class="form-control"> -->
                            </div>
                            <!-- <div class="form-row mt-2">
                                <label class="mx-0">Lab</label>
                                <input name="schedclass_lab" class="form-control">
                            </div> -->
                            <div class="form-row mt-2">
                                <!-- <label class="mx-0">Lecture</label>
                                <input name="room" class="form-control"> -->
                            </div>
                            <div class="form-row mt-2">
                                <p class="mb-0 font-bold">Class Room</p>
                                <label class="mx-0">Lab</label>
                                <input name="classroom_lab" class="form-control">
                            </div>


                            <div class="form-row mt-3 mb-5">
                                <button name="add_class" class="btn btn-success w-100 button-text-size">Create Class</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>