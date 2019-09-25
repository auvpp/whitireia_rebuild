<div class="panel panel-default">
  @foreach ($myclasses as $c)
    <div class="page-panel-title" role="tab" id="heading{{$c->code}}">
      <a class="panel-title collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$c->code}}" aria-expanded="false" aria-controls="collapse{{$c->code}}">
        <h5>
          {{$c->code.' - '.$c->name}}<span class="pull-right"><small>@lang('Click to view all students under this course') <i class="material-icons">keyboard_arrow_down</i></small></span>
        </h5>
      </a>
    </div>
    <div id="collapse{{$c->code}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$c->code}}">
      <div class="panel-body table-responsive">
        <table class="table table-bordered table-striped table-data-div table-hover table-condensed"> 
                <tr class="bg-success text-white">
                    <th scope="col">#</th>
                    <th scope="col">@lang('Code')</th>
                    <th scope="col">@lang('First Name')</th>
                    <th scope="col">@lang('Last Name')</th>
                    <th scope="col">@lang('Grade')</th>
                    <th scope="col">@lang('Credits')</th>
                    <th scope="col">@lang('Action')</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($mystudents as $s)
                @if ($c->code == $s->code)
                    @foreach ($s->classdetails as $d)
                        <tr>
                            <td scope="row"><b id="sign{{$d->user->id.$s->code}}" class="text-danger"></b></td>
                            <td scope="row"><small>{{$d->user->code}}</small></td>
                            <td scope="row"><small>{{ucfirst($d->user->first_name)}}</small></td>
                            <td scope="row"><small>{{ucfirst($d->user->last_name)}}</small></td>
                            <td scope="row">
                                <select name="grade_id{{$d->user->id.$s->code}}" id="grade{{$d->user->id.$s->code}}">
                                    @foreach ($grades as $grade)
                                        <option value="{{$grade->id}}">{{$grade->grade}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td scope="row">
                                <select name="approved_credit{{$d->user->id.$s->code}}" id="approved_credit{{$d->user->id.$s->code}}">
                                    <option value="{{$c->credit}}" selected>{{$c->credit}}</option>
                                    <option value="0">0</option>      
                                </select>
                            </td>
                            <input type="hidden" id="classdetail{{$d->user->id.$s->code}}" value="{{$d->id}}"/>
                            <td scope="row"><button id="save{{$d->user->id.$s->code}}" class="btn btn-xs btn-danger">Save</button></td>
                        </tr>

                        <script>
                            $(document).ready(function(){
                                $("#grade{{$d->user->id.$s->code}}").change(function(){
                                    let current_grade = $("#grade{{$d->user->id.$s->code}} option:selected").text();
                                    if (current_grade == 'D' || current_grade == 'F'){
                                        $("#approved_credit{{$d->user->id.$s->code}}").val(0);
                                    }else{
                                        $("#approved_credit{{$d->user->id.$s->code}}").val('{{$c->credit}}');
                                    }
                                });

                                $("#save{{$d->user->id.$s->code}}").click(function() {         
                                    let classdetail_id = $("#classdetail{{$d->user->id.$s->code}}").val();
                                    let approved_credit = $("#approved_credit{{$d->user->id.$s->code}}").val();
                                    let grade_id = $("#grade{{$d->user->id.$s->code}}").val();
                                    $.ajax({
                                        type: 'POST',
                                        url: '/tcourses',
                                        
                                        // if we use ajax in Laravel, this headers must be put in here, and 
                                        // put <meta name="csrf-token" content="{{ csrf_token() }}"> in the html head
                                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                                        data: { "classdetail_id" : classdetail_id, 
                                                "approved_credit" : approved_credit, 
                                                "grade_id" : grade_id },
                                        success: function(data){
                                            if(data.success){
                                                $("#sign{{$d->user->id.$s->code}}").html("Saved");
                                            }
                                            else{
                                                $("#sign{{$d->user->id.$s->code}}").html("Failed");
                                            }
                                        }
                                    });
                                });

                            });
                        </script>
                    @endforeach
                @endif
            @endforeach
            </tbody>
        </table>
      </div>
    </div>
    <br>
  @endforeach
</div>

<a href="{{url()->previous()}}" class="btn btn-xs btn-warning"><i class="material-icons">keyboard_return</i> @lang('Go Back')</a>