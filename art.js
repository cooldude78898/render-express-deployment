const express = require("express");
const app = express();
const path = require("path");
const provider = require("./provider");

const port = 8080;

app.use("/static", express.static(path.join(__dirname, "static")));

app.get("/", (req, resp) => {
  resp.json(provider.getAll());
});

app.get("/:id", (req, resp) => {
  const results = provider.getById(req.params.id);
  resp.json(results);
});

app.get("/gallery/:id", (req, resp) => {
  const results = provider.getByGalleryId(req.params.id);
  resp.json(results);
});

app.get("/artist/:id", (req, resp) => {
  const results = provider.getByArtistId(req.params.id);
  resp.json(results);
});

app.get("/year/:min/:max", (req, resp) => {
  const min = parseInt(req.params.min);
  const max = parseInt(req.params.max);
  const results = provider.getByYearRange(min, max);
  resp.json(results);
});

app.listen(port, () => {
  console.log(`Server running at port: ${port}`);
});
