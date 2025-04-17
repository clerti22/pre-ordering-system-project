
const show_pass = document.getElementById('checkboxz');

show_pass.addEventListener('change', function(){
  let pass = document.getElementById('passw');
  if(show_pass.checked){
    pass.type = "text"; 
  }
  else{
    pass.type = "password"; 
  }
})

