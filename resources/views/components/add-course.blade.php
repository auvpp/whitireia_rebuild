<!-- Modal for add a new course -->
<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="addCourseModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="addCourseModalLabel">@lang('Add A New Course')</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="{{url('settings/addcourse')}}" method="post">
                    {{csrf_field()}}                    
                    <div class="row" style="margin-bottom:7px;">
                        <div class="col-sm-2">
                            <label for="addCourseName" class="pull-right control-label">@lang('Name :')</label>
                        </div>
                        <div class="col-sm-4">
                            <input style="width:100%" name="name" class="form-control" id="addCourseName" required>
                        </div>
                        <div class="col-sm-2">
                            <label for="addCourseType" class="pull-right control-label">@lang('Type :')</label>
                        </div>
                        <div class="col-sm-4">
                            <select style="width:100%" class="form-control" id="addCourseType" name="type" required>
                                <option value="Compulsory">@lang('Compulsory')</option>
                                <option value="Elective">@lang('Elective')</option>
                            </select>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom:7px;">
                        <div class="col-sm-2">
                            <label for="addCourseLevel" class="pull-right control-label">@lang('Level :')</label>
                        </div>
                        <div class="col-sm-4">
                            <select style="width:100%" name="level" class="form-control" id="addCourseLevel" required>
                                <option value="Level 5">@lang('Level 5')</option>
                                <option value="Level 6">@lang('Level 6')</option>
                                <option value="Level 7">@lang('Level 7')</option>
                                <option value="Level 8">@lang('Level 8')</option>
                                <option value="Level 9">@lang('Level 9')</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label for="addCourseCurrent" class="pull-right control-label">@lang('Current Offered :')</label>
                        </div>
                        <div class="col-sm-4">
                            <select style="width:100%" name="current_offered" class="form-control" id="addCourseCurrent" required>
                                <option value="{{'T1-'.date('Y')}}">{{ 'T1-'.date('Y')}}</option>
                                <option value="{{'T2-'.date('Y')}}">{{ 'T2-'.date('Y')}}</option>
                                <option value="{{'T1-'.(date('Y')+1)}}">{{ 'T1-'.(date('Y')+1)}}</option>
                                <option value="{{'T2-'.(date('Y')+1)}}">{{ 'T2-'.(date('Y')+1)}}</option>
                                <option value="TBA">@lang('TBA')</option>
                                <option value="Not offered">@lang('Not offered')</option>
                                <option value="No longer offered">@lang('No longer offered')</option>
                            </select>
                        </div>    
                    </div>

                    <div class="row" style="margin-bottom:7px;">
                        <div class="col-sm-2">
                            <label for="addCourseCredit" class="pull-right control-label">@lang('Credits :')</label>
                        </div>
                        <div class="col-sm-4">
                            <select style="width:100%" name="credit" class="form-control" id="addCourseCredit" required>
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="45">45</option>
                                <option value="60">60</option>
                                <option value="90">90</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label for="addCourseNext" class="pull-right control-label">@lang('Next Offered :')</label>
                        </div>
                        <div class="col-sm-4">
                            <select style="width:100%" name="next_offered" class="form-control" id="addCourseNext" required> 
                                <option value="{{'T1-'.date('Y')}}">{{ 'T1-'.date('Y')}}</option>
                                <option value="{{'T2-'.date('Y')}}">{{ 'T2-'.date('Y')}}</option>
                                <option value="{{'T1-'.(date('Y')+1)}}">{{ 'T1-'.(date('Y')+1)}}</option>
                                <option value="{{'T2-'.(date('Y')+1)}}">{{ 'T2-'.(date('Y')+1)}}</option>
                                <option value="Not offered">@lang('Not offered')</option>
                                <option value="TBA">@lang('TBA')</option>
                                <option value="No longer offered">@lang('No longer offered')</option>
                            </select>
                        </div>               
                    </div>

                    <div class="row" style="margin-bottom:7px;">
                        <div class="col-sm-2">
                            <label for="addCourseProgramme" class="pull-right control-label">@lang('Programme :')</label>
                        </div>
                        <div class="col-sm-4">
                            <select style="width:100%" class="form-control" id="addCourseProgramme" name="programme_id" required>
                                <option selected disabled>@lang('Select Programme')</option>
                            @foreach ($programmes as $p)
                                <option value="{{$p->id}}">{{ucfirst($p->name)}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label for="addCourseTeacher" class="pull-right control-label">@lang('Tutor :')</label>
                        </div>
                        <div class="col-sm-4">
                            <select style="width:100%" class="form-control" id="addCourseTeacher" name="teacher" required>
                                <option value="TBA">@lang('TBA')</option>
                                @foreach ($teachers as $t)
                                <option value="{{ucfirst($t->first_name).' '.ucfirst($t->last_name)}}" data-teacherid="{{$t->id}}">{{ucfirst($t->first_name).' '.ucfirst($t->last_name).' ('.ucfirst($t->programme->name).')'}}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="teacher_id" id="addCourseTeacherId" required/>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom:7px;">
                        <div class="col-sm-2">
                            <label for="addCourseQualification" class="pull-right control-label">@lang('Qualification :')</label>
                        </div>
                        <div class="col-sm-4">
                            <select style="width:100%" class="form-control" id="addCourseQualification" name="qualification_id" required>
                                <option selected disabled>@lang('Select Qualification')</option>
                            @foreach ($qualifications as $q)
                                <option value="{{$q->id}}">{{ucfirst($q->name)}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label for="addCoursePrerequsite" class="pull-right control-label">@lang('Prerequisites :')</label>
                        </div>
                        <div class="col-sm-4">
                            <input style="width:100%" name="prerequisite" class="form-control" id="addCoursePrerequsite"/>
                        </div>                     
                    </div>

                    <div class="row" style="margin-bottom:7px;">
                        <div class="col-sm-2">
                            <label for="addCourseMajor" class="pull-right control-label">@lang('Major :')</label>
                        </div>
                        <div class="col-sm-4">
                            <select style="width:100%" class="form-control" id="addCourseMajor" name="major_id" required>
                                <option selected disabled>@lang('Select Major')</option>
                            @foreach ($majors as $m)
                                <option value="{{$m->id}}">{{ucfirst($m->name)}}</option>
                            @endforeach                 
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label for="addCourseDesc" class="pull-right control-label">@lang('Description :')</label>
                        </div>
                        <div class="col-sm-4">
                            <textarea style="width:100%" class="form-control" name="description" rows="1" id="addCourseDesc"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-info btn-sm" data-dismiss="modal">@lang('Close')</button>
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#addCourseConfirmModal">@lang('Save')</button>
                    </div>

                    <!-- Modal for confirmation -->
                    <div class="modal fade" id="addCourseConfirmModal" tabindex="-1" role="dialog" aria-labelledby="addCourseConfirmModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-success text-white">
                                    <button class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h4 class="modal-title" id="addCourseConfirmModalLabel">@lang('Confirmation')</h4>
                                </div>
                                <div class="modal-body">                  
                                    <div class="row" style="margin-bottom:7px;">
                                        <div class="col-sm-3">
                                            <label for="addCourseCode" class="pull-right control-label">@lang('Course Code :')</label>
                                        </div>
                                        <div class="col-sm-3">
                                            <input style="width:100%" name="code" class="form-control" id="addCourseCode" required>
                                        </div>
                                        <div class="col-sm-1">
                                            <button id="check_code" type="button" class="btn btn-info">@lang('Occupied ?')</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="col-sm-10 text-danger text-left" id="check_result"></div>
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-danger btn-sm">@lang('Confirm')</button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
        $("#addCourseQualification").attr("disabled", "disabled");
        $("#addCourseMajor").attr("disabled", "disabled");
        $("#addCourseTeacherId").val(0);
        
        // if user changes the selection of programme
        $('#addCourseProgramme').change(function () {
            $("#addCourseQualification").removeAttr("disabled");
            $("#addCourseMajor").removeAttr("disabled");

            // show corresponding options of the qualification
            let selected_programme_id = $(this).val();
            getQualificationsByProgrammeId(selected_programme_id);

            // show corresponding options of the major
            let selected_qualification_id = $("#addCourseQualification").val();
            getMajorsByQualificationId(selected_qualification_id);
        });
            
        // if user changes the selection of qualification
        $('#addCourseQualification').change(function () {
            $("#addCourseMajor").removeAttr("disabled");
            // show corresponding options of the major
            let selected_qualifiction_id = $("#addCourseQualification").val();
            getMajorsByQualificationId(selected_qualifiction_id);
        });

        function getQualificationsByProgrammeId(programme_id){
            var qualification_select = document.getElementById("addCourseQualification");
            //$("#addCourseQualification option").hide();
            qualification_select.options.length = 0;  // remove all options
            for (let i = 0; i < qualifications.length; i ++){
                if (qualifications[i].programme_id == programme_id){
                    qualification_select.options.add(new Option(qualifications[i].name, qualifications[i].id));   
                }
            }
        }

        function getMajorsByQualificationId(qualification_id){
            var major_select = document.getElementById("addCourseMajor");
            //$("#addCourseMajor option").hide();
            major_select.options.length = 0;  // remove all options
            for (let i = 0; i < majors.length; i ++){
                if (majors[i].qualification_id == qualification_id){
                major_select.options.add(new Option(majors[i].name, majors[i].id));           
                }
            }
        }

        $("#addCourseCurrent").change(function(){
            var current_offered = $("#addCourseCurrent").val();
            if (current_offered == 'No longer offered') {
                $("#addCourseNext").val('No longer offered');
                $("#addCourseNext").attr("disabled", "disabled");
                $("#addCourseTeacher").val('TBA');
                $("#addCourseTeacher").attr("disabled", "disabled");
            }
            else{
                $("#addCourseNext").removeAttr("disabled"); 
                $("#addCourseTeacher").removeAttr('disabled');
            }
        });

        $("#addCourseTeacher").change(function(){
            let current_teacher = $("#addCourseTeacher").val() 
            if (current_teacher== 'TBA'){
                $("#addCourseTeacherId").val(0);
            }else{
                let teacher_id = $("#addCourseTeacher option:selected").data("teacherid");
                // let teacher_id = $("#addCourseTeacher").find("option:selected").data("teacherid");
                $("#addCourseTeacherId").val(teacher_id);
            }
        });

        $("#check_code").click(function() {         
            let code =$("#addCourseCode").val().trim();
            let major_id = $("#addCourseMajor").val();
            if (code == null || code == ''){
                $("#check_result").html("Course Code cannot be empty.");
            }
            else{
                $.ajax({
                    type: 'POST',
                    url: '/settings/checkcode',
                    
                    // if we use ajax in Laravel, this headers must be put in here, and 
                    // put <meta name="csrf-token" content="{{ csrf_token() }}"> in the html head
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    data: { "code" : code, "major_id" : major_id },
                    success: function(data){
                        if(data.success){
                            $("#check_result").html("This course code has been taken, please use another one.");
                        }
                        else{
                            $("#check_result").html("This code can be used as Course Code.");
                        }
                    }
                });
            }
        });
    });
</script>
