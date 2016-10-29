function getRemaining(endtime)
{
  var day = 60*60*24;
  var hour = 60*60;

  var current = Math.floor(Date.now() / 1000); //timezone correction, Date.now() give timestamp in UTC, Hungarian time is UTC + 1 hour

  
  var t = endtime - current;
  return t;
}

function initializeClock(endtime)
{
  var clock = document.getElementById("clock");


  function updateClock()
  { 
    var day = 60*60*24;
    var hour = 60*60;

    var t = getRemaining(endtime);
    if (t > 0)
    {
      var days = Math.floor(t / day);
      var hours = Math.floor((t - (days*day)) / hour);
      var minutes = Math.floor((t - (days*day) - (hour*hours)) / 60);
      var seconds = Math.floor(t - (days*day) - (hour*hours) - (minutes*60));
      clock.innerHTML = "<p>Még hátra van <br> <strong>"+ days + " : " + hours + " : " + minutes + " : " + seconds + "</strong></p>";
    }
    else
    {
      clock.innerHTML = "<p><strong></strong></p>";
    }
  }
  
  updateClock();
  setInterval(function(){updateClock();},1000);
}

