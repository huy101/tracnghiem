const startingMinutes = 0.1;
let time = startingMinutes*60;

const countdownEl = document.getElementById('countdown');


 function updateCountdown(){
    const minutes = Math.floor(time/60);
    let seconds = time%60;
    seconds = seconds < 10 ? '0' + seconds : seconds;
    countdownEl.innerHTML = `${minutes}:${seconds}`;
    if(time>0){
        time--;
    }
}

 function startTimer (){
    setInterval(updateCountdown, 1000);
  }