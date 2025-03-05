@extends('user/include.layout')

@section('content')
@include('user.AEPS.navbar')
<style>
    /* Loader overlay styles */
    #loadingOverlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);  /* Dark background with some opacity */
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;  /* Ensure it's above all other content */
    color: white;
}

.loader {
    border: 8px solid #f3f3f3;  /* Light gray background */
    border-top: 8px solid #3498db;  /* Blue color for the spinning part */
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}


    /* Prevent interactions while loader is active */
    body.loading {
        overflow: hidden;
    }

    body.loading * {
        pointer-events: none;
    }
    </style>

<div class="card col-md-6 mx-auto shadow-lg border-0 loading mt-3">
    <div id="loadingOverlay">
        <div class="loader"></div>
    </div>
    <div class="card-header">
        <h4 class="card-heading mb-0">Daily Login Form</h4>
    </div>
    <div class="card-body p-4">
        <form action="{{route('outlet-login/aeps.store')}}" method="POST">
            @csrf
            
            <!-- Type -->
            <div class="form-group mb-3">
                <label for="type" class="form-label">Type</label>
                <input type="text" class="form-control" name="type" id="type" value="DAILY_LOGIN" readonly required>
            </div>
            <div class="form-group mb-3">
                <label for="encryptedAadhaar" class="form-label">Aadhaar</label>
                <input type="text" class="form-control" value="{{session('adhar_no')}}" name="aadhaar" id="encryptedAadhaar" required>
            </div>
            
            <!-- Latitude -->
            
                <input type="text" class="form-control"hidden name="latitude" id="latitude" readonly required>
          
            
            <!-- Longitude -->
           
                
                <input type="text" class="form-control"  hidden name="longitude" id="longitude" readonly required>
                <textarea id="txtBiometricData" hidden name="biometricData" rows="10" cols="50" placeholder="Biometric Data will appear here"></textarea>
            
            {{-- <!-- External Reference -->
            <div class="form-group mb-3">
                <label for="externalRef" class="form-label">External Reference</label>
                <input type="text" class="form-control"  name="externalRef" id="externalRef" required>
            </div> --}}
            
            <!-- Biometric Data -->
            {{-- <h5 class="text-info mb-3">Biometric Data</h5>
            <div class="form-group mb-3">
                <label for="encryptedAadhaar" class="form-label">Encrypted Aadhaar</label>
                <input type="text" class="form-control" name="biometricData[encryptedAadhaar]" id="encryptedAadhaar" required>
            </div>
            <div class="form-group mb-3">
                <label for="dc" class="form-label">Device Code (DC)</label>
                <input type="text" class="form-control" name="biometricData[dc]" id="dc" required>
            </div>
            <div class="form-group mb-3">
                <label for="ci" class="form-label">Certificate Identifier (CI)</label>
                <input type="text" class="form-control" name="biometricData[ci]" id="ci" required>
            </div>
            <div class="form-group mb-3">
                <label for="hmac" class="form-label">HMAC</label>
                <input type="text" class="form-control" name="biometricData[hmac]" id="hmac" required>
            </div>
            <div class="form-group mb-3">
                <label for="dpId" class="form-label">Device Provider ID</label>
                <input type="text" class="form-control" name="biometricData[dpId]" id="dpId" required>
            </div>
            <div class="form-group mb-3">
                <label for="mc" class="form-label">Encrypted Device Certificate (MC)</label>
                <input type="text" class="form-control" name="biometricData[mc]" id="mc" required>
            </div>
            <div class="form-group mb-3">
                <label for="pidDataType" class="form-label">PID Data Type</label>
                <input type="text" class="form-control" name="biometricData[pidDataType]" id="pidDataType" required>
            </div>
            <div class="form-group mb-3">
                <label for="sessionKey" class="form-label">Session Key</label>
                <input type="text" class="form-control" name="biometricData[sessionKey]" id="sessionKey" required>
            </div> --}}
            
            <!-- Submit Button -->
             <div class="d-flex justify-content-center"> 
                <a onclick="discoverAvdm();"  id="discoverButton" style="display:none;">Discover AVDM</a>
                <button onclick="CaptureAvdm();" class="btn btn-custom btn-danger">Capture</button>
                <!-- <button type="submit" class="btn btn-info w-100">Submit</button> -->
            </div>
        </form>
    </div>
</div>

<script>

window.onload = async function () {
            try {
                // Run discoverAvdm function and wait for it to complete
                await discoverAvdm();
            } catch (error) {
                console.error("Error in discoverAvdm:", error);
            } finally {
                // Remove loader and enable interactions after the function finishes
                document.getElementById("loadingOverlay").style.display = "none";
                document.body.classList.remove("loading");
            }
        };
    // Geolocation API to auto-fetch latitude and longitude
    document.addEventListener('DOMContentLoaded', () => {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    document.getElementById('latitude').value = position.coords.latitude;
                    document.getElementById('longitude').value = position.coords.longitude;
                },
                (error) => {
                    console.error('Error getting location:', error);
                    alert('Unable to fetch location. Please enable location services.');
                }
            );
        } else {
            alert('Geolocation is not supported by your browser.');
        }
    });
</script>


{{-- bio Data --}}

<div >

</div>




</div>
<!-- <div>
    <h4 >Initialized Framework</h4>
    <div>
        <button type="button" onclick="discoverAvdm();" type="button" value="Discover AVDM">Discover AVDM</button>

        <button type="button" value="Device Info" onclick="deviceInfoAvdm();">Device Info</button>

        <button type="button" value="Capture" onclick="CaptureAvdm();">Capture</button>

        <button type="button" onclick="reset();" value="Reset">Reset</button>
        &nbsp;&nbsp;
</div> -->
<!-- <div>
    <textarea id="txtPidData" rows="7"></textarea>
</div> -->
<div">
<section  style="display:none">


<div id="wrapper" >
    <div id="myNav">
        <div>
            <a href="#">Please wait while discovering port from 11100 to 11120.This will take some time.</a>
        </div>
    </div>
    <!-- Navigation -->
    <div  role="navigation">
        <div>
            <a><img src="logo.png" alt="Mantra logo"></a>
        </div>
        <!-- /.navbar-header -->

        <div>
            <h2>Mantra RD Service Call</h2>
        </div>
    </div>
    
    
    <div>

                                        <div>
                                            <label> Custom SSL Certificate Domain Name  Ex:(rd.myservice.com) </label>
                                            <input type="text" id="txtSSLDomName" placeholder="127.0.0.1">
                                        </div>
                                        </div>
                                </div>
                                <div>

                                        <div>
                                            <label ><b>[ After binding custom SSL certificate, add your domain name in hosts file  (C:\Windows\System32\drivers\etc\hosts)</b></label>
                                            <label><b>Ex: 127.0.0.1   rd.myservice.com ]</b></label>
                                        </div>
                                        </div>
                                </div>
    
    <div>
        <!-- /.row -->
        <div>
            <div>
                <div>

                    <!-- <h4>Initialized Framework</h4>
                    <div>
                        <button type="button" onclick="discoverAvdm();" type="button" value="Discover AVDM">Discover AVDM</button>

                        <button type="button" value="Device Info" onclick="deviceInfoAvdm();">Device Info</button>

                        <button type="button" value="Capture" onclick="CaptureAvdm();">Capture</button>

                        <button type="button" onclick="reset();" value="Reset">Reset</button>
                        &nbsp;&nbsp; -->
                        
                        <!-- <input   name="ChkRD" id="chkHttpsPort" type="checkbox">Custome Port For HTTPS</input> -->
                        {{-- <input   name="ChkRD" id="chkHttpsPort" type="checkbox"></input> --}}
                        
                    </div>



                </div>
            </div>

            <div style="display:none">
                <div>
                    <div>
                        Select Option to Capture
                    </div>
                    <div>
                        <div>
                            <div>
                                <div>
                                    <label>AVDM</label>
                                    <select id="ddlAVDM">
                                        <option></option>
                                    </select>
                                </div>
                                <div>
                                    <div>
                                        <div>
                                            <label>Timeout</label>
                                            <select id="Timeout">
                                                <option>10000</option>
                                                <option>11000</option>
                                                <option>12000</option>
                                                <option>13000</option>
                                                <option>14000</option>
                                                <option>15000</option>
                                                <option>16000</option>
                                                <option>17000</option>
                                                <option>18000</option>
                                                <option>19000</option>
                                                <option>20000</option>
                                                <option>30000</option>
                                                <option>40000</option>
                                                <option>50000</option>
                                                <option>60000</option>
                                                <option>70000</option>
                                                <option>80000</option>
                                                <option>90000</option>
                                                <option>100000</option>
                                                <option>0</option>
                                            </select>
                                        </div>


                                    </div>


                                    <div>
                                        <div>
                                            <label>PidVer</label>
                                            <select id="Pidver">
                                                <option>2.0</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <div>
                                            <label>Env</label>
                                            <select id="Env">
                                                <option>S</option>
                                                <option >PP</option>
                                                <option selected="true">P</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>


                                <div>
                                    <div>
                                        <div>
                                            <label>PTimeout</label>
                                            <select id="pTimeout">
                                                <option>10000</option>
                                                <option selected="selected">20000</option>
                                                <option>30000</option>
                                                <option>40000</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <div>
                                            <label>PGCount</label>
                                            <select id="pgCount">
                                                <option>1</option>
                                                <option selected="selected">2</option>
                                            </select>
                                        </div>
                                    </div>


                                </div>




                            </div>
                            <div>

                                <div >
                                    <label>DataType</label>
                                    <select id="Dtype">
                                        <option value="0">X</option>
                                        <option value="1">P</option>

                                    </select>
                                </div>

                                <div>
                                    <label>Client Key</label>
                                    <input id="txtCK"  type="text" placeholder="Enter text">
                                </div>

                                <div>
                                    <label>OTP</label>
                                    <input id="txtotp"  type="text" placeholder="Enter text">
                                </div>

                            </div>

                            <div>
                                <div>
                                    <label>Wadh</label>
                                    <textarea id="txtWadh" rows="3"></textarea>
                                </div>

                            </div>
                            <div >
                                <div>
                                    <div>
                                        <div>
                                            <label>Finger Count</label>
                                            <select id="Fcount">
                                                <option>0</option>
                                                <option selected="selected">1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option>6</option>
                                                <option>7</option>
                                                <option>8</option>
                                                <option>9</option>
                                                <option>10</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label>Iris Count</label>
                                            <select id="Icount">
                                                <option>0</option>
                                                <option>1</option>
                                                <option>2</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div>
                                        <div>
                                            <label>Face Count</label>
                                            <select id="Pcount">
                                                <option>0</option>
                                                <option>1</option>
                                            </select>
                                        </div>
                                        <div >
                                            <label>Finger Type</label>
                                            <select id="Ftype">
                                                <option value="0">FMR</option>
                                                <option value="1">FIR</option>
                                                <option value="2">BOTH</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div>

                                        <div>
                                            <label>Iris Type </label>
                                            <select id="Itype">
                                                <option>SELECT</option>
                                                <option>ISO</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label>Face Type</label>
                                            <select id="Ptype">
                                                <option>SELECT</option>
                                            </select>
                                        </div>
                                    </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div >
                <div>
                    <div>
                        AVDM / Device Info
                    </div>
                    <div>

                        <div>
                            <textarea rows="5" id="txtDeviceInfo"></textarea>
                        </div>


                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <div>
                <div>
                    <div>
                        Pid Options
                    </div>
                    <div>

                        <div>
                            <textarea id="txtPidOptions" rows="5"></textarea>
                        </div>


                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <div >
                <div>
                    <div>
                        Pid Data
                    </div>
                    <div>

                        <div>
                            <textarea id="txtPidData" rows="7"></textarea>
                        </div>


                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <div>
                <div>
                    <div >
                        PERSONAL IDENTITY(PI)
                    </div>
                    <div>
                        <div>

                            <div>
                                <div>

                                    <div>
                                        <label>Name</label>
                                        <div>
                                            <input type="text"  id="txtName" placeholder="Enter Your Name">
                                        </div>
                                    </div>
                                    <div>
                                        <label>Local Name:</label>
                                        <div>
                                            <input type="text"  id="txtLocalNamePI" placeholder="Local Name">
                                        </div>
                                    </div>
                                    <div>
                                        <label>Gender</label>
                                        <div>
                                            <select id="drpGender">
                                                <option value="0">Select</option>
                                                <option>MALE</option>
                                                <option>FEMALE</option>
                                                <option>TRANSGENDER</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div >
                                        <label>DOB</label>
                                        <div>
                                            <input type="text"  id="txtDOB" placeholder="DOB">
                                        </div>
                                    </div>
                                    <div>
                                        <label >Phone</label>
                                        <div >
                                            <input type="text"  id="txtPhone" placeholder="Phone">
                                        </div>
                                    </div>
                                    <div>
                                        <label >DOB Type:</label>
                                        <div >
                                            <select id="drpDOBType" >
                                                <option value="0">select</option>
                                                <option>V</option>
                                                <option>D</option>
                                                <option>A</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div >
                                <div role="form">
                                    <div>
                                        <label >Match Strategy</label>
                                        <div >

                                            <label >
                                                <input type="radio" name="RDPI" id="rdExactPI" checked="true">Exact
                                            </label>
                                            <label >
                                                <input type="radio" name="RDPI" id="rdPartialPI"> Partial
                                            </label>
                                            <label>
                                                <input type="radio" name="RDPI" id="rdFuzzyPI"> Fuzzy
                                            </label>

                                        </div>
                                    </div>
                                    <div>
                                        <label>Match Value:</label>
                                        <div>
                                            <select id="drpMatchValuePI"></select>
                                        </div>
                                    </div>
                                    <div>
                                        <label>Age</label>
                                        <div>
                                            <input type="number"  id="txtAge" placeholder="Age">
                                        </div>
                                    </div>
                                    <div>
                                        <label>LocalMatchValue:</label>
                                        <div>
                                            <select  id="drpLocalMatchValuePI"></select>
                                        </div>
                                    </div>
                                    <div>
                                        <label >Email</label>
                                        <div>
                                            <input type="email"  id="txtEmail" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div   ">
                <div >
                    <div>
                        PERSONAL ADDRESS(PA)
                    </div>
                    <div>
                        <div >
                            <div >
                                <form role="form" >
                                    <div >
                                        <label >Care Of:</label>
                                        <div >
                                            <input type="text"  id="txtCareOf" placeholder="Care Of:">
                                        </div>
                                    </div>
                                    <div >
                                        <label >Landmark:</label>
                                        <div >
                                            <input type="text"  id="txtLandMark" placeholder="Landmark">
                                        </div>
                                    </div>
                                    <div >
                                        <label >Locality:</label>
                                        <div >
                                            <input type="text"  id="txtLocality" placeholder="Locality">
                                        </div>
                                    </div>
                                    <div >
                                        <label >City:</label>
                                        <div>
                                            <input type="text"  id="txtCity" placeholder="Email">
                                        </div>
                                    </div>
                                    <div >
                                        <label >District:</label>
                                        <div >
                                            <input type="text"  id="txtDist" placeholder="Email">
                                        </div>
                                    </div>
                                    <div >
                                        <label >PinCode:</label>
                                        <div >
                                            <input type="text"  id="txtPinCode" placeholder="PinCode">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div >
                                <form role="form" >
                                    <div >
                                        <label>Building: 	</label>
                                        <div>
                                            <input type="text"  id="txtBuilding" placeholder="Building">
                                        </div>
                                    </div>
                                    <div >
                                        <label >Street:</label>
                                        <div >
                                            <input type="text"  id="txtStreet" placeholder="Street">
                                        </div>
                                    </div>
                                    <div >
                                        <label >PO Name: </label>
                                        <div>
                                            <input type="text"  id="txtPOName" placeholder="PO Name">
                                        </div>
                                    </div>
                                    <div >
                                        <label >Sub Dist:</label>
                                        <div >
                                            <input type="text"  id="txtSubDist" placeholder="Sub Dist">
                                        </div>
                                    </div>
                                    <div >
                                        <label >State:</label>
                                        <div >
                                            <input type="text"  id="txtState" placeholder="State">
                                        </div>
                                    </div>
                                    <div >
                                        <label >Match Strategy:</label>
                                        <div >
                                            <label >
                                                <input type="radio" name="optionsRadiosInline" id="rdMatchStrategyPA" checked="true" value="option1">Exact
                                            </label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div >
                <div >
                    <div>
                        PERSONAL FULL ADDRESS(PFA)
                    </div>
                    <div >
                        <div >
                            <div>
                                <form role="form">
                                    <div >
                                        <label>Email </label>
                                        <label >
                                            <input type="radio" name="RD" id="rdExactPFA" checked="true">Exact
                                        </label>
                                        <label ">
                                            <input type="radio" name="RD" id="rdPartialPFA"> Partial
                                        </label>
                                        <label >
                                            <input type="radio" name="RD" id="rdFuzzyPFA"> Fuzzy
                                        </label>
                                    </div>
                                    <div >
                                        <div >
                                            <div >
                                                <label>Match Value:</label>
                                                <select  id="drpMatchValuePFA"></select>
                                            </div>
                                        </div>
                                        <div >
                                            <div>
                                                <label>Local Match Value:</label>
                                                <select  id="drpLocalMatchValue"></select>
                                            </div>
                                        </div>

                                    </div>

                                </form>
                            </div>
                            <div >
                                <form role="form">
                                    <div >
                                        <label>Address Value:</label>
                                        <textarea rows="2" id="txtAddressValue" ></textarea>
                                    </div>
                                </form>
                            </div>
                            <div >
                                <form role="form">
                                    <div>
                                        <label>Local Address:</label>
                                        <textarea rows="2" id="txtLocalAddress"></textarea>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div >
                <label id="lblstatus">
                </label>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<script language="javascript" type="text/javascript">

    var GetCustomDomName='127.0.0.1';
    var GetPIString='';
    var GetPAString='';
    var GetPFAString='';
    var DemoFinalString='';
    var select = '';
    select += '<option val=0>Select</option>';
    for (i=1;i<=100;i++){
        select += '<option val=' + i + '>' + i + '</option>';
    }
    $('#drpMatchValuePI').html(select);
    $('#drpMatchValuePFA').html(select);
    $('#drpLocalMatchValue').html(select);
    $('#drpLocalMatchValuePI').html(select);

    var finalUrl="";
    var MethodInfo="";
    var MethodCapture="";
    var OldPort=false;






    function test()
    {
        alert("I am calling..");
    }

    function reset()
    {
      
    

    
        $('#txtWadh').val('');
        $('#txtDeviceInfo').val('');
        $('#txtPidOptions').val('');
        $('#txtPidData').val('');
        $("select#ddlAVDM").prop('selectedIndex', 0);
        $("select#Timeout").prop('selectedIndex', 0);
        $("select#Icount").prop('selectedIndex', 0);
        $("select#Fcount").prop('selectedIndex', 0);
        $("select#Icount").prop('selectedIndex', 0);
        $("select#Itype").prop('selectedIndex', 0);
        $("select#Ptype").prop('selectedIndex', 0);
        $("select#Ftype").prop('selectedIndex', 0);
        $("select#Dtype").prop('selectedIndex', 0);

        $('#txtotp').val('');
        $("select#pTimeout").prop('selectedIndex', 1);
        $("select#pgCount").prop('selectedIndex', 1);
        $('#txtSSLDomName').val('');
    }
    // All New Function

    function Demo()
    {


    var GetPIStringstr='';
    var GetPAStringstr='';
    var GetPFAStringstr='';

        if(GetPI()==true)
        {
            GetPIStringstr ='<Pi '+GetPIString+' />';

        }
        else
        {
            GetPIString='';
        }

        if(GetPA()==true)
        {
            GetPAStringstr ='<Pa '+GetPAString+' />';
            //alert(GetPAStringstr);
        }
        else
        {
            GetPAString='';
        }

        if(GetPFA()==true)
        {
            GetPFAStringstr ='<Pfa '+GetPFAString+' />';
            //alert(GetPFAStringstr);
        }
        else
        {
            GetPFAString='';
        }

        if(GetPI()==false && GetPA()==false && GetPFA()==false)
        {
            //alert("Fill Data!");
            DemoFinalString='';
        }
        else
        {
            DemoFinalString = '<Demo>'+ GetPIStringstr +' ' + GetPAStringstr + ' ' + GetPFAStringstr + ' </Demo>';
            //alert(DemoFinalString)
        }


    }

    function GetPI()
    {
        var Flag=false;
        GetPIString='';

         if ($("#txtName").val().length > 0)
        {
            Flag = true;
            GetPIString += "name="+ "\""+$("#txtName").val()+"\"";
        }

        if ($("#drpMatchValuePI").val() > 0 && Flag)
        {
            Flag = true;
            GetPIString += " mv="+ "\""+$("#drpMatchValuePI").val()+"\"";
        }

        if ($('#rdExactPI').is(':checked') && Flag)
        {
            Flag = true;
            GetPIString += " ms="+ "\"E\"";
        }
        else if ($('#rdPartialPI').is(':checked') && Flag)
        {
            Flag = true;
           GetPIString += " ms="+ "\"P\"";
        }
        else if ($('#rdFuzzyPI').is(':checked') && Flag)
        {
            Flag = true;
            GetPIString += " ms="+ "\"F\"";
        }
        if ($("#txtLocalNamePI").val().length > 0)
        {
            Flag = true;
            GetPIString += " lname="+ "\""+$("#txtLocalNamePI").val()+"\"";
        }

        if ($("#txtLocalNamePI").val().length > 0 && $("#drpLocalMatchValuePI").val() > 0)
        {
            Flag = true;
            GetPIString += " lmv="+ "\""+$("#drpLocalMatchValuePI").val()+"\"";
        }



            if ($("#drpGender").val() == "MALE")
            {
                Flag = true;
                 GetPIString += " gender="+ "\"M\"";
            }
            else if ($("#drpGender").val() == "FEMALE")
            {
                Flag = true;
                 GetPIString += " gender="+ "\"F\"";
            }
            else if ($("#drpGender").val() == "TRANSGENDER")
            {
                Flag = true;
               GetPIString += " gender="+ "\"T\"";
            }
        //}
            if ($("#txtDOB").val().length > 0 )
            {
                Flag = true;
                GetPIString += " dob="+ "\""+$("#txtDOB").val()+"\"";
            }

            if ($("#drpDOBType").val() != "0")
            {
                Flag = true;
                GetPIString += " dobt="+ "\""+$("#drpDOBType").val()+"\"";
            }

            if ($("#txtAge").val().length)
            {
                Flag = true;
                GetPIString += " age="+ "\""+$("#txtAge").val()+"\"";
            }

            if ($("#txtPhone").val().length > 0 || $("#txtEmail").val().length > 0)
            {
                Flag = true;
                GetPIString += " phone="+ "\""+$("#txtPhone").val()+"\"";
            }
            if ($("#txtEmail").val().length > 0)
            {
                Flag = true;
                GetPIString += " email="+ "\""+$("#txtEmail").val()+"\"";
            }

        //alert(GetPIString);
        return Flag;
    }


    function GetPA()
    {
        var Flag=false;
        GetPAString='';

        if ($("#txtCareOf").val().length > 0)
        {
            Flag = true;
            GetPAString += "co="+ "\""+$("#txtCareOf").val()+"\"";
        }
        if ($("#txtLandMark").val().length > 0 )
        {
            Flag = true;
            GetPAString += " lm="+ "\""+$("#txtLandMark").val()+"\"";
        }
        if ($("#txtLocality").val().length > 0 )
        {
           Flag = true;
            GetPAString += " loc="+ "\""+$("#txtLocality").val()+"\"";
        }
        if ($("#txtCity").val().length > 0 )
        {
            Flag = true;
            GetPAString += " vtc="+ "\""+$("#txtCity").val()+"\"";
        }
        if ($("#txtDist").val().length > 0 )
        {
            Flag = true;
            GetPAString += " dist="+ "\""+$("#txtDist").val()+"\"";
        }
        if ($("#txtPinCode").val().length > 0 )
        {
            Flag = true;
            GetPAString += " pc="+ "\""+$("#txtPinCode").val()+"\"";
        }
        if ($("#txtBuilding").val().length > 0 )
        {
             Flag = true;
            GetPAString += " house="+ "\""+$("#txtBuilding").val()+"\"";
        }
        if ($("#txtStreet").val().length > 0 )
        {
             Flag = true;
            GetPAString += " street="+ "\""+$("#txtStreet").val()+"\"";
        }
        if ($("#txtPOName").val().length > 0 )
        {
             Flag = true;
            GetPAString += " po="+ "\""+$("#txtPOName").val()+"\"";
        }
        if ($("#txtSubDist").val().length > 0 )
        {
              Flag = true;
            GetPAString += " subdist="+ "\""+$("#txtSubDist").val()+"\"";
        }
        if ($("#txtState").val().length > 0)
        {
             Flag = true;
            GetPAString += " state="+ "\""+$("#txtState").val()+"\"";
        }
        if ( $('#rdMatchStrategyPA').is(':checked') && Flag)
        {
            Flag = true;
            GetPAString += " ms="+ "\"E\"";
        }
        //alert(GetPIString);
        return Flag;
    }



    function GetPFA()
    {
        var Flag=false;
        GetPFAString='';

        if ($("#txtAddressValue").val().length > 0)
        {
            Flag = true;
            GetPFAString += "av="+ "\""+$("#txtAddressValue").val()+"\"";
        }

        if ($("#drpMatchValuePFA").val() > 0 && $("#txtAddressValue").val().length > 0)
        {
            Flag = true;
            GetPFAString += " mv="+ "\""+$("#drpMatchValuePFA").val()+"\"";
        }

        if ($('#rdExactPFA').is(':checked') && Flag)
        {
            Flag = true;
            GetPFAString += " ms="+ "\"E\"";
        }
        else if ($('#rdPartialPFA').is(':checked') && Flag)
        {
            Flag = true;
           GetPFAString += " ms="+ "\"P\"";
        }
        else if ($('#rdFuzzyPFA').is(':checked') && Flag)
        {
            Flag = true;
            GetPFAString += " ms="+ "\"F\"";
        }

        if ($("#txtLocalAddress").val().length > 0)
        {
            Flag = true;
            GetPFAString += " lav="+ "\""+$("#txtLocalAddress").val()+"\"";
        }

        if ($("#drpLocalMatchValue").val() > 0 && $("#txtLocalAddress").val().length > 0)
        {
            Flag = true;
            GetPFAString += " lmv="+ "\""+$("#drpLocalMatchValue").val()+"\"";
        }
        //alert(GetPIString);
        return Flag;
    }

    $( "#ddlAVDM" ).change(function() {
    //alert($("#ddlAVDM").val());
    discoverAvdmFirstNode($("#ddlAVDM").val());
    });


    $( "#chkHttpsPort" ).change(function() {
        if($("#chkHttpsPort").prop('checked')==true)
        {
            OldPort=true;
        }
        else
        {
            OldPort=false;
        }

    });

    function discoverAvdmFirstNode(PortNo)
    {

        $('#txtWadh').val('');
        $('#txtDeviceInfo').val('');
        $('#txtPidOptions').val('');
        $('#txtPidData').val('');

    //alert(PortNo);

    var primaryUrl = "http://"+GetCustomDomName+":";
        url = "";
                 var verb = "RDSERVICE";
                    var err = "";
                    var res;
                    $.support.cors = true;
                    var httpStaus = false;
                    var jsonstr="";
                     var data = new Object();
                     var obj = new Object();

                        $.ajax({
                        type: "RDSERVICE",
                        async: false,
                        crossDomain: true,
                        url: primaryUrl + PortNo,
                        contentType: "text/xml; charset=utf-8",
                        processData: false,
                        cache: false,
                        async:false,
                        crossDomain:true,
                        success: function (data) {
                            httpStaus = true;
                            res = { httpStaus: httpStaus, data: data };
                            //alert(data);

                            //debugger;

                             $("#txtDeviceInfo").val(data);

                            var $doc = $.parseXML(data);

                            //alert($($doc).find('Interface').eq(1).attr('path'));


                            if($($doc).find('Interface').eq(0).attr('path')=="/rd/capture")

                            {
                              MethodCapture=$($doc).find('Interface').eq(0).attr('path');
                            }
                            if($($doc).find('Interface').eq(1).attr('path')=="/rd/capture")

                            {
                              MethodCapture=$($doc).find('Interface').eq(1).attr('path');
                            }

                            if($($doc).find('Interface').eq(0).attr('path')=="/rd/info")

                            {
                              MethodInfo=$($doc).find('Interface').eq(0).attr('path');
                            }
                            if($($doc).find('Interface').eq(1).attr('path')=="/rd/info")

                            {
                              MethodInfo=$($doc).find('Interface').eq(1).attr('path');
                            }

                            

                             alert("RDSERVICE Discover Successfully");
                        },
                        error: function (jqXHR, ajaxOptions, thrownError) {
                        $('#txtDeviceInfo').val("");
                        //alert(thrownError);
                            res = { httpStaus: httpStaus, err: getHttpError(jqXHR) };
                        },
                    });

                    return res;
    }








    async function discoverAvdm() {
    // Set the custom domain name
    let GetCustomDomName = "127.0.0.1";
    if ($("#txtSSLDomName").val().trim().length > 0) {
        GetCustomDomName = $("#txtSSLDomName").val().trim();
    }

    openNav();
    $('#txtWadh, #txtDeviceInfo, #txtPidOptions, #txtPidData').val('');
    $("#ddlAVDM").empty();

    const protocol = window.location.protocol.includes("https") ? "https://" : "http://";
    const primaryUrl = `${protocol}${GetCustomDomName}:`;
    let SuccessFlag = 0;

    for (let i = 11100; i <= 11105; i++) {
        const port = i === 11105 && OldPort ? "8005" : i.toString();
        $("#lblStatus1").text(`Discovering RD service on port: ${port}`);

        try {
            const url = `${primaryUrl}${port}`;
            const response = await fetch(url, { method: "RDSERVICE" });

            if (response.ok) {
                const data = await response.text();
                $("#txtDeviceInfo").val(data);

                const parser = new DOMParser();
                const xmlDoc = parser.parseFromString(data, "text/xml");

                const status = xmlDoc.querySelector("RDService").getAttribute("status");
                const info = xmlDoc.querySelector("RDService").getAttribute("info");

                if (info.includes("Mantra")) {
                    closeNav();

                    const interfaces = xmlDoc.querySelectorAll("Interface");
                    interfaces.forEach((iface) => {
                        const path = iface.getAttribute("path");
                        if (path === "/rd/capture") MethodCapture = path;
                        if (path === "/rd/info") MethodInfo = path;
                    });

                    $("#ddlAVDM").append(
                        `<option value="${port}">(${status} - ${port}) ${info}</option>`
                    );
                    SuccessFlag = 1;
                    break; // Stop loop after success
                }
            }
        } catch (error) {
            console.error(`Error discovering RD service on port ${port}:`, error);
        }
    }

    // if (SuccessFlag === 0) {
    //     alert("Connection failed. Please try again.");
    // } else {
    //     alert("RDService discovered successfully.");
    // }

    $("select#ddlAVDM").prop("selectedIndex", 0);
    closeNav();
}



    function openNav() {
        document.getElementById("myNav").style.width = "100%";
    }

    function closeNav() {
        document.getElementById("myNav").style.width = "0%";
    }

    function deviceInfoAvdm()
    {
        //alert($("#ddlAVDM").val());
     






        url = "";

                
                // $("#lblStatus").text("Discovering RD Service on Port : " + i.toString());
                //Dynamic URL

                    finalUrl = "http://"+GetCustomDomName+":" + $("#ddlAVDM").val();

                    try {
                        var protocol = window.location.href;
                        if (protocol.indexOf("https") >= 0) {
                            finalUrl = "https://"+GetCustomDomName+":" + $("#ddlAVDM").val();
                        }
                    } catch (e)
                    { }

                //
                 var verb = "DEVICEINFO";
                  //alert(finalUrl);

                    var err = "";

                    var res;
                    $.support.cors = true;
                    var httpStaus = false;
                    var jsonstr="";
                    ;
                        $.ajax({

                        type: "DEVICEINFO",
                        async: false,
                        crossDomain: true,
                        url: finalUrl+MethodInfo,
                        contentType: "text/xml; charset=utf-8",
                        processData: false,
                        success: function (data) {
                        //alert(data);
                            httpStaus = true;
                            res = { httpStaus: httpStaus, data: data };

                            $('#txtDeviceInfo').val(data);
                        },
                        error: function (jqXHR, ajaxOptions, thrownError) {
                        alert(thrownError);
                            res = { httpStaus: httpStaus, err: getHttpError(jqXHR) };
                        },
                    });

                    return res;

    }



    function CaptureAvdm() {
var strWadh = "";
var strOtp = "";
Demo();

if ($("#txtWadh").val() != "") {
    strWadh = ' wadh="' + $("#txtWadh").val() + '"';
}
if ($("#txtotp").val() != "") {
    strOtp = ' otp="' + $("#txtotp").val() + '"';
}


var fType = 2; // Ensure fType is explicitly defined if not from #Ftype
var XML = '<?xml version="1.0"?>' +
    '<PidOptions ver="1.0">' +
    '<Opts ' +
        'fCount="' + $("#Fcount").val() + '" ' +
        'fType="' + (fType) + '" ' + // Use fType variable if explicitly set
        'iCount="' + $("#Icount").val() + '" ' +
        'pCount="' + $("#Pcount").val() + '" ' +
        'pgCount="' + $("#pgCount").val() + '" ' +
        strOtp + // Ensure strOtp is a valid string or empty
        'format="' + $("#Dtype").val() + '" ' +
        'pidVer="' + $("#Pidver").val() + '" ' +
        'timeout="' + $("#Timeout").val() + '" ' +
        'pTimeout="' + $("#pTimeout").val() + '" ' +
        strWadh + // Ensure strWadh is a valid string or empty
        'posh="UNKNOWN" ' +
        'env="' + $("#Env").val() + '" />' +
    DemoFinalString + // Ensure DemoFinalString is valid XML-compatible content
    '<CustOpts>' +
        '<Param name="mantrakey" value="' + $("#txtCK").val() + '" />' +
    '</CustOpts>' +
    '</PidOptions>';

var finalUrl = "http://" + GetCustomDomName + ":" + $("#ddlAVDM").val();

try {
    var protocol = window.location.href;
    if (protocol.indexOf("https") >= 0) {
        finalUrl = "https://" + GetCustomDomName + ":" + $("#ddlAVDM").val();
    }
} catch (e) { }

var verb = "CAPTURE";
var httpStaus = false;

$.support.cors = true;

$.ajax({
    type: "CAPTURE",
    async: false,
    crossDomain: true,
    url: finalUrl + MethodCapture,
    data: XML,
    contentType: "text/xml; charset=utf-8",
    processData: false,
    success: function (data) {
        httpStaus = true;

        $('#txtPidData').val(data);
        $('#txtPidOptions').val(XML);

        // Parse the response XML to JSON
        var jsonStr = xmlToJson($.parseXML(data));
        var formattedJson = JSON.stringify(jsonStr, null, 4);

        // Display the JSON response in a textarea
        $('#txtJsonResponse').val(formattedJson);

        // Extract biometric data
        var biometricData = extractBiometricData(jsonStr);

        // Display extracted biometric data in a textarea
        var formattedBiometricData = JSON.stringify(biometricData, null, 4);
        $('#txtBiometricData').val(formattedBiometricData);

        // Display success message
        var message = $($.parseXML(data)).find('Resp').attr('errInfo');
        alert(message);
    },
    error: function (jqXHR, ajaxOptions, thrownError) {
        alert(thrownError);
    },
});
}

// Utility function to extract biometric data from JSON
function extractBiometricData(response) {
const biometricData = {
    dc: response?.PidData?.DeviceInfo?.["@attributes"]?.dc || "",
    ci: response?.PidData?.Skey?.["@attributes"]?.ci || "",
    hmac: response?.PidData?.Hmac?.["#text"] || "",
    dpId: response?.PidData?.DeviceInfo?.["@attributes"]?.dpId || "",
    mc: response?.PidData?.DeviceInfo?.["@attributes"]?.mc || "",
    pidDataType: response?.PidData?.Data?.["@attributes"]?.type || "",
    sessionKey: response?.PidData?.Skey?.["#text"] || "",
    mi: response?.PidData?.DeviceInfo?.["@attributes"]?.mi || "",
    rdsId: response?.PidData?.DeviceInfo?.["@attributes"]?.rdsId || "",
    errCode: response?.PidData?.Resp?.["@attributes"]?.errCode || "0",
    errInfo: response?.PidData?.Resp?.["@attributes"]?.errInfo || "",
    fCount: response?.PidData?.Resp?.["@attributes"]?.fCount || "1",
    fType: response?.PidData?.Resp?.["@attributes"]?.fType || "2",
    // fType:  "2",
    iCount: response?.PidData?.Resp?.["@attributes"]?.iCount || "1",
    iType: response?.PidData?.Resp?.["@attributes"]?.iType || "",
    // pCount: response?.PidData?.Resp?.["@attributes"]?.pCount || "0",
    pCount:'0',
    pType: response?.PidData?.Resp?.["@attributes"]?.pType || "",
    srno: response?.PidData?.DeviceInfo?.additional_info?.Param?.find(param => param["@attributes"]?.name === "srno")?.["@attributes"]?.value || "",
    sysid: response?.PidData?.DeviceInfo?.additional_info?.Param?.find(param => param["@attributes"]?.name === "sysid")?.["@attributes"]?.value || "",
    ts: response?.PidData?.DeviceInfo?.additional_info?.Param?.find(param => param["@attributes"]?.name === "ts")?.["@attributes"]?.value || "",
    pidData: response?.PidData?.Data?.["#text"] || "",
    qScore: response?.PidData?.Resp?.["@attributes"]?.qScore || "",
    nmPoints: response?.PidData?.Resp?.["@attributes"]?.nmPoints || "",
    rdsVer: response?.PidData?.DeviceInfo?.["@attributes"]?.rdsVer || ""
};

return biometricData;
}

// Utility function to convert XML to JSON
function xmlToJson(xml) {
var obj = {};
if (xml.nodeType === 1) { // element
    if (xml.attributes.length > 0) {
        obj["@attributes"] = {};
        for (var j = 0; j < xml.attributes.length; j++) {
            var attribute = xml.attributes.item(j);
            obj["@attributes"][attribute.nodeName] = attribute.nodeValue;
        }
    }
} else if (xml.nodeType === 3) { // text
    obj = xml.nodeValue;
}

if (xml.hasChildNodes()) {
    for (var i = 0; i < xml.childNodes.length; i++) {
        var item = xml.childNodes.item(i);
        var nodeName = item.nodeName;
        if (typeof (obj[nodeName]) === "undefined") {
            obj[nodeName] = xmlToJson(item);
        } else {
            if (typeof (obj[nodeName].push) === "undefined") {
                var old = obj[nodeName];
                obj[nodeName] = [];
                obj[nodeName].push(old);
            }
            obj[nodeName].push(xmlToJson(item));
        }
    }
}
return obj;
}


    function getHttpError(jqXHR) {
        var err = "Unhandled Exception";
        if (jqXHR.status === 0) {
            err = 'Service Unavailable';
        } else if (jqXHR.status == 404) {
            err = 'Requested page not found';
        } else if (jqXHR.status == 500) {
            err = 'Internal Server Error';
        } else if (thrownError === 'parsererror') {
            err = 'Requested JSON parse failed';
        } else if (thrownError === 'timeout') {
            err = 'Time out error';
        } else if (thrownError === 'abort') {
            err = 'Ajax request aborted';
        } else {
            err = 'Unhandled Error';
        }
        return err;
    }

</script>


</section>  
</div>
<script type="text/javascript" src="jquery-1.12.4.js"></script>


@endsection
