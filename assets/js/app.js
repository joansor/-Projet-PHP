function checkboxlimit(checkgroup, limit){
    for (var i=0; i<checkgroup.length; i++){
      checkgroup[i].addEventListener('click',function(){
        var checkedcount=0;
        for (var i=0; i<checkgroup.length; i++)
        {
          checkedcount+=(checkgroup[i].checked)? 1 : 0;
          if (checkedcount>limit)
          {
            
           console.log (document.getElementById('container').innerHtml = "<p>Vous pouvez choisir seulement "+limit+" checkboxes</p>");
            this.checked=false;
          }
        }
      });
    }
  }

  checkboxlimit(document.getElementById('formulaire'), 5);