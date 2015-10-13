function showUser(str) 
{
  if (str.length == 0) 
  { 
    document.getElementById("hintField").innerHTML="";
    document.getElementById("hintField").style.border="0px";
    return;
  }

  if (window.XMLHttpRequest) 
  {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp = new XMLHttpRequest();
  } 
  else 
  {  // code for IE6, IE5
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }


  xmlhttp.onreadystatechange = function() 
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
    {
      document.getElementById("hintField").innerHTML = xmlhttp.responseText;
      document.getElementById("hintField").style.border = "1px solid #A5ACB2";
    }
  }

  xmlhttp.open("GET","theme/illyesnapok/participant_select.php?q="+str,true);
  xmlhttp.send();
}

function addUser(str)
{
  if (str.length == 0){}
  else
  {
    document.getElementById("addedUserField").value = document.getElementById("addedUserField").value + str + ";";
  }
}