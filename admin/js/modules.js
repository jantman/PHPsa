function toggleModule(modName)
{
  var url = 'moduleAjax.php?action=toggle&mod_name=' + modName;
  doHTTPrequest(url, handleToggleModule);  
}

function handleToggleModule()
{
  if(http.readyState == 4)
  {
    var response = http.responseText;
    document.getElementById('moduleTable').innerHTML = response;
  }
}

function moveModule(modName, direction)
{
  var url = 'moduleAjax.php?action=move&mod_name=' + modName + '&direction=' + direction;
  doHTTPrequest(url, handleMoveModule);  
}

function handleMoveModule()
{
  if(http.readyState == 4)
  {
    var response = http.responseText;
    document.getElementById('moduleTable').innerHTML = response;
  }
}
