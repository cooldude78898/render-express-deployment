const fs = require('fs');
const path = require('path');

const dataPath = path.join(__dirname, 'paintings.json');
let paintings = [];

try {
  const rawData = fs.readFileSync(dataPath, 'utf8');
  paintings = JSON.parse(rawData);
} catch (err) {
  console.log("Cannot read paintings.json");
}

module.exports = {
  getAll: () => paintings,

  getById: (id) => {
    return paintings.find(p => p.paintingID == id);
  },

  getByGalleryId: (galleryId) => {
    return paintings.filter(p => p.gallery.galleryID == galleryId);
  },

  getByArtistId: (artistId) => {
    return paintings.filter(p => p.artist.artistID == artistId);
  },

  getByYearRange: (min, max) => {
    const minYear = parseInt(min);
    const maxYear = parseInt(max);
    return paintings.filter(p => p.yearOfWork >= minYear && p.yearOfWork <= maxYear);
  }
};
