function request(requestinfo){
  var str = requestinfo;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){
      if(this.responseText === 'destroyed'){
        window.location = '/login.php';
      }else{
      document.getElementById('display').innerHTML= this.responseText;
    }
  }
  };
  var data = 'request='+str;
  xmlhttp.open("GET","/handlerhandlemapping.php?"+data);
  xmlhttp.send();
}



function deleteProduct(requestinfo,param){
  if(confirm('Confirm delete ') == true){

  var str = requestinfo;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){   
      if(this.responseText == 'deleted'){
      window.location = '/admin';
      }
  }
  };
  

  var data = new Array('request='+requestinfo,'param='+param);
  xmlhttp.open("GET","/handlerhandlemapping.php?"+data.join("&"));
  xmlhttp.send();
}
}

