$(function(){
  Dash.get({
    api: "campers",
    request: "fetch/"+camper+"/"+Dash.Campers.Filter.ALL,
    success(d) {
      if(d.code === Dash.Result.VALID) {
        var t = new Dash.Template("camper/badge.html");
        $("#userbadge").html(t.exec(d.data));
      }
    }
  });
});
