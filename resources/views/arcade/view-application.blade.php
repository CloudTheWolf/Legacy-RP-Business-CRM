		@extends("layouts.app")

        @section("style")
            <link href="assets/plugins/notifications/css/lobibox.min.css" rel="stylesheet" />
        @endsection

		@section("wrapper")
		<div class="page-wrapper">
			<div class="page-content">

                <div class="container">
                    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
                        <div class="col mx-auto">
                            <div class="my-4 text-center">
                                <img src="assets/images/logo-img.png" width="180" alt="" />
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="border p-4 rounded">
                                        <div class="text-center">
                                            <h3 class="">Review Application For {{$application->name}}</h3>
                                        </div>
                                        {{ Form::open(array('url' => 'admin/applications/accept', 'class' => 'row g-3')) }}
                                        <div class="form-body">
                                                <input name="id" type="hidden" value="{!! $application->id !!}">
                                                <div class="col-sm-12">
                                                    <label for="inputFirstName" class="form-label">Full Name</label>
                                                    <input type="text" name="name" class="form-control" id="inputFirstName" value="{{$application->name}}" readonly>
                                                </div>
                                                <div class="col-sm-12">
                                                    <label for="inputEmailAddress" class="form-label">Username</label>
                                                    <input type="text" name="username" class="form-control" id="inputEmailAddress" value="{{str_replace(' ','.',$application->name)}}" required>
                                                </div>
                                            <div class="col-sm-12">
                                                <label for="inputEmailAddress" class="form-label">Email (Discord)</label>
                                                <input type="text" name="discord" class="form-control" id="inputEmailAddress" value="{{str_replace(' ','.',$application->discord)}}" readonly>
                                            </div>
                                            <div class="col-sm-12">
                                                <label for="inputRole" class="form-label">Job Role</label>
                                                <select class="form-control" id="inputRole" name="role" required>
                                                    <option selected value="Bartender">Bartender</option>
                                                    <option value="Manager">Manager</option>
                                                    <option value="Boss">Boss</option>

                                                </select>
                                            </div>
                                            <div class="col-sm-12">
                                                <label for="inputEmailAddress" class="form-label">CID</label>
                                                <input type="text" class="form-control" id="inputEmailAddress" name="cid" placeholder="123456" pattern="[0-9]+" value="{{$application->cid}}" readonly>
                                            </div>
                                            <div class="col-sm-12">
                                                <label for="inputEmailAddress" class="form-label">Passport ID (Steam FiveM ID)</label>
                                                <input type="text" class="form-control" id="inputEmailAddress" name="steamId" placeholder="steam:123456789abcdef" value="{{$application->steam}}" readonly>
                                            </div>
                                            <div class="col-sm-12">
                                                <label for="inputEmailAddress" class="form-label">Cell Phone</label>
                                                <input type="text" class="form-control" id="inputEmailAddress" name="cell" placeholder="123-4567" pattern="^[0-9]{3}-[0-9]{4}$" value="{{$application->cell}}" readonly>
                                            </div>
                                            <hr>
                                            <div class="col-sm-12">
                                                <label class="form-label"><strong>How long have you been a resident of Los Santos?</strong></label>
                                                <p style="white-space: pre-wrap;">{!! $application->cityAge !!}</p>
                                            </div>
                                            <hr>
                                            <div class="col-sm-12">
                                                <label class="form-label"><strong>Tell us a little about yourself</strong></label>
                                                <p style="white-space: pre-wrap;">{!! $application->about !!}</p>
                                            </div>
                                            <hr>
                                            <div class="col-sm-12">
                                                <label class="form-label"><strong>What shift do you prefer?</strong></label>
                                                <p style="white-space: pre-wrap;">{!! ucwords($application->shift) !!}</p>
                                            </div>
                                            <hr>
                                            <div class="col-sm-12">
                                                <label class="form-label"><strong>Tell us why you want a job at
                                                    {!! config('app.companyName') !!} and why we should hire you!</strong></label>
                                                <p style="white-space: pre-wrap;">{!! $application->why !!}</p>
                                            </div>
                                            <hr>
                                            <div class="col-sm-12">
                                                <label class="form-label"><strong>Tell us about your Criminal Record</strong></label>
                                                <p style="white-space: pre-wrap;">{!! $application->record !!}</p>
                                            </div>
                                            <hr>
                                            <div class="col-sm-12">
                                                <label class="form-label"><strong>Do you have any gang ties, or affiliations that may affect your employment?</strong></label>
                                                <p style="white-space: pre-wrap;">{!! $application->gang == 1 ? 'Yes' : 'No' !!}</p>
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="form-label"><strong>Response</strong></label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="ack" id="accept" value="accept" required aria-required="true">
                                                <label class="form-check-label" for="accept">Accept Application</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="ack" id="deny" value="deny" required aria-required="true">
                                                <label class="form-check-label" for="deny">Deny Application</label>
                                            </div>
                                        </div>
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button type="submit" class="btn btn-inverse-success" style="border-color: transparent !important;">Respond To Application</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>

            </div>
		</div>
		@endsection

        @section("script")
            <!--Password show & hide js -->
            <script>
                $(document).ready(function () {
                    $("#show_hide_password a").on('click', function (event) {
                        event.preventDefault();
                        if ($('#show_hide_password input').attr("type") == "text") {
                            $('#show_hide_password input').attr('type', 'password');
                            $('#show_hide_password i').addClass("bx-hide");
                            $('#show_hide_password i').removeClass("bx-show");
                        } else if ($('#show_hide_password input').attr("type") == "password") {
                            $('#show_hide_password input').attr('type', 'text');
                            $('#show_hide_password i').removeClass("bx-hide");
                            $('#show_hide_password i').addClass("bx-show");
                        }
                    });
                });
            </script>
        @endsection



