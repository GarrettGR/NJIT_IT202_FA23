<html>

<head>
    <title>test 4 (php)</title>
</head>

<body>
    <h1>test 4 (php)</h1>

    <script>
    fetch("get_data.php")
        .then((response) => {
            if (!response.ok) {
                throw new Error('Something went wrong');
            }
            return response.json();
        })
        .then((data) => {
            console.log(data);
            if (data) {
                let firstName = data.first_name;
                let lastName = data.last_name;
                let email = data.email;

                console.log("response!");
                console.log(firstName);
            } else {
                console.log("no response");
            }
        })
        .catch((error) => {
            console.log(error);
        });
    </script>
</body>

</html>