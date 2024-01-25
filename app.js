const express = require("express");
const mysql = require("mysql");

const app = express();
const port = 3000;

// Middleware to parse JSON-encoded bodies
app.use(express.json());

// Replace these credentials with your MySQL database credentials
const db = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "yen_hackathon",
});

// Connect to the database
db.connect((err) => {
  if (err) {
    console.error("Error connecting to MySQL:", err);
  } else {
    console.log("Connected to MySQL");
  }
});

app.get("/", (req, res) => {
  console.log("Server is running");
  res.send("Hello, World!");
});

app.get("/reset", (req, res) => {
  const id = req.query.id;
  const time = req.query.time;
  const np = req.query.np;

  if (id) {
    const query = "UPDATE messages SET Time = '0', is_on = 0 WHERE id = ?";
    db.query(query, [id], (err, result) => {
      if (err) {
        console.error("Error executing query:", err);
        res.status(500).json({ error: "Internal Server Error" });
      } else {
        // Include the redirect in the response
        res.send(`Reset successful  <br> <a href='http://localhost/gamebot-admin/maps.php?resetId=${id}'>Return Home</a>
                  <script>window.location.href = "http://localhost:3000/generateBill?id=${id}&time=${time}&np=${np}"</script>`);
        // res.send(`Reset successful  <br> <a href='http://localhost/gamebot-admin/maps.php?resetId=${id}'>Return Home</a>`);
      }
    });
  } else {
    res.status(400).json({ error: "Missing id parameter" });
  }
});

app.get("/generateBill", (req, res) => {
  const pcId = req.query.id;
  const timeInSeconds = req.query.time;
  const num_of_persons = req.query.np;

  if (pcId && timeInSeconds && num_of_persons) {
    const num_of_hours = timeInSeconds / 3600;

    let rate_per_hour = 80;

    if (num_of_hours <= 0.5) {
      rate_per_hour = 50;
    } else if (num_of_hours >= 1 && num_of_hours < 2) {
      rate_per_hour = 80;
    } else if (num_of_hours >= 2) {
      rate_per_hour = 160;
    } else if (num_of_hours >= 3) {
      rate_per_hour = 240;
    } else if (num_of_hours >= 4) {
      rate_per_hour = 320;
    }

    const total_amount = rate_per_hour * num_of_persons;

    // Use parameterized query to prevent SQL injection
    const query =
      "INSERT INTO billing (pc_id, num_of_persons, num_of_hours, total_amount) VALUES (?, ?, ?, ?)";
    db.query(
      query,
      [pcId, num_of_persons, num_of_hours, total_amount],
      (err, result) => {
        if (err) {
          console.error("Error executing query:", err);
          res
            .status(500)
            .json({ error: "Internal Server Error", details: err.message });
        } else {
          res.send(
            "Billing information added successfully<script>window.location.href ='http://localhost/gamebot-admin/bill.php'</script>"
          );
        }
      }
    );
  } else {
    res
      .status(400)
      .json({ error: "Missing id, time, or number of persons parameter" });
  }
});

app.post("/broadcast", (req, res) => {
  const messageContent = req.body.messageContent;

  if (messageContent) {
    const query = "UPDATE messages SET message_content = ?";

    db.query(query, [messageContent], (err, result) => {
      if (err) {
        console.error("Error executing query:", err);
        res.status(500).json({ error: "Internal Server Error" });
      } else {
        res.send("Broadcast successful");
      }
    });
  } else {
    res.status(400).json({ error: "Missing messageContent parameter" });
  }
});

app.get("/addTime", (req, res) => {
  const id = req.query.id;
  const time = req.query.time;
  const numOfPlayers = req.query.np;

  if (id && time && numOfPlayers) {
    // Use parameterized query to prevent SQL injection
    const query =
      "UPDATE messages SET Time = ?, no_of_players = ?, is_on = 1 WHERE id = ?";
    db.query(query, [time, numOfPlayers, id], (err, result) => {
      if (err) {
        console.error("Error executing query:", err);
        res.status(500).json({ error: "Internal Server Error" });
      } else {
        res.send(
          "Time added successfully <br> <a href='http://localhost/gamebot-admin/maps.php'>Return Home</a>"
        );
      }
    });
  } else {
    res
      .status(400)
      .json({ error: "Missing id, time, or number of players parameter" });
  }
});

app.get("/messages", (req, res) => {
  const query = "SELECT * FROM messages";

  db.query(query, (err, result) => {
    if (err) {
      console.error("Error executing query:", err);
      res.status(500).json({ error: "Internal Server Error" });
    } else {
      res.json(result);
    }
  });
});

app.post("/insert_data", (req, res) => {
  const data = req.body;
  const message_content = "PC";

  const { device_id } = data;

  const insertQuery =
    "INSERT INTO messages (device_id, message_content) VALUES (?, ?)";
  const values = [device_id, message_content];

  db.query(insertQuery, values, (err, result) => {
    if (err) {
      console.error("Error executing insert query:", err);
      res.status(500).json({ error: "Internal Server Error" });
    } else {
    }
    res.json({ message: "Data inserted successfully" });
  });
});

app.listen(port, () => {
  console.log(`Server is running on http://localhost:${port}`);
});
