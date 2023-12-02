$.ajax({
  url: "data.php",
  success: function (data) {
    console.log("response!");
    console.log(data);

    var name = data.name;
    console.log(name);
  },
});
