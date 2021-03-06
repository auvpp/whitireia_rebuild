<div class="panel panel-default">
  @foreach ($majors as $major)
    <div class="page-panel-title" role="tab" id="heading{{$major->id}}">
      <a class="panel-title collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$major->id}}" aria-expanded="false" aria-controls="collapse{{$major->id}}">
        <h4>
          {{ucfirst($major->name)}} <span class="pull-right"><small>@lang('Click to view all courses under this major') <i class="material-icons">keyboard_arrow_down</i></small></span>
        </h4>
      </a>
    </div>
    <div id="collapse{{$major->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$major->id}}">
      <div class="panel-body table-responsive">
      <button class="btn btn-xs btn-info" id="btnPrint{{$major->id}}"><i class="material-icons">print</i> @lang('Print Courses')</button>
      <!--startprint-->
        <table class="table table-bordered table-striped table-data-div table-hover table-condensed"> 
          <thead>
            <tr class="bg-success text-white">
              @if(Auth::user()->role == 'admin')
              <th scope="col" class="noprint">@lang('Action')</th>
              @endif
              <th scope="col">@lang('Course Code')</th>
              <th scope="col">@lang('Course Name')</th>
              <th scope="col">@lang('Course Level')</th>
              <th scope="col">@lang('Course Type')</th>
              <th scope="col">@lang('Credits')</th>
              <th scope="col">@lang('Current Offered')</th>
              <th scope="col">@lang('Next Offered')</th>
              <th scope="col">@lang('Prerequisites')</th>
              <th scope="col">@lang('Tutor')</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($major->courses as $course)
            <tr>
              @if(Auth::user()->role == 'admin')
              <td class="noprint">
                <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#adminCourseModal{{$course->id}}">@lang('Edit')</button>
                <!-- Modal -->
                <div class="modal fade" id="adminCourseModal{{$course->id}}" tabindex="-1" role="dialog" aria-labelledby="adminCourseModal{{$course->id}}Label">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header" style="background-color: #5cb85c; color:white !important;">          
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="adminCourseModal{{$course->id}}Label">@lang('Manage Course')</h4>
                      </div>
                      <div class="modal-body">
                        <form class="form-horizontal" action="{{url('edit/course/'.$course->id)}}" method="post">
                          {{csrf_field()}}

                          <div class="row" style="margin-bottom:7px;">
                            <div class="col-sm-2">
                              <label for="adminCourseCode{{$course->id}}" class="pull-right control-label">@lang('Course Code :')</label>
                            </div>
                            <div class="col-sm-4">
                              <input style="width:100%" name="code" class="form-control" id="adminCourseCode{{$course->id}}" value="{{$course->code}}" required>
                            </div>
                            <div class="col-sm-2">
                              <label for="adminCourseName{{$course->id}}" class="pull-right control-label">@lang('Course Name :')</label>
                            </div>
                            <div class="col-sm-4">
                              <input style="width:100%" name="name" class="form-control" id="adminCourseName{{$course->id}}" value="{{$course->name}}" required>
                            </div>
                          </div>

                          <div class="row" style="margin-bottom:7px;">
                            <div class="col-sm-2">
                              <label for="adminCourseLevel{{$course->id}}" class="pull-right control-label">@lang('Course Level :')</label>
                            </div>
                            <div class="col-sm-4">
                              <select style="width:100%" class="form-control" id="adminCourseLevel{{$course->id}}" name="level" required>
                                <option value="Level 5">@lang('Level 5')</option>
                                <option value="Level 6">@lang('Level 6')</option>
                                <option value="Level 7">@lang('Level 7')</option>
                                <option value="Level 8">@lang('Level 8')</option>
                                <option value="Level 9">@lang('Level 9')</option>
                              </select>
                            </div>
                            <div class="col-sm-2">
                              <label for="adminCourseCredit{{$course->id}}" class="pull-right control-label">@lang('Credits :')</label>
                            </div>
                            <div class="col-sm-4">
                              <select style="width:100%" class="form-control" id="adminCourseCredit{{$course->id}}" name="credit" required>
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="45">45</option>
                                <option value="60">60</option>
                                <option value="90">90</option>
                              </select>
                            </div>
                          </div>

                          <div class="row" style="margin-bottom:7px;">
                            <div class="col-sm-2">
                              <label for="adminCourseCurrentOffered{{$course->id}}" class="pull-right control-label">@lang('Current Offered :')</label>
                            </div>
                            <div class="col-sm-4">
                              <select style="width:100%" class="form-control" id="adminCourseCurrentOffered{{$course->id}}" name="current_offered" required> 
                                <option value="{{'T1-'.date('Y')}}">{{ 'T1-'.date('Y')}}</option>
                                <option value="{{'T2-'.date('Y')}}">{{ 'T2-'.date('Y')}}</option>
                                <option value="{{'T1-'.(date('Y')+1)}}">{{ 'T1-'.(date('Y')+1)}}</option>
                                <option value="{{'T2-'.(date('Y')+1)}}">{{ 'T2-'.(date('Y')+1)}}</option>
                                <option value="Not offered">@lang('Not offered')</option>
                                <option value="TBA">@lang('TBA')</option>
                                <option value="No longer offered">@lang('No longer offered')</option>
                              </select>
                            </div>
                            <div class="col-sm-2">
                              <label for="adminCourseType{{$course->id}}" class="pull-right control-label">@lang('Course Type :')</label>
                            </div>
                            <div class="col-sm-4">
                              <select style="width:100%" class="form-control" id="adminCourseType{{$course->id}}" name="type" required>
                                <option value="Compulsory">@lang('Compulsory')</option>
                                <option value="Elective">@lang('Elective')</option>
                              </select>
                            </div>  
                          </div>

                          <div class="row" style="margin-bottom:7px;">
                            <div class="col-sm-2">
                              <label for="adminCourseNextTerm{{$course->id}}" class="pull-right control-label">@lang('Next Offered :')</label>
                            </div>
                            <div class="col-sm-4">
                              <select style="width:100%" class="form-control" id="adminCourseNextOffered{{$course->id}}" name="next_offered" required>
                                <option value="{{'T1-'.date('Y')}}">{{ 'T1-'.date('Y')}}</option>
                                <option value="{{'T2-'.date('Y')}}">{{ 'T2-'.date('Y')}}</option>
                                <option value="{{'T1-'.(date('Y')+1)}}">{{ 'T1-'.(date('Y')+1)}}</option>
                                <option value="{{'T2-'.(date('Y')+1)}}">{{ 'T2-'.(date('Y')+1)}}</option>
                                <option value="TBA">@lang('TBA')</option>
                                <option value="Not offered">@lang('Not offered')</option>
                                <option value="No longer offered">@lang('No longer offered')</option>
                              </select>
                            </div>
                            <div class="col-sm-2">
                              <label for="adminCoursePrerequisite{{$course->id}}" class="pull-right control-label">@lang('Prerequisites :')</label>
                            </div>
                            <div class="col-sm-4">
                                <input style="width:100%" name="prerequisite" class="form-control" id="adminCoursePrerequisite{{$course->id}}" value="{{$course->prerequisite}}">
                            </div>
                          </div>

                          <div class="row" style="margin-bottom:7px;">
                            <div class="col-sm-2">
                              <label for="adminCourseTeacher{{$course->id}}" class="pull-right control-label">@lang('Tutor :')</label>
                            </div>
                            <div class="col-sm-4">
                              <select style="width:100%" class="form-control" id="adminCourseTeacher{{$course->id}}" name="teacher" required>
                                <option value="TBA">@lang('TBA')</option>
                                @foreach ($teachers as $t)
                                <option value="{{ucfirst($t->first_name).' '.ucfirst($t->last_name)}}" data-teacherid="{{$t->id}}">{{ucfirst($t->first_name).' '.ucfirst($t->last_name).' ('.ucfirst($t->programme->name).')'}}</option>
                                @endforeach
                              </select>
                              <input type="hidden" name="teacher_id" id="adminCourseTeacherId{{$course->id}}" required/>
                            </div>
                            <div class="col-sm-2">
                              <label for="adminCourseDescription{{$course->id}}" class="pull-right control-label">@lang('Description :')</label>
                            </div>
                            <div class="col-sm-4">
                              <textarea style="width:100%" class="form-control" name="description" rows="1" id="adminCourseDescription{{$course->id}}">{{$course->description}}</textarea>
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
              </td>

              <script>
                $(document).ready(function(){
                  $("#adminCourseLevel{{$course->id}}").val('{{ucfirst($course->level)}}');
                  $("#adminCourseType{{$course->id}}").val('{{ucfirst($course->type)}}');
                  $("#adminCourseCredit{{$course->id}}").val('{{ucfirst($course->credit)}}');
                  $("#adminCourseCurrentOffered{{$course->id}}").val('{{ucfirst($course->current_offered)}}');
                  $("#adminCourseNextOffered{{$course->id}}").val('{{ucfirst($course->next_offered)}}');
                  $("#adminCourseTeacher{{$course->id}}").val('{{ucfirst($course->teacher)}}');
                  $("#adminCourseTeacherId{{$course->id}}").val("{{$course->teacher_id}}");
                  $("#adminCourseCurrentOffered{{$course->id}}").change(function(){
                    let current_offered = $("#adminCourseCurrentOffered{{$course->id}}").val();
                    if (current_offered == 'No longer offered') {
                      $("#adminCourseNextOffered{{$course->id}}").val('No longer offered');
                      $("#adminCourseNextOffered{{$course->id}}").attr("disabled", "disabled");
                      $("#adminCourseTeacher{{$course->id}}").val('TBA');
                      $("#adminCourseTeacher{{$course->id}}").attr("disabled", "disabled");
                    }
                    else{
                      $("#adminCourseNextOffered{{$course->id}}").removeAttr("disabled"); 
                      $("#adminCourseTeacher{{$course->id}}").removeAttr('disabled');
                    }
                  });

                  $("#adminCourseTeacher{{$course->id}}").change(function(){
                    let current_teacher = $("#adminCourseTeacher{{$course->id}}").val() 
                    if (current_teacher== 'TBA'){
                      $("#adminCourseTeacherId{{$course->id}}").val(0);
                    }else{
                      let teacher_id = $("#adminCourseTeacher{{$course->id}} option:selected").data("teacherid");
                      // let teacher_id = $("#adminCourseTeacher{{$course->id}}").find("option:selected").data("teacherid");
                      $("#adminCourseTeacherId{{$course->id}}").val(teacher_id);
                    }
                  });
                });
              </script>
              @endif
                <td><small>{{$course->code}}</small></td>
                <td><small>{{$course->name}}</small></td>
                <td><small>{{ucfirst($course->level)}}</small></td>
                <td><small>{{$course->credit}}</small></td>
                <td><small>{{ucfirst($course->type)}}</small></td>
                <td class="@if ($course->current_offered == 'Not offered' || $course->current_offered == 'No longer offered') bg-secondary text-white @endif"><small>{{$course->current_offered}}</small></td>
                <td><small>{{$course->next_offered}}</small></td>
                <td><small>{{$course->prerequisite}}</small></td>
                <td><small>{{$course->teacher}}</small></td>
              </tr>
              
            @endforeach
          </tbody>
        </table>
        <!--endprint-->
      </div>
    </div>

    <script>
      $("#btnPrint{{$major->id}}").on("click", function () {
        var printWindow = window.open('', '', 'height=720,width=1280');
        printWindow.document.write('<html><head>');
        printWindow.document.write('<link href="{{url('css/app.css')}}" rel="stylesheet">');
        printWindow.document.write('</head><body>');
        printWindow.document.write('<div class="container"><div class="col-md-12" id="academic-part"><h2 style="text-align:center;">{{Auth::user()->school->name}}</h2><h4 style="text-align:center;">{{$major->qualification->name.' ('.$major->name.')'}}</h4><table style="text-align:left;border-collapse:collapse;border:1px solid black;"><thead><tr><th style="border: 1px solid black;"><small>@lang('Course Code')</small></th><th style="border: 1px solid black;"><small>@lang('Course Name')</small></th><th style="border: 1px solid black;"><small>@lang('Course Level')</small></th><th style="border: 1px solid black;"><small>@lang('Course Type')</small></th><th style="border: 1px solid black;"><small>@lang('Credits')</small></th><th style="border: 1px solid black;"><small>@lang('Current Offered')</small></th><th style="border: 1px solid black;"><small>@lang('Next Offered')</small></th><th style="border: 1px solid black;"><small>@lang('Prerequisites')</small></th><th style="border: 1px solid black;"><small>@lang('Tutor')</small></th></tr></thead><tbody>@foreach ($major->courses as $course)<tr><td style="border: 1px solid black;"><small>{{$course->code}}</small></td><td style="border: 1px solid black;"><small>{{$course->name}}</small></td><td style="border: 1px solid black;"><small>{{ucfirst($course->level)}}</small></td><td style="border: 1px solid black;"><small>{{$course->credit}}</small></td><td style="border: 1px solid black;"><small>{{ucfirst($course->type)}}</small></td><td  style="border: 1px solid black;" class="@if ($course->current_offered == 'Not offered' || $course->current_offered == 'No longer offered') bg-secondary text-white @endif"><small>{{$course->current_offered}}</small></td><td style="border: 1px solid black;"><small>{{$course->next_offered}}</small></td><td style="border: 1px solid black;"><small>{{$course->prerequisite}}</small></td><td style="border: 1px solid black;"><small>{{$course->teacher}}</small></td></tr>@endforeach</tbody></table></div></div>');
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
      });

      // function doPrint() {   
      //   bdhtml=window.document.body.innerHTML;   
      //   sprnstr="<!--startprint-->";   
      //   eprnstr="<!--endprint-->";   
      //   prnhtml=bdhtml.substr(bdhtml.indexOf(sprnstr)+17);   
      //   prnhtml=prnhtml.substring(0,prnhtml.indexOf(eprnstr));   
      //   window.document.body.innerHTML=prnhtml;  
      //   window.print();   
      // }
    </script>

  @endforeach
</div>

<a href="{{url()->previous()}}" class="btn btn-xs btn-warning"><i class="material-icons">keyboard_return</i> @lang('Go Back')</a>