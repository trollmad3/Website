Dash.get({
  api: "campers",
  request: "camp/"+Dash.Week._id,
  success(d) {
    if(d.code === Dash.Result.VALID) {
      var t = new Dash.Template("campers/camper-row.html");
      d.data.forEach(function(i){
        $("#campers-table tr:last").after(t.exec(i));
      });
    }
  }
});

$(function(){
  $("#campers-search").on("input propertychange",function() {
    var query = $(this).val().toLowerCase();
    $("#campers-table tbody").children().each(function(i) {
      if (i === 0) { return; }
      var elements = $(this).children();
      var id        = $(elements[0]).html();
      var name      = $(elements[1]).find("a").html();
      var username  = $(elements[2]).html();

      if (
        name.toLowerCase().includes(query) ||
        id.includes(query) ||
        username.toLowerCase().includes(query)
      ) {
        $(this).show();
      } else {
        $(this).hide();
      }
    });
  });
});
