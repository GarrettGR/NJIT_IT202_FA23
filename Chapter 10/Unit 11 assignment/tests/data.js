$.ajax({
  url: "data.php",
  success: function (data) {
    console.log('response!');
    var name = data.name;
    var age = data.age;
    var city = data.city;
    console.log(name, age, city);
  },
});
