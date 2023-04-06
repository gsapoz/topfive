const express = require("express");

var fs = require("fs");
const app = express();
var data;

app.get("/", (req, res) => {
  res.json({
    metadata: [
      "author: Gary Sapozhnikov",
      "project website: github.com/gsapoz/topfive",
      "keywords: web, scraping, soccer, football, england, spain, germany, italy, france, world cup, euro cup, fifa, uefa, react, node, express",
    ],
  }); //init: proxy test
});

app.listen(5000, () => {
  console.log("Server started on port 5000");
});

// app.get("/formations", (req, res) => {
//   fs.readFile("components/formations.json", "utf8", function (err, data) {
//     if (err) throw err;
//     data = JSON.parse(data);
//     res.json(data);
//   });
// });
