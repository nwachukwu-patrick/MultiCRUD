function requesti(requestinfo){
  var str = requestinfo;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){
      if(this.responseText === 'destroyed'){
        window.location = '/login.php';
      }else if(this.responseText == 'redirect'){
        window.location = '/login.php';
      }else{
      document.getElementById('cart').innerHTML= this.responseText;
    }
  }
  };
  var quantity = 0;
  if(requestinfo == 'addtocart'){
    quantity = document.getElementById('quantity').innerHTML;
    
  }
  // var data = 'request='+str;
  var data = new Array('request='+str,'quantity='+quantity);
  xmlhttp.open("GET","/handlerhandlemapping.php?"+data.join("&"));
  xmlhttp.send();
}

  function plus(){
    document.getElementById('quantity').innerHTML  =Number(document.getElementById('quantity').innerHTML) + 1;
  }
  function minus(){
    document.getElementById('quantity').innerHTML  =Number(document.getElementById('quantity').innerHTML) - 1;
  }
  