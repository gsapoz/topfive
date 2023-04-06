const express = require("express");

var fs = require("fs");
const app = express();
const axios = require("axios");
const cheerio = require("cheerio");
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

app.get("/json", (req, res) => {
  fs.readFile("../topfive.json", "utf8", function (err, data) {
    if (err) throw err;
    data = JSON.parse(data);
    res.json(data);
  });
});

app.get("/json/with_images", (req, res) => {
  fs.readFile("../topfive.json", "utf8", function (err, data) {
    if (err) throw err;
    data = JSON.parse(data);
    const default_image =
      '"image": "https://www.fotmob.com/_next/static/media/player_fallback.9cac7bea.png"';
    const has_images = count_occurrences(data, default_image);
    if (has_images) {
      res.json(data);
    } else {
      (async () => {
        // wrap the code in an async function
        data = fill_images(data);
        let name = data[0].clubs[5].players[0][20].name;
        let src = await get_player_image(name);
        res.json(src);
      })();
    }
  });
});

function count_occurrences(obj, search_string) {
  let count = 0;
  for (let key in obj) {
    if (typeof obj[key] === "object") {
      count += count_occurrences(obj[key], search_string);
    } else if (
      typeof obj[key] === "string" &&
      obj[key].includes(search_string)
    ) {
      count++;
    }
  }
  return count;
}

function fill_images(data) {
  return data;
}

async function get_player_image(name) {
  const url = `https://www.google.com/search?q=${name}&tbm=isch`;
  const response = await axios.get(url);
  const $ = cheerio.load(response.data);
  const imgSrc = $("img").eq(1).attr("src");
  return `<img src="${imgSrc}"/>`;
}
