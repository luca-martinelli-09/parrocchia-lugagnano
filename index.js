const express = require("express");
const { createServer } = require("http");

const app = express();

app.use(express.static("public"));
app.set('view engine', 'pug');

const httpServer = createServer(app);

app.use("/storia", (_, res) => {
  res.render("storia");
});

app.use("/attivita", (_, res) => {
  res.render("attivita");
});

app.use("/gruppi", (_, res) => {
  res.render("gruppi");
});

app.use("/", (_, res) => {
  res.render("index");
});

httpServer.listen(3000);