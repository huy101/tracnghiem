// Jquerry để ẩn hiện mật khẩu
$(document).ready(function(){
    $('.eye').click(function(){
        $(this).toggleClass('open');
        $(this).children('i').toggleClass('fa-eye-slash fa-eye');
        if($(this).hasClass('open')){
            // alert('Change type text');
            $(this).prev().attr('type', 'password');
        }
        else{
            $(this).prev().attr('type', 'text');
        }
    });
});



// Chạy thời gian để nhập mã xác nhận
$(document).ready(function(){
    $('.take-code').click(function(){
        $(this).toggleClass('open');
        if($(this).hasClass('open')){
            var sented_code = document.querySelector('.sented-code-user');
            sented_code.innerHTML =
            `<p class="sented-code">
                Lấy mã xác nhận thành công!
            </p>`;


            // var show_countdown = document.querySelector('.hide-countdown');
            // show_countdown.innerHTML = 
            // `<div class="count-down">
            //     2:00
            // </div>`
            

            // var startTime = 2;
            var time = 60;
            var countDown = document.querySelector('.count-down');
            // alert('countDown');
            setInterval(function(){
            let second = time; // cố định số s dưới 60
            // let minute = Math.floor(time / 60);
            countDown.innerHTML = `${second}`;
            time--;
            }, 1000) 
            // cái 1000 là thời gian countdown là 1s
        }
    });
});






// Xử lí backEnd form đăng kí
/*
function register(e){
    event.preventDefault();
    var user_name = document.getElementById('register-name').value;
    var phone_number = document.getElementById('register-phone').value;
    var email = document.getElementById('register-email').value;
    var pass = document.getElementById('register-pass').value;

    var User = {
        Name : user_name,
        Phone : phone_number,
        Email : email,
        Pass : pass,
    }
    var json = JSON.stringify(User);
    localStorage.setItem(user_name, json);
    alert("Đăng kí thành công")
}

/*
const register_phone = document.querySelector("#register-phone");
const register_pass = document.querySelector("#register-pass");
const register_btn = document.querySelector(".register-btn");

logIn_btn.addEventListener("click", (e) =>{
    e.preventDefault();
    if(register_phone.value === "" || register_pass.value === ""){
        alert("Vui lòng không để trống!");
    }
    else {
        const user = {
            phone: register_phone.value,
            pass: register_pass.value,
        };
        let json = JSON.stringify(user);
        localStorage.setItem(register_phone.value, json);
        alert("Đăng kí thành công!");
        // window.location.href = "trac_nghiem.html";
    }
    
});*/







// Xử lí backEnd form đăng nhập
/*
function login(e){
    event.preventDefault();
    // var user_name = document.getElementById('register-name').value;
    var phone_number = document.getElementById('logIn-user').value;
    // var email = document.getElementById('register-email').value;
    var pass = document.getElementById('logIn-pass').value;

    var phone = localStorage.getItem(phone_number);
    var data = JSON.parse(phone);

    if(phone == null){
        alert("Hãy nhập đi!")
    }
    else if(phone_number == data.Phone && pass == data.Pass){
        alert("Đăng nhập thành công!")
    }
    else{
        alert("Đăng nhập thất bại!")
    }
}


const input_phone = document.querySelector("#logIn-user");
const input_pass = document.querySelector("#logIn-pass");
const logIn_btn = document.querySelector(".logIn-Btn");

logIn_btn.addEventListener("click", (e) =>{
    e.preventDefault();
    if(input_phone.value === "" || input_pass.value === ""){
        alert("Vui lòng không để trống!");
    }
    else{
        const user = JSON.parse(localStorage.getItem(input_phone.value));
        if(
            user.Phone === input_phone.value &&
            user.Pass === input_pass.value
        ){
            alert("Đăng nhập thành công!");
            // window.location.href = "trac_nghiem.html";
        }
        else{
            alert("Đăng nhập thất bại!");
        }
    }
});
*/





// Slick slider
$(document).ready(function(){
    $('.slider-improve-enl').slick({
        slidesToShow: 1,

        //Tự động chạy
        autoplay: true,
        autoplaySpeed: 2000,

        prevArrow:`<button type='button' class='slick-prev pull-left'><i class="fa-solid fa-chevron-left"></i></button>`,
        nextArrow:`<button type='button' class='slick-next pull-right'><i class="fa-solid fa-chevron-right"></i></button>`,
        dots: true,
    });
});


$(document).ready(function(){
    $('.list-library').slick({
        slidesToShow: 3,

        //Tự động chạy
        autoplay: true,
        autoplaySpeed: 2000,

        prevArrow:`<button type='button' class='slick-prev pull-left'><i class="fa-solid fa-chevron-left"></i></button>`,
        nextArrow:`<button type='button' class='slick-next pull-right'><i class="fa-solid fa-chevron-right"></i></button>`,
        dots: true,
    });
});

/*
var dots_text = document.querySelector("#slick-slide-control00");
dots_text.innerHTML = 
`<p>
    Lấy mã xác nhận thành công!
</p>`;*/
