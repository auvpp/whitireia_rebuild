<!-- Modal for add a new student -->
<div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="addStudentModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="addStudentModalLabel">@lang('Add A New Student')</h4>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" action="{{url('settings/addstudent')}}" method="post">
                {{csrf_field()}}                    
                    <div class="row" style="margin-bottom:7px;">
                        <div class="col-sm-2">
                            <label for="addStudentCode" class="pull-right control-label">@lang('Code :')</label>
                        </div>
                        <div class="col-sm-4">
                            <input style="width:100%" name="code" class="form-control" id="addStudentCode" required>
                        </div>
                        <div class="col-sm-2">
                            <label for="addStudentEmail" class="pull-right control-label">@lang('Email :')</label>
                        </div>
                        <div class="col-sm-4">
                            <input style="width:100%" name="email" class="form-control" id="addStudentEmail" required>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom:7px;">
                        <div class="col-sm-2">
                            <label for="addStudentFName" class="pull-right control-label">@lang('First Name :')</label>
                        </div>
                        <div class="col-sm-4">
                            <input style="width:100%" name="first_name" class="form-control" id="addStudentFName" required>
                        </div>
                        <div class="col-sm-2">
                            <label for="addStudentPhoneNumber" class="pull-right control-label">@lang('Phone Number :')</label>
                        </div>
                        <div class="col-sm-4">
                            <input style="width:100%" name="phone_number" class="form-control" id="addStudentPhoneNumber" required>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom:7px;">
                        <div class="col-sm-2">
                            <label for="addStudentLName" class="pull-right control-label">@lang('Last Name :')</label>
                        </div>
                        <div class="col-sm-4">
                            <input style="width:100%" name="last_name" class="form-control" id="addStudentLName" required>
                        </div>
                        <div class="col-sm-2">
                            <label for="addStudentProgramme" class="pull-right control-label">@lang('Programme :')</label>
                        </div>
                        <div class="col-sm-4">
                            <select style="width:100%" class="form-control" id="addStudentProgramme" name="programme_id" required>
                                <option selected disabled>@lang('Select Programme')</option>
                            @foreach ($programmes as $p)
                                <option value="{{$p->id}}">{{ucfirst($p->name)}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom:7px;">
                        <div class="col-sm-2">
                            <label for="addStudentGender" class="pull-right control-label">@lang('Gender :')</label>
                        </div>
                        <div class="col-sm-4">
                            <select style="width:100%" class="form-control" id="addStudentGender" name="gender" required>
                                <option value="Male">@lang('Male')</option>
                                <option value="Female">@lang('Female')</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label for="addStudentQualification" class="pull-right control-label">@lang('Qualification :')</label>
                        </div>
                        <div class="col-sm-4">
                            <select style="width:100%" class="form-control" id="addStudentQualification" name="qualification_id" required>
                                <option selected disabled>@lang('Select Qualification')</option>
                            @foreach ($qualifications as $q)
                                <option value="{{$q->id}}">{{ucfirst($q->name)}}</option>
                            @endforeach
                            </select>
                        </div>                                               
                    </div>

                    <div class="row" style="margin-bottom:7px;">
                        <div class="col-sm-2">
                            <label for="addStudentAddress" class="pull-right control-label">@lang('Address :')</label>
                        </div>
                        <div class="col-sm-4">
                            <input style="width:100%" name="address" class="form-control" id="addStudentAddress">
                        </div>                         
                        <div class="col-sm-2">
                            <label for="addStudentMajor" class="pull-right control-label">@lang('Major :')</label>
                        </div>
                        <div class="col-sm-4">
                            <select style="width:100%" class="form-control" id="addStudentMajor" name="major_id" required>
                                <option selected disabled>@lang('Select Major')</option>
                            @foreach ($majors as $m)
                                <option value="{{$m->id}}">{{ucfirst($m->name)}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom:7px;">
                        
                        <div class="col-sm-2">
                            <label for="addStudentAbout" class="pull-right control-label">@lang('About :')</label>
                        </div>
                        <div class="col-sm-10">
                            <textarea style="width:100%" class="form-control" name="about" rows="1" id="addStudentAbout"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-info btn-sm" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-danger btn-sm">@lang('Save')</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>

<script>
    var qualifications = <?php echo json_encode($qualifications)?>;
    var majors = <?php echo json_encode($majors)?>;

    $(document).ready(function(){
        $("#addStudentQualification").attr("disabled", "disabled");
        $("#addStudentMajor").attr("disabled", "disabled");
        
        // if user changes the selection of programme
        $('#addStudentProgramme').change(function () {
            $("#addStudentQualification").removeAttr("disabled");
            $("#addStudentMajor").removeAttr("disabled");

            // show corresponding options of the qualification
            let selected_programme_id = $(this).val();
            getQualificationsByProgrammeId(selected_programme_id);

            // show corresponding options of the major
            let selected_qualification_id = $("#addStudentQualification").val();
            getMajorsByQualificationId(selected_qualification_id);
        });
            
        // if user changes the selection of qualification
        $('#addStudentQualification').change(function () {
            $("#addStudentMajor").removeAttr("disabled");
            // show corresponding options of the major
            let selected_qualifiction_id = $("#addStudentQualification").val();
            console.log(selected_qualifiction_id);
            getMajorsByQualificationId(selected_qualifiction_id);
        });

        function getQualificationsByProgrammeId(programme_id){
            var qualification_select = document.getElementById("addStudentQualification");
            //$("#addStudentQualification option").hide();
            qualification_select.options.length = 0;  // remove all options
            for (let i = 0; i < qualifications.length; i ++){
                if (qualifications[i].programme_id == programme_id){
                    qualification_select.options.add(new Option(qualifications[i].name, qualifications[i].id));   
                }
            }
        }

        function getMajorsByQualificationId(qualification_id){
            var major_select = document.getElementById("addStudentMajor");
            //$("#addStudentMajor option").hide();
            major_select.options.length = 0;  // remove all options
            for (let i = 0; i < majors.length; i ++){
                if (majors[i].qualification_id == qualification_id){
                major_select.options.add(new Option(majors[i].name, majors[i].id));           
                }
            }
        }
    });
</script>
