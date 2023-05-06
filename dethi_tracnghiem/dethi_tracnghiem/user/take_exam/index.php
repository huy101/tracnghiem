<?php
    session_start();
    // echo "Tài khoảng đăng nhập hiện tại: " . $_SESSION["email"] . ".<br>";
    // echo "Tài khoảng đăng nhập hiện tại: " . $_SESSION["name"] . ".<br>";

    // Thời gian
    // date_default_timezone_set("Asia/Ho_Chi_Minh"); 
    // echo date('h:i:A d-m-Y'); 
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>User</title>

    <!-- Thư viện jquery -->
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <!-- Countdown -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="./style.css">
</head>
    <body>
        <input type="hidden" id="email_user" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : '!session'; ?>">

        <nav class="navbar navbar-inverse" style="font-size:20px;right:0;left:0;z-index:1">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">TRẮC NGHIỆM</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="#">Trang chủ</a></li>
                    <li class="active"><a href="#">Làm bài</a></li>
                    <li><a href="http://localhost:81/dethi_tracnghiem/user/exam_history/">Xem điểm</a></li>
                    <li><a href="http://localhost:81/dethi_tracnghiem/user/update_profile/">Tài khoản</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
                </ul>
            </div>
        </nav>

        <div class="container">
            <div id="countdown" class="count-down">1:00</div>
            <div class="panel-group">
                <div class="panel panel-info">
                    <div class="panel-heading" style="font-weight:bold;">LÀM BÀI THI</div>
                    
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12 text-right">
                                <button type="button" name="button" class="btn btn-success" id="btnStart" onclick="startTimer();">Bắt đầu</button>
                            </div>
                        </div>   

                        <div id="questions"></div>

                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <button type="button" class="btn btn-warning" id="btnFinish">Kết thúc</button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <h3 id="mark" class="text-info"></h3>
                                <button type="button" class="btn btn-info" id="btnSave">Lưu điểm</button>
                                <button type="button" class="btn btn-danger" id="btnNotSave">Làm lại</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="container">
            <div class="panel-group">
                <div class="panel panel-primary">
                    <div class="panel-heading">Làm bài thi</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12 text-right">
                                <button type="button" name="button" class="btn btn-success" id="btnStart">Bắt đầu</button>
                            </div>
                        </div>

                        <div id="questions"></div>
                    </div>
                </div>
                </div>
            </div>
        </div> -->

        

    </body>
</html>

<!-- <script src="./app.js"></script> -->

<script type="text/javascript">
    $(document).ready(function(){
        $('#btnFinish').hide(); 
        $('#btnSave').hide(); 
        $('#btnNotSave').hide(); 

    })

    var questions;  // Biến toàn cục để lưu ds câu hỏi
    var mark = 0;  // Biến lưu điểm
    var email_user = document.getElementById("email_user").value;
    // var name = document.getElementById("name").value;

    $('#btnStart').click(function(){
        GetQuestions();
        $('#btnFinish').show(); 

        //Hiện countdown lên 
        $('#countdown').show(); 

        $(this).hide();
    });

    var now = new Date();
    var formattedDate = now.toLocaleString('en-US', {hour: 'numeric', minute: 'numeric', hour12: true}) + " " + now.toLocaleDateString('en-GB');
    $('#btnFinish').click(function(){
        $(this).hide();
        $('#countdown').hide(); 
        $('#btnSave').show(); 
        $('#btnNotSave').show(); 
        CheckResult();
    });

    $('#btnNotSave').click(function(){
        location.reload();
    });

    function finish(){
        $('#btnFinish').click();
    }

    
    function CheckResult(){ 
        $('#questions div.row').each(function(k,v){     
            // B1: Lấy đáp án đúng của câu hỏi
            let id = $(v).find('h5').attr('id');
            let question = questions.find(x=>x.id == id); // Tìm câu hỏi trong mảng questions dựa vào id đã có ở trên
            let answer = question['answer']; // Lấy đáp án đúng của câu hỏi
            // console.log(answer);    
            // let id = $(v).attr('id'); // Lấy thuộc tính id của thẻ h5 = câu hỏi -> lấy id câu hỏi
            

            // B2: Lấy đáp án của người dùng những thằng radio được check
            let choice = $(v).find('fieldset input[type="radio"]:checked').attr('class');
            if(choice == answer){
                // console.log('Câu có id: '+id+' đúng');
                mark += 1; // Mỗi câu đúng được công 1đ
            }
            else {
                // console.log('Câu có id: '+id+' sai');
            }


            // console.log('Điểm của bạn là: '+ mark);
            
            // console.log(formattedDate);
            $('#mark').text('Điểm của bạn là: ' + mark);

            
        
            // B3: Đánh dấu đáp án đúng để người dùng đối chiếu  
            $('#question_'+id+' > fieldset > div > label.'+answer).css("background-color","rgb(142, 255, 176)","!important");
            // $('#question_'+id+' > fieldset > div > label.'+choice).css("background-color","rgb(255, 121, 121)");

        });
        
    };
        
    function GetQuestions(){
        $.ajax({
                url:'questions.php', 
                type:'get',
                success:function(data){
                    questions = jQuery.parseJSON(data); 
                    let index = 1;
                    let d = '';
                    $.each(questions,function(k,v){
                        d+= '<div class="row" style="margin-left: 10px;" id="question_'+v['id']+'">';
                        d+= '<h5 style="font-weight: bold;" id="'+v['id']+'"> <span class="text-success">Câu '+index+': </span> '+v['question']+'</h5>';
                        d+= '<fieldset id="group'+index+'">';
                        d+= '<div class="radio col-sm-12">';
                        d+= '<label class="A"><input type="radio" name="group'+index+'" class="A"> <span style="font-weight:bold;">A. </span> '+v['option_a']+'</label>';
                        d+= '</div>';

                        d+= '<div class="radio col-sm-12">';
                        d+= '    <label class="B"><input type="radio" name="group'+index+'" class="B"><span style="font-weight:bold;">B. </span> '+v['option_b']+'</label>';
                        d+= '</div>';

                        d+= '<div class="radio col-sm-12">';
                        d+= '    <label class="C"><input type="radio" name="group'+index+'" class="C"><span style="font-weight:bold;">C. </span> '+v['option_c']+'</label>';
                        d+= '</div>';

                        d+= '<div class="radio col-sm-12">';
                        d+= '    <label class="D"><input type="radio" name="group'+index+'" class="D"><span style="font-weight:bold;">D. </span> '+v['option_d']+'</label>';
                        d+= '</div>';
                        d+= '</fieldset>';
                        d+= '</div>';  
                        index++;
                    });

                    $('#questions').html(d);
                }
        });
    }


    // Đếm ngược thời gian làm bài
    var startingMinutes = 1;
    var time = startingMinutes*60;
    var countdownEl = document.getElementById('countdown');
    function updateCountdown(){
        const minutes = Math.floor(time/60);
        let seconds = time%60;
        seconds = seconds < 10 ? '0' + seconds : seconds;
        countdownEl.innerHTML = `${minutes}:${seconds}`;
        if(time>0){
            time--;
        }
        else{
            finish();
        }
    }
    function startTimer(){
        setInterval(updateCountdown, 1000);
    }


    // Lưu điểm người dùng
    $('#btnSave').click(function(){
        var time_exam = formattedDate;
        // var email_user = sessionStorage.getItem('email');

        $.ajax({
            url:'save_score.php',
            type:'post',
            data:{
                name:name,
                mark:mark,
                time_exam:time_exam,
                email_user:email_user,
            },
            success:function(data){
                alert(data);
            }
        })
        location.reload();

    });

</script>





<!-- <script type="text/javascript">
    $('#btnStart').click(function(){
        GetQuestions();
    });

    function GetQuestions(){
        $.ajax({
                url:'questions.php', 
                type:'get',
                success:function(data){
                    $('#questions').html(data);
                }
        });
    }
</script> -->

