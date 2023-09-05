var num;
var cnt;
body = "問題  "+body;
var len = body.length;

window.onload = function(){
    spellOutQuiz();
}

function addOneChar(){
    document.getElementById('body').innerHTML = body.slice(0,num);
    if (num < len){
        num++;
    }else{
        stopQuiz();
    }
}
function spellOutQuiz(){
    num=1;
    intervalId = setInterval(addOneChar, interval);
}
function countDown(){
    document.getElementById('count_down').innerHTML = cnt;
    if (cnt > 0){
        cnt--;
    }else{
        clearInterval(countDownId);
        document.getElementById('body').innerHTML = body;
        document.getElementById('qinfo').style.display = 'block';
    }
}
function stopQuiz(){
    clearInterval(intervalId);
    document.getElementById('hayaoshi').disabled = true;
    cnt = count_down_time;
    countDownId = setInterval(countDown, 1000);
}