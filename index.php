<html>
<head>

    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <script type="text/javascript" src="javascript/jQuery-2.1.4.min.js"></script>
    <script type="text/javascript" src="javascript/validate.js"></script>
    <script type="text/javascript" src="javascript/bootstrap.min.js"></script>
</head>

  <body>

        <div class = "page-header" style="background-color:antiquewhite; margin-top:-40px; padding:20px">

          <br><br>
         <h3 style="margin-left:530px">

            Scheduling Simulator

         </h3>

      </div>

      <div class="container">

        <form id="jobsDataForm">

              <!-- <div class="container"> -->
                  <div class="schedulingType" id="schedulingType">
                    <div class="form-group">
                    <div class="row">
                      <!-- <div class="col-md-12"> -->
                      <div class="col-md-12">

                        <div class="col-md-3">
                          <label for="Types of Scheduling">Type of Scheduling: &nbsp</label>
                        </div>

                        <div class="radio">

                          <div class="col-md-2">

                            <label  class="radio-inline" for="NonRTS"><input type="radio" class="radioForTypes" name="schedulingType" value="NonRTS"><b>Non Real Time</b></label>

                          </div>
                          <div class="col-md-2">

                            <label  class="radio-inline" for="RTS"><input type="radio" name="schedulingType" class="radioForTypes" value="RTS"><b>Real Time</b></label>

                          </div>
                          <div class="col-md-3">
                            <label  class="radio-inline" for="RTS"><input type="radio" name="schedulingType" class="radioForTypes" value="MultiProcessorRTS"><b>Multiprocessor Real Time</b></label>

                          </div>

                        </div>
                      </div>

                        </div>
                        <!-- </div> -->
                      </div>
                      <br><br>
                    </div>

                <!-- </div> -->

                <div class="Algos" id="Algos">
                  <div class="form-group">

                    <div class="row">
                        <div class="col-md-12">

                          <div class="col-md-3">
                            <label for="Scheduling Types">Select a scheduling Algorithm: &nbsp</label>
                          </div>

                          <div class="col-md-3">

                            <select class="form-control" id="selectAlgo" name="selectAlgo">
                                <option value="0" selected>Select an Algorithm</option>
                            </select>

                            <br><br>
                          </div>

                        </div>
                    </div>

                  </div>
                </div>

                <div class="Nodes" id="Nodes">
                    <div class="row">

                        <div class="form-group">

                            <div class="col-md-12">


                              <div class="col-md-3">

                                <label for="noOfNodes">No of Processors (Nodes) : &nbsp</label>

                              </div>

                              <div class="col-md-1">

                                <input type="number" class="form-control" min="1" max="50" name="noOfNodes" id="noOfNodes"/>

                              </div>

                            </div>


                        </div>

                    </div>
                    <br><br>
                </div>

                <div class="jobs" id="jobs">
                    <div class="row">

                        <div class="form-group">

                            <div class="col-md-12">

                              <div class="col-md-3">

                                <label for="Number of Jobs">No of Tasks : &nbsp</label>

                              </div>

                              <div class="col-md-1">

                                <input type="number" class="form-control" min="1" max="50" name="noOfJobs" id="noOfJobs"/>

                              </div>

                              <div class="col-md-2">
                                  <button type="button" class = "btn btn-primary" id="addTasks">Add Tasks</button>
                              </div>

                            </div>

                            <br><br>
                        </div>

                    </div>
                </div>


                <!-- <div class="jobs" id="jobs">
                  <label for="Number of Jobs">No of Jobs: &nbsp </label>
                    <input type="text" id="noOfJobs" name="noOfJobs"/>

                </div> -->

                <div class="jobsData" id="jobsData">

                  <div class="row">

                      <div class="form-group" id="jobsDetails">


                      </div>

                  </div>

                </div>

                <div class="submitBtn">
                  <br><br>
                  <button type = "button" class = "btn btn-primary" id="submitBtn">Submit</button>
                  <br><br>

                </div>

                <div class="chart" id="chart" style="min-height:500px; weight: 1200px; margin-left:100px; margin-right:100px; padding:4px">

                    <div class="OutputDescription" id="OutputDescription">

                      <span style="background-color:blue;padding:8px;padding-bottom:0px;padding-top:0px"></span>&nbsp <span><b>Represents task is being executed </b></span>
                      &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                      <span style="background-color:antiquewhite;padding:8px;padding-bottom:0px;padding-top:0px"></span>&nbsp <span><b>Represents task/next task has not arrived </b></span>
                      <br><br>
                      <span>| </span> &nbsp <span><b>Represents Delimeter between two time unit</b></span>
                        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                      <span>|| </span> &nbsp <span><b>Represents Task has arrived</b></span>

                      <br><br>

                      <h3>Output: </h3>
                      <br>

                    </div>

                </div>
              </div>
        </form>

      </div>
      <script type="text/javascript">

        $(document).ready(function(){

          $("#OutputDescription").hide();

          var algo = '';

          var schedulingType = '';

          $("#Nodes").hide();

          // On Change Of Radio Buttons\

          $("input[name='schedulingType']").change(function(){


            $("#OutputDescription").hide();

            $(".divEle").remove();

            $("#chart>br").remove();

            $(".processHeading").remove();

            $(".executeBox").remove();

            $(".pipeBox").remove();

            $(".plainBox").remove();

            schedulingType = $("input[name='schedulingType']:checked").val();

              $(".dynamicOptions").remove();

              var options = '';

             if ($("input[name='schedulingType']:checked").val() == 'NonRTS') {

                $("#Nodes").hide();

                options = '<option value="FCFS" class="dynamicOptions">FCFS</option>' + '<option value="preempSJF" class="dynamicOptions">Preemptive Shortest Job First</option>' + '<option value="nonPreempSJF" class="dynamicOptions">Non Preemptive Shortest Job First</option>' + '<option value="RR" class="dynamicOptions">Round Robin</option>';

             }
             else if($("input[name='schedulingType']:checked").val() == 'RTS'){

                $("#Nodes").hide();

                options = '<option value="EDF" class="dynamicOptions">Earliest Deadline First</option>' + '<option value="RM" class="dynamicOptions">Rate Monotonic</option>' + '<option value="DM" class="dynamicOptions">Deadline Monotic</option>' + '<option value="LST" class="dynamicOptions">Least Slack Time First</option>';
             }

             else if($("input[name='schedulingType']:checked").val() == 'MultiProcessorRTS')
             {
                options = '<option value="MultiEDF" class="dynamicOptions">Earliest Deadline First</option>' + '<option value="MultiRM" class="dynamicOptions">Rate Monotonic</option>';
                $("#Nodes").show();
             }

             $("#selectAlgo").append(options);

         });

         $("#selectAlgo").change(function(){

           $(".divEle").remove();

           $("#chart>br").remove();

           $(".processHeading").remove();

           $(".executeBox").remove();

           $(".pipeBox").remove();

           $(".plainBox").remove();

           $(".newElements").remove();

           $("#noOfJobs").text("");
         });


         //No of Jobs entries.

         $("#addTasks").click(function(e){

           e.preventDefault();

         });

  $("#noOfJobs").change(function(){

        $(".divEle").remove();

        $("#chart>br").remove();

        $(".processHeading").remove();

        $(".executeBox").remove();

        $(".pipeBox").remove();

        $(".plainBox").remove();

        $(".newElements").remove();

        var noOfJobs = $("#noOfJobs").val();

        var selectAlgo = $("#selectAlgo").val();

        var i;

        if(schedulingType == 'NonRTS')
        {

              if(selectAlgo == "RR")
              {
                var a = "";

                var divEle = "<div class='col-md-12 divEle'>";

                var timeSliceLabel = "<div class='col-md-3'> <label for='TimeSlice' class='newElements'>Time Slice: </label></div>";

                var timeSliceInput = "<div class='col-md-1'><input type='number' min='1' max='50' id='TimeSlice' name='TimeSlice' class='newElements form-control' data-input/> </div></div>";

                a = a + divEle + timeSliceLabel + timeSliceInput;

                $("#jobsDetails").append("<br class='newElements'><br class='newElements'>");

                $("#jobsDetails").append(a);
              }

              for(i=1;i<=noOfJobs;i++)
              {


                var html = "<br class='newElements'><br class='newElements'>";

                //var divEle = "<div></div>";
                var divEle = "<div class='col-md-12 divEle'><div class='col-md-1'></div> <div class='col-md-1'><label for='Tasks'>"+"Task "+i+"</label></div>";

                var arrivalLabel = "<div class='col-md-2'> <label for='Arrival' class='newElements'>Arrival Time: </label>";

                var executionLabel = "<div class='col-md-2'> <label for='Execution' class='newElements'>Execution Time: </label>";

              //  var periodLabel = "<div> <label for='Period' class='newElements'>Period: </label> <span class='newElements'>&nbsp</span>";

                var arrivalInput = "<input type='number' min='1' max='50' id='Arrival"+i+"'"+ "name='Arrival"+i+"' class='newElements form-control' data-input/> </div>";

                var executionInput = "<input type='number' min='1' max='50' id='Finish"+i+"'"+ "name='Finish"+i+"' class='newElements form-control' data-input/> </div></div>";

              //  var periodInput = "<input type='number' id='Period"+i+"'"+ "name='Period"+i+"' class='newElements' data-input/> <span class='newElements'>&nbsp</span> </div>";

                html = html + divEle + arrivalLabel + arrivalInput + executionLabel + executionInput;

                $("#jobsDetails").append("<br class='newElements'><br class='newElements'>");

                $("#jobsDetails").append(html);
              }

        }else if(schedulingType == 'RTS')
        {
              if(selectAlgo == 'EDF')
              {
                  for(i=1;i<=noOfJobs;i++)
                  {


                        var html = "<br class='newElements'><br class='newElements'>";

                        var divEle = "<div class='col-md-12 divEle'><div class='col-md-1'></div> <div class='col-md-1'><label for='Tasks'>"+"Task "+i+"</label></div>";

                        var arrivalLabel = "<div class='col-md-2'> <label for='Arrival' class='newElements'>Arrival Time: </label>";

                        var executionLabel = "<div class='col-md-2'> <label for='Execution' class='newElements'>Execution Time: </label>";

                        var deadlineLabel = "<div class='col-md-2'> <label for='Deadline' class='newElements'>Deadline: </label>";

                        var arrivalInput = "<input type='number' min='1' max='50' id='Arrival"+i+"'"+ "name='Arrival"+i+"' class='newElements form-control' data-input/> </div>";

                        var executionInput = "<input type='number' min='1' max='50' id='Finish"+i+"'"+ "name='Finish"+i+"' class='newElements form-control' data-input/> </div>";

                        var deadlineInput = "<input type='number' min='1' max='50' id='Deadline"+i+"'"+ "name='Deadline"+i+"' class='newElements form-control' data-input/> </div></div>";

                        html = html + divEle + arrivalLabel + arrivalInput + executionLabel + executionInput + deadlineLabel + deadlineInput;

                        $("#jobsDetails").append("<br class='newElements'><br class='newElements'>");

                        $("#jobsDetails").append(html);

                  }
              }

              else if (selectAlgo == 'RM')
              {
                for(i=1;i<=noOfJobs;i++)
                {

                  var html = "<br class='newElements'><br class='newElements'>";

                  var divEle = "<div class='col-md-12'><div class='col-md-1'></div> <div class='col-md-1'><label for='Tasks'>"+"Task "+i+"</label></div>";

                  var arrivalLabel = "<div class='col-md-2'> <label for='Arrival' class='newElements'>Arrival Time: </label>";

                  var executionLabel = "<div class='col-md-2'> <label for='Execution' class='newElements'>Execution Time: </label>";

                  var periodLabel = "<div class='col-md-2'> <label for='Period' class='newElements'>Period: </label>";

                  var arrivalInput = "<input type='number' min='1' max='50' id='Arrival"+i+"'"+ "name='Arrival"+i+"' class='newElements form-control' data-input/> </div>";

                  var executionInput = "<input type='number' min='1' max='50' id='Finish"+i+"'"+ "name='Finish"+i+"' class='newElements form-control' data-input/> </div>";

                  var periodInput = "<input type='number' min='1' max='50' id='Period"+i+"'"+ "name='Period"+i+"' class='newElements form-control' data-input/> </div></div>";

                  html = html + divEle + arrivalLabel + arrivalInput + executionLabel + executionInput + periodLabel + periodInput;

                  $("#jobsDetails").append("<br class='newElements'><br class='newElements'>");

                  $("#jobsDetails").append(html);
                }

              }

              else if (selectAlgo == 'DM')
              {
                for(i=1;i<=noOfJobs;i++)
                {

                  var html = "<br class='newElements'><br class='newElements'>";

                  var divEle = "<div class='col-md-12'><div class='col-md-1'></div> <div class='col-md-1'><label for='Tasks'>"+"Task "+i+"</label></div>";

                  var arrivalLabel = "<div class='col-md-2'> <label for='Arrival' class='newElements'>Arrival Time: </label>";

                  var executionLabel = "<div class='col-md-2'> <label for='Execution' class='newElements'>Execution Time: </label>";

                  var periodLabel = "<div class='col-md-2'> <label for='Period' class='newElements'>Period: </label>";

                  var deadlineLabel = "<div class='col-md-2'> <label for='Deadline' class='newElements'>Deadline: </label>";

                  var arrivalInput = "<input type='number' min='1' max='50' id='Arrival"+i+"'"+ "name='Arrival"+i+"' class='newElements form-control' data-input/> </div>";

                  var executionInput = "<input type='number' min='1' max='50' id='Finish"+i+"'"+ "name='Finish"+i+"' class='newElements form-control' data-input/> </div>";

                  var periodInput = "<input type='number' min='1' max='50' id='Period"+i+"'"+ "name='Period"+i+"' class='newElements form-control' data-input/> </div>";

                  var deadlineInput = "<input type='number' min='1' max='50' id='Deadline"+i+"'"+ "name='Deadline"+i+"' class='newElements form-control' data-input/> </div>";

                  html = html + divEle + arrivalLabel + arrivalInput + periodLabel + periodInput + executionLabel + executionInput + deadlineLabel + deadlineInput;

                  $("#jobsDetails").append("<br class='newElements'><br class='newElements'>");

                  $("#jobsDetails").append(html);
                }

              }

              else if (selectAlgo == 'LST')
              {
                  for(i=1;i<=noOfJobs;i++)
                  {


                        var html = "<br class='newElements'><br class='newElements'>";

                        var divEle = "<div class='col-md-12'><div class='col-md-1'></div> <div class='col-md-1'><label for='Tasks'>"+"Task "+i+"</label></div>";

                        var arrivalLabel = "<div class='col-md-2'> <label for='Arrival' class='newElements'>Arrival Time: </label>";

                        var executionLabel = "<div class='col-md-2'> <label for='Execution' class='newElements'>Execution Time: </label>";

                        var deadlineLabel = "<div class='col-md-2'> <label for='Deadline' class='newElements'>Deadline: </label>";

                        var arrivalInput = "<input type='number' min='1' max='50' id='Arrival"+i+"'"+ "name='Arrival"+i+"' class='newElements form-control' data-input/> </div>";

                        var executionInput = "<input type='number' min='1' max='50' id='Finish"+i+"'"+ "name='Finish"+i+"' class='newElements form-control' data-input/> </div>";

                        var deadlineInput = "<input type='number' min='1' max='50' id='Deadline"+i+"'"+ "name='Deadline"+i+"' class='newElements form-control' data-input/> </div>";

                        html = html + divEle + arrivalLabel + arrivalInput + executionLabel + executionInput + deadlineLabel + deadlineInput;

                        $("#jobsDetails").append("<br class='newElements'><br class='newElements'>");

                        $("#jobsDetails").append(html);
                  }
              }

        }else if(schedulingType == 'MultiProcessorRTS')
        {

              if(selectAlgo == 'MultiEDF')
              {
                  for(i=1;i<=noOfJobs;i++)
                  {

                        var html = "<br class='newElements'><br class='newElements'>";

                        var divEle = "<div class='col-md-12'><div class='col-md-1'></div> <div class='col-md-1'><label for='Tasks'>"+"Task "+i+"</label></div>";

                        var arrivalLabel = "<div class='col-md-2'> <label for='Arrival' class='newElements'>Arrival Time: </label>";

                        var executionLabel = "<div class='col-md-2'> <label for='Execution' class='newElements'>Execution Time: </label>";

                        var deadlineLabel = "<div class='col-md-2'> <label for='Deadline' class='newElements'>Deadline: </label>";

                        var arrivalInput = "<input type='number' min='1' max='50' id='Arrival"+i+"'"+ "name='Arrival"+i+"' class='newElements  form-control' data-input/> </div>";

                        var executionInput = "<input type='number' min='1' max='50' id='Finish"+i+"'"+ "name='Finish"+i+"' class='newElements  form-control' data-input/> </div>";

                        var deadlineInput = "<input type='number' min='1' max='50' id='Deadline"+i+"'"+ "name='Deadline"+i+"' class='newElements  form-control' data-input/> </div>";

                        html = html + divEle + arrivalLabel + arrivalInput + executionLabel + executionInput + deadlineLabel + deadlineInput;

                        $("#jobsDetails").append("<br class='newElements'><br class='newElements'>");

                        $("#jobsDetails").append(html);
                  }
              }

              else if (selectAlgo == 'MultiRM')
              {
                for(i=1;i<=noOfJobs;i++)
                {

                  var html = "<br class='newElements'><br class='newElements'>";

                  var divEle = "<div class='col-md-12'><div class='col-md-1'></div> <div class='col-md-1'><label for='Tasks'>"+"Task "+i+"</label></div>";

                  var arrivalLabel = "<div class='col-md-2'> <label for='Arrival' class='newElements'>Arrival Time: </label> ";

                  var executionLabel = "<div class='col-md-2'> <label for='Execution' class='newElements'>Execution Time: </label> ";

                  var periodLabel = "<div class='col-md-2'> <label for='Period' class='newElements'>Period: </label> ";

                  var arrivalInput = "<input type='number' min='1' max='50' id='Arrival"+i+"'"+ "name='Arrival"+i+"' class='newElements form-control' data-input/> </div>";

                  var executionInput = "<input type='number' min='1' max='50' id='Finish"+i+"'"+ "name='Finish"+i+"' class='newElements form-control' data-input/> </div>";

                  var periodInput = "<input type='number' min='1' max='50' id='Period"+i+"'"+ "name='Period"+i+"' class='newElements form-control' data-input/> </div>";

                  html = html + divEle + arrivalLabel + arrivalInput + executionLabel + executionInput + periodLabel + periodInput;

                  $("#jobsDetails").append("<br class='newElements'><br class='newElements'>");

                  $("#jobsDetails").append(html);
                }

              }

        }


      });

          $("#submitBtn").click(function(e){


            var noOfJobs = $("#noOfJobs").val();

            var selectAlgo = $("#selectAlgo").val();



            var result = true;

            for(i=1; i<=noOfJobs; i++)
            {

              if(selectAlgo == "RM" || selectAlgo == "LST" || selectAlgo == "MultiRM")
              {

                console.log(result);
                var executionTime = Number($("#Finish"+i).val());
                var period = Number($("#Period"+i).val());



                if(executionTime > period)
                {
                  console.log(result);
                  console.log(i);
                  result = false;
                }
              }
              else if(selectAlgo == "EDF" || selectAlgo == "DM" || selectAlgo == "MultiEDF")
              {
                console.log(result);

                var executionTime = Number($("#Finish"+i).val());
                var deadline = Number($("#Deadline"+i).val());

                console.log(executionTime + " " +deadline);

                if(executionTime > deadline)
                {
                  console.log(result);
                  console.log("false");
                  result = false;
                }
              }
            }



            if(result == false)
            {

              alert("Execution time cannot be greater than period/Deadline. Please Check it.");
            }
            else
            {

                          $("#OutputDescription").show();

                          $("#chart>br").remove();

                          $(".processHeading").remove();

                          $(".executeBox").remove();

                          $(".pipeBox").remove();

                          $(".plainBox").remove();

                          e.preventDefault();

                          var isFormValid = validate($("#jobsDataForm"));

                          if(isFormValid)
                          {
                            $.post("scripts/dataInput.php",$("#jobsDataForm").serialize(),function(response){

                              if(response.status)
                              {
                                    $("#OutputDescription").show();

                                      if(schedulingType == "RTS")
                                      {
                                            var output = response.output;

                                            var utilization = output[0];

                                            if(output[1] == "Not Schedulable")
                                            {

                                              var selectAlgo = $("#selectAlgo").val();

                                              if(selectAlgo == "RM")
                                              {


                                                var h4 = "<h4 class='processHeading'>"+output[1]+"</h4>";

                                                $("#chart").append(h4);

                                                $("#chart").append("<br>");
                                              }
                                              else
                                              {

                                                if(utilization > 1)
                                                {
                                                  var h4 = "<h4 class='processHeading'>"+"Tasks are not schedulable as utilization = "+utilization+"</h4>";

                                                  $("#chart").append(h4);

                                                  $("#chart").append("<br>");

                                                }
                                              }

                                            }
                                            else
                                            {
                                                if(utilization > 1)
                                                {

                                                  var h4 = "<h4 class='processHeading'>"+"Tasks are not schedulable as utilization = "+utilization+"</h4>";

                                                  $("#chart").append(h4);

                                                  $("#chart").append("<br>");

                                                }

                                                for(var i=1;i<output.length;i++)
                                                {

                                                  var demo = output[i];

                                                  if(demo.substr(0,1) == "#" || demo.substr(0,1) == "|" || demo.substr(0,1) == "_" || demo.substr(0,1) == "*")
                                                  {

                                                          var h4 = "<h4 class='processHeading'>"+"Task "+(i-1)+":</h4>";

                                                          $("#chart").append(h4);

                                                          console.log(demo);

                                                          var j = 0;
                                                          var limit = 35;

                                                          while(j<demo.length)
                                                          {

                                                            if(demo[j] == "#" || demo[j] == "*")
                                                            {

                                                              var executeBox = $("<span class='executeBox'></span>").attr("id",j+1).css({"background-color":"blue","border":"1px black","padding":"10px"});
                                                              var pipe = $("<span class='pipeBox'>|</span>").attr("id",j+1);
                                                              var arrivalPipe = $("<span class='pipeBox'><b>|</b></span>").attr("id",j+1);

                                                              if(demo[j] == "#")
                                                              {
                                                                $("#chart").append(arrivalPipe);
                                                              }

                                                                $("#chart").append(pipe);
                                                                $("#chart").append(executeBox);

                                                            }
                                                            else if(demo[j] == "_" || demo[j] == "|")
                                                            {
                                                              var plainBox = $("<span class='plainBox'></span>").attr("id",j+1).css({"background-color":"antiquewhite","padding":"10px"});
                                                              var pipe = $("<span class='pipeBox'>|</span>").attr("id",j+1);
                                                              var arrivalPipe = $("<span class='pipeBox'><b>|</b></span>").attr("id",j+1);

                                                              if(demo[j] == "|")
                                                              {
                                                                $("#chart").append(arrivalPipe);
                                                              }
                                                                $("#chart").append(pipe);
                                                                $("#chart").append(plainBox);

                                                            }

                                                            j++;

                                                            if(j >= limit)
                                                            {
                                                              limit = limit+35;
                                                              $("#chart").append("<br><br><br>");
                                                            }
                                                          }

                                                          $("#chart").append('<br><br><br>');
                                                  }
                                                  else
                                                  {
                                                    var h4 = "<h4 class='processHeading'>"+"Hyperperiod = "+demo+"</h4>";

                                                    $("#chart").append(h4);

                                                    $("#chart").append("<br>");

                                                  }

                                                }
                                            }
                                      }

                                      else if (schedulingType == "MultiProcessorRTS")
                                      {
                                          var output = response.output;

                                          console.log(output);

                                          var outputLength = output.length;

                                          for(i=1;i<outputLength;i++)
                                          {

                                            var demo = output[i];

                                            if(demo.substr(0,7) == "Process")
                                            {
                                              var h4 = "<h4 class='processHeading'>"+demo+":</h4>";

                                              $("#chart").append(h4);

                                              $("#chart").append("<br>");

                                            }

                                           else if(demo.substr(0,4) == "Task")
                                            {
                                              var h5 = "<h5 class='processHeading'>"+demo+":</h5>";

                                              $("#chart").append(h5);

                                            }

                                            else if(demo.substr(0,1) == "#" || demo.substr(0,1) == "|" || demo.substr(0,1) == "_" || demo.substr(0,1) == "*")
                                            {

                                              var j = 0;
                                              var limit = 35;

                                              while(j<demo.length)
                                              {


                                                if(demo[j] == "#" || demo[j] == "*")
                                                {

                                                  var executeBox = $("<span class='executeBox'></span>").attr("id",j+1).css({"background-color":"blue","border":"1px black","padding":"10px"});
                                                  var pipe = $("<span class='pipeBox'>|</span>").attr("id",j+1);
                                                  var arrivalPipe = $("<span class='pipeBox'><b>|</b></span>").attr("id",j+1);

                                                  if(demo[j] == "#")
                                                  {
                                                    $("#chart").append(arrivalPipe);
                                                  }

                                                    $("#chart").append(pipe);
                                                    $("#chart").append(executeBox);

                                                }
                                                else if(demo[j] == "_" || demo[j] == "|")
                                                {
                                                  var plainBox = $("<span class='plainBox'></span>").attr("id",j+1).css({"background-color":"antiquewhite","padding":"10px"});
                                                  var pipe = $("<span class='pipeBox'>|</span>").attr("id",j+1);
                                                  var arrivalPipe = $("<span class='pipeBox'><b>|</b></span>").attr("id",j+1);

                                                  if(demo[j] == "|")
                                                  {
                                                    $("#chart").append(arrivalPipe);
                                                  }
                                                    $("#chart").append(pipe);
                                                    $("#chart").append(plainBox);

                                                }

                                                j++;

                                                if(j >= limit)
                                                {
                                                  limit = limit+35;
                                                  $("#chart").append("<br><br><br>");
                                                }
                                              }

                                              $("#chart").append('<br><br><br>');

                                            }
                                            else
                                              {
                                                var h4 = "<h4 class='processHeading'>"+"Hyperperiod = "+demo+"</h4>";

                                                $("#chart").append(h4);

                                                $("#chart").append("<br>");

                                              }




                                          }

                                        }

                                        else if (schedulingType == "NonRTS")
                                        {

                                          var output = response.output;

                                          console.log(output);

                                          for(var i=0;i<output.length;i++)
                                          {
                                            var demo = output[i];

                                            if(demo.substr(0,3) == "Res")
                                            {
                                              var h4 = "<h4 class='processHeading'>"+demo+"</h4>";

                                              $("#chart").append(h4);

                                              $("#chart").append("<br>");

                                            }
                                            else
                                            {
                                              var h4 = "<h4 class='processHeading'>"+"Task "+(i+1)+":</h4>";

                                              $("#chart").append(h4);


                                              var demo = output[i];
                                              console.log(demo);

                                              var j = 0;
                                              var limit = 35;


                                              while(j<demo.length)
                                              {

                                                if(demo[j] == "#" || demo[j] == "*")
                                                {

                                                  var executeBox = $("<span class='executeBox'></span>").attr("id",j+1).css({"background-color":"blue","border":"1px black","padding":"10px"});
                                                  var pipe = $("<span class='pipeBox'>|</span>").attr("id",j+1);
                                                  var arrivalPipe = $("<span class='pipeBox'><b>|</b></span>").attr("id",j+1);

                                                  if(demo[j] == "#")
                                                  {
                                                    $("#chart").append(arrivalPipe);
                                                  }

                                                    $("#chart").append(pipe);
                                                    $("#chart").append(executeBox);

                                                }
                                                else if(demo[j] == "_" || demo[j] == "|")
                                                {
                                                  var plainBox = $("<span class='plainBox'></span>").attr("id",j+1).css({"background-color":"antiquewhite","padding":"10px"});
                                                  var pipe = $("<span class='pipeBox'>|</span>").attr("id",j+1);
                                                  var arrivalPipe = $("<span class='pipeBox'><b>|</b></span>").attr("id",j+1);

                                                  if(demo[j] == "|")
                                                  {
                                                    $("#chart").append(arrivalPipe);
                                                  }
                                                    $("#chart").append(pipe);
                                                    $("#chart").append(plainBox);

                                                }

                                                j++;

                                                if(j >= limit)
                                                {
                                                  limit = limit+35;
                                                  $("#chart").append("<br><br><br>");
                                                }
                                              }

                                              $("#chart").append('<br><br><br>');
                                            }



                                          }
                                        }

                              }

                        });
                      }
            }

        });

});

      </script>
  </body>
</html>
