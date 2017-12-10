

<div style="max-height: 50vh; overflow-y: scroll;" id="chat-history-div">
    <ul class="list-unstyled chat chat-ul">

    @foreach($messages as $message)


            @if($id != $message->recipient_id)
                <li class="d-flex justify-content-between mb-4">

                    <img src="{{ $user->profile_pic }}" alt="avatar" class="avatar rounded-circle mr-2 ml-lg-3 ml-0 z-depth-1">
                    <div class="chat-body white p-3 ml-2 z-depth-1" style="width: 100%;">
                        <div class="header">
                            <strong class="primary-font">{{ $user->first_name." ".$user->last_name }}</strong>
                            <small class="pull-right text-muted" title="{{ $message->getTimeAttr() }}"><i class="fa fa-clock-o"></i> {{ $message->getAgeAttr() }}</small>
                        </div>
                        <hr class="w-100">
                        <p class="mb-0">
                            {{ $message->message }}
                        </p>
                    </div>
                </li>

            @else
                <li class="d-flex justify-content-between mb-4">

                    <div class="chat-body white p-3 z-depth-1" style="width: 100%;">
                        <div class="header">
                            <strong class="primary-font">{{ auth()->user()->first_name." ".auth()->user()->last_name }}</strong>
                            <small class="pull-right text-muted" title="{{ $message->getTimeAttr() }}"><i class="fa fa-clock-o"></i> {{ $message->getAgeAttr() }}</small>
                        </div>
                        <hr class="w-100">
                        <p class="mb-0">
                            {{ $message->message }}
                        </p>
                    </div>
                    <img src="{{ auth()->user()->profile_pic }}" alt="avatar" class="avatar rounded-circle mr-0 ml-3 z-depth-1">
                </li>
        @endif



    @endforeach
    </ul>

</div>






        {{--<li class="d-flex justify-content-between mb-4 pb-3">
            <img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-6" alt="avatar" class="avatar rounded-circle mr-2 ml-lg-3 ml-0 z-depth-1">
            <div class="chat-body white p-3 ml-2 z-depth-1">
                <div class="header">
                    <strong class="primary-font">Brad Pitt</strong>
                    <small class="pull-right text-muted"><i class="fa fa-clock-o"></i> 12 mins ago</small>
                </div>
                <hr class="w-100">
                <p class="mb-0">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
            </div>
        </li>--}}


<form action="{{ route('message.store') }}" method="POST" name="send-msg-form" id="send-msg-form">
    {{ csrf_field() }}

    <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}">

    <ul class="list-unstyled chat">
        <li class="white">
            <div class="form-group basic-textarea">
                <textarea class="form-control pl-0 my-0 md-textarea" id="message_text" name="message_text" rows="3" placeholder="Type your message here..."></textarea>
            </div>
        </li>
        <li>
            <button type="button"  id="file-button" class="btn btn-outline-elegant btn-rounded btn-sm waves-effect waves-light float-left">Attach File</button>
        </li>
        <li>
            <button type="button"  data-toggle="modal" data-target="#sketch-modal" id="sketch-button" class="btn btn-outline-elegant btn-rounded btn-sm waves-effect waves-light float-left">Sketch</button>
        </li>
        <li>
            <button type="button" id="send-msg" class="btn btn-elegant btn-rounded btn-sm waves-effect waves-light float-right">Send</button>
        </li>
    </ul>

</form>


<!-- Modal -->
<div class="modal fade" id="sketch-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fluid" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sketch and Express your Idea</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <canvas id="can" width="400" height="400" style="position:relative;top:10%;left:10%;border:2px solid;"></canvas>
                <div style="position:relative;top:12%;left:44%;">Choose Color</div>
                <div style="position:relative;top:15%;left:45%;width:10px;height:10px;background:green;" id="green" onclick="color(this)"></div>
                <div style="position:relative;top:15%;left:46%;width:10px;height:10px;background:blue;" id="blue" onclick="color(this)"></div>
                <div style="position:relative;top:15%;left:47%;width:10px;height:10px;background:red;" id="red" onclick="color(this)"></div>
                <div style="position:relative;top:17%;left:45%;width:10px;height:10px;background:yellow;" id="yellow" onclick="color(this)"></div>
                <div style="position:relative;top:17%;left:46%;width:10px;height:10px;background:orange;" id="orange" onclick="color(this)"></div>
                <div style="position:relative;top:17%;left:47%;width:10px;height:10px;background:black;" id="black" onclick="color(this)"></div>
                <div style="position:relative;top:17%;left:48%;width:10px;height:10px;background:cyan;" id="cyan" onclick="color(this)"></div>
                <div style="position:relative;top:17%;left:49%;width:10px;height:10px;background:darkblue;" id="darkblue" onclick="color(this)"></div>
                <div style="position:relative;top:17%;left:50%;width:10px;height:10px;background:lime;" id="lime" onclick="color(this)"></div>
                <div style="position:relative;top:15%;left:50%;width:10px;height:10px;background:maroon;" id="maroon" onclick="color(this)"></div>
                <div style="position:relative;top:15%;left:48%;width:10px;height:10px;background:magenta;" id="magenta" onclick="color(this)"></div>
                <div style="position:relative;top:15%;left:49%;width:10px;height:10px;background:grey" id="grey" onclick="color(this)"></div>

                <div style="position:relative;top:25%;left:44%;">Eraser</div>
                <br>
                <div style="position:relative;top:30%;left:45%;width:20px;height:10px;background:white;border:2px solid;" id="white" onclick="color(this)"></div>
                <img id="canvasimg" style="position:relative;top:15%;left:26%;" style="display:none;">
                <input type="button" value="save" id="btn" size="30" onclick="save()" style="position:relative;top:75%;left:10%;">
                <input type="button" value="clear" id="clr" size="23" onclick="erase()" style="position:relative;top:75%;left:15%;">


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save And Send</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    var canvas, ctx, flag = false,
        prevX = 0,
        currX = 0,
        prevY = 0,
        currY = 0,
        dot_flag = false;

    var x = "black",
        y = 0;

    function init() {
        canvas = document.getElementById('can');
        ctx = canvas.getContext("2d");
        w = canvas.width;
        h = canvas.height;

        canvas.addEventListener("mousemove", function (e) {
            findxy('move', e)
        }, false);
        canvas.addEventListener("mousedown", function (e) {
            findxy('down', e)
        }, false);
        canvas.addEventListener("mouseup", function (e) {
            findxy('up', e)
        }, false);
        canvas.addEventListener("mouseout", function (e) {
            findxy('out', e)
        }, false);
    }

    function color(obj) {
        switch (obj.id) {
            case "green":
                x = "green";
                break;
            case "blue":
                x = "blue";
                break;
            case "red":
                x = "red";
                break;
            case "yellow":
                x = "yellow";
                break;
            case "orange":
                x = "orange";
                break;
            case "black":
                x = "black";
                break;
            case "white":
                x = "white";
                break;
            case "green":
                x = "green";
                break;
            case " darkblue":
                x = "darkblue";
                break;
            case "lime":
                x = "lime";
                break;
            case "maroon":
                x = "maroon";
                break;
            case "magenta":
                x = "magenta";
                break;
            case "grey":
                x = "grey";
                break;
            case "cyan":
                x = "cyan";
                break;
        }
        if (x == "white") y = 14;
        else y = 0;

    }

    function draw() {
        ctx.beginPath();
        ctx.moveTo(prevX, prevY);
        ctx.lineTo(currX, currY);
        ctx.strokeStyle = x;
        ctx.lineWidth = y;
        ctx.stroke();
        ctx.closePath();
    }

    function erase() {
        var m = confirm("Want to clear");
        if (m) {
            ctx.clearRect(0, 0, w, h);
            document.getElementById("canvasimg").style.display = "none";
        }
    }

    function save() {
        document.getElementById("canvasimg").style.border = "2px solid";
        var dataURL = canvas.toDataURL();
        document.getElementById("canvasimg").src = dataURL;
        document.getElementById("canvasimg").style.display = "inline";
    }

    function findxy(res, e) {
        if (res == 'down') {
            prevX = currX;
            prevY = currY;
            currX = e.clientX - canvas.offsetLeft;
            currY = e.clientY - canvas.offsetTop;

            flag = true;
            dot_flag = true;
            if (dot_flag) {
                ctx.beginPath();
                ctx.fillStyle = x;
                ctx.fillRect(currX, currY, 2, 2);
                ctx.closePath();
                dot_flag = false;
            }
        }
        if (res == 'up' || res == "out") {
            flag = false;
        }
        if (res == 'move') {
            if (flag) {
                prevX = currX;
                prevY = currY;
                currX = e.clientX - canvas.offsetLeft;
                currY = e.clientY - canvas.offsetTop;
                draw();
            }
        }
    }

    init();
</script>