function showUser(str) 
{
  var realstrarr = str.split(";");
  var realstr = realstrarr[realstrarr.length - 1];


  if (realstr.length == 0) 
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

  xmlhttp.open("GET","theme/illyesnapok/participant_select.php?q="+realstr,true);
  xmlhttp.send();
}

function addUser(str)
{
  var textareaBaseOld = document.getElementById("addedUserField").value;
  var textareaBaseOldArr = textareaBaseOld.split(";");
  var textareaBase = "";
  for (i = 0; i < textareaBaseOldArr.length - 1; i++)
  {
    textareaBase = textareaBase + textareaBaseOldArr[i] + ";";
  }

  if (str.length == 0){}
  else
  {
    document.getElementById("addedUserField").value = textareaBase + str + ";";
  }

  document.getElementById("addedUserField").focus();
  showUser("");
}

function displayUser()
{
  str = document.getElementById("displayUser-q").value;

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
      document.getElementById("password-edit-hintField").innerHTML = xmlhttp.responseText;
    }
  }

  xmlhttp.open("GET","theme/illyesnapok/newPswrd.php?q="+str,true);
  xmlhttp.send();
}
