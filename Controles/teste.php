<!DOCTYPE html>
<html>
    <head>
        <title>Ping.JS Demo</title>

        <style>
            ul span {
                color: green;
            }
        </style>
    </head>
	<body>
        <script src=".js/ping.min.js" type="text/javascript"></script>

        <ul>
          <li>google.com <span id="ping-google"></span></li>
        </ul>

        <script>
        var p = new Ping();
        p.ping("http://google.com", function(err, data) {
        // Also display error if err is returned.
        if (err) {
          console.log("error loading resource")
          data = data + " " + err;
        }
        document.getElementById("ping-google").innerHTML = data;
        });
    </script>
</body>