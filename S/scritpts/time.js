window.onload = function() {
    clock();
      function clock() {
        var now = new Date();
        var one_day = now.getHours();
        var hour = now.getHours();
        var min = now.getMinutes();
        var sec = now.getSeconds();
        var mid = 'PM';
        if (sec < 10) {
          sec = "0" + sec;
        }
        if (min < 10) {
          min = "0" + min;
        }
        if (hour > 12) {
          hour = hour - 12;
        }    
        if(hour==0){
          hour=12;
        }
        if(one_day < 12) {
          mid = 'am';
        }     
      document.getElementById('currentTime').innerHTML = hour+':'+min+':'+sec +''+mid ; setTimeout(clock, 1000);
    }
  }